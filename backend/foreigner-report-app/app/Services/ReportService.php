<?php
namespace App\Services;
use Carbon\Carbon;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\MSubject\MSubjectRepositoryInterface;
use App\Repositories\MSubjectReport\MSubjectReportRepositoryInterface;

class ReportService
{
  /**
   * @var ReportRepositoryInterface $reportRepository
   */
  protected $reportRepository;

  /**
   * @var MSubjectRepositoryInterface $mSubjectRepository
   */
  protected $mSubjectRepository;

  /**
   * @var MSubjectReportRepositoryInterface $mSubjectReportRepository
   */
  protected $mSubjectReportRepository;

  public function __construct(
    ReportRepositoryInterface $reportRepository,
    MSubjectRepositoryInterface $mSubjectRepository,
    MSubjectReportRepositoryInterface $mSubjectReportRepository
  ) {
    $this->reportRepository = $reportRepository;
    $this->mSubjectRepository = $mSubjectRepository;
    $this->mSubjectReportRepository = $mSubjectReportRepository;
  }
  
  /**
   * 学習報告を保存する
   * @param object $request フォーム送信値
   */
  public function insertReport(object $request)
  {
    $insertArray = [];
    $reportColumns = config('report.columns');
    // リクエストからインサート用配列に格納する
    $insertArray = $this->modArrayForInsert($insertArray, $request, $reportColumns);
    // 共通要素追加
    $insertArray = $this->addCommonColumn($insertArray, $request, true);
    try {
      $resultId = $this->reportRepository->insertAndGetId($insertArray);
      return $resultId;
    } catch (\Exception $e) {
      throw new \Exception(config('report.error_message'));
      \Log::error('failed to insert report and get id');
    }
  }

  /**
   * 科目と学習報告紐付け用中間テーブルに情報格納
   * @param object $request フォーム送信値
   * @param int $reportId 学習報告のID
   */
  public function insertMSubjectReport(object $request, int $reportId)
  {
    $insertArray        = [];
    $insertSubject      = [];
    $insertSubjectCount = 0;
    // 科目ナンバー取得(DBから)
    $subjectNumList     = $this->mSubjectRepository->getSubjectNumArray();
    // 学習報告と紐づく科目抽出
    foreach ($subjectNumList as $subjectNumArray) {
      if ($request['subject'. $subjectNumArray['id']] === true) {
        $insertSubject[$insertSubjectCount] = $subjectNumArray['id'];
        ++$insertSubjectCount;
      }
    }
    // インサート用配列に格納
    $insertArray = $this->modArrayForMSubRepoInsert($insertArray, $insertSubject, $reportId);
    try {
      $this->mSubjectReportRepository->insert($insertArray);
      return true;
    } catch (\Exception $e) {
      throw new \Exception(config('m_subject_report.error_message'));
      \Log::error('failed to insert m subject report');
    }
  }

  /**
   * 学習報告の一覧を取得する
   * @param int $userId ユーザーID
   * @return object 学習報告のリスト
   */
  public function getReportList(int $userId): object
  {
    $reportList = $this->reportRepository->getReports($userId);
    return $reportList;
  }

  /**
   * インサート用配列を作成
   * @param array $insertArray インサート用配列（整形前）
   * @param object $request フォーム送信値
   * @param array $columns インサート配列用カラムリスト
   * @return array $insertArray インサート用配列（整形後）
   */
  public function modArrayForInsert($insertArray, $request, $columns)
  {
    foreach ($columns as $column) {
      $insertArray[$column] = $request[$column];
    }
    return $insertArray;
  }

  /**
   * 共通の要素を配列に格納する
   * @param array $insertArray 共通要素追加前のインサート用配列
   * @param object $request フォーム送信値
   * @param bool   $isInsert インサート用か否か
   * @return array $insertArray 共通要素追加後のインサート用配列
   */
  public function addCommonColumn($insertArray, $request, $isInsert)
  {
    if ($isInsert === true) {
      $insertArray['user_id']    = $request['user_id'];
      $insertArray['created_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    }
    $insertArray['updated_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    return $insertArray;
  }

  /**
   * 科目と学習報告の中間テーブルにレコード格納する配列を作成する
   * @param array $insertArray 格納前配列
   * @param array $insertSubject インサートする科目の番号
   * @param int $reportId 学習報告のID
   * @return array $insertArray 格納後配列
   */
  public function modArrayForMSubRepoInsert(array $insertArray, array $insertSubject, int $reportId): array
  {
    foreach ($insertSubject as $key => $subject) {
      $insertArray[$key]['subject_id'] = $subject;
      $insertArray[$key]['report_id']  = $reportId;
      $insertArray[$key]['created_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
      $insertArray[$key]['updated_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    }
    return $insertArray;
  }
}