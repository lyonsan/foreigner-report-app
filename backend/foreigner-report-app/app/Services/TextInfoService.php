<?php
namespace App\Services;
use Carbon\Carbon;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\TextInfo\TextInfoRepositoryInterface;
use App\Repositories\ReportText\ReportTextRepositoryInterface;
use App\Repositories\MSubjectReport\MSubjectReportRepositoryInterface;

class TextInfoService
{
  /**
   * @var ReportRepositoryInterface $reportRepository
   */
  protected $reportRepository;

  /**
   * @var ReportTextRepositoryInterface $reportTextRepository
   */
  protected $reportTextRepository;

  /**
   * @var TextInfoRepositoryInterface $textInfoRepository
   */
  protected $textInfoRepository;

  /**
   * @var MSubjectReportRepositoryInterface $mSubjectReportRepository
   */
  protected $mSubjectReportRepository;

  public function __construct(
    ReportRepositoryInterface $reportRepository,
    ReportTextRepositoryInterface $reportTextRepository,
    TextInfoRepositoryInterface $textInfoRepository,
    MSubjectReportRepositoryInterface $mSubjectReportRepository
  ) {
    $this->reportRepository = $reportRepository;
    $this->textInfoRepository = $textInfoRepository;
    $this->reportTextRepository = $reportTextRepository;
    $this->mSubjectReportRepository = $mSubjectReportRepository;
  }
  
  /**
   * 参考書の情報をレコードに保存
   * @param object $request フォーム送信値
   * @param int    $reportId 学習報告ID
   */
  public function insertNewTextInfoAndRelation(object $request, int $reportId)
  {
    $insertTextInfoArray = [];
    $insertTextInfoArray = $this->modArrayForTextInfoInsert($insertTextInfoArray, $request);
    try {
      $textIdArray = [];
      foreach ($insertTextInfoArray as $key => $insertElement) {
        $textId = $this->textInfoRepository->insertAndGetId($insertElement);
        $textIdArray[$key] = $textId;
      }
    } catch (\Exception $e) {
      throw new \Exception(config('text_info.error_message'));
      \Log::error('failed to insert text info');
      return false;
    }

    try {
      // 作成した参考書情報のIDを取得して中間テーブルに格納する
      $insertReportTextArray = [];
      $insertReportTextArray = $this->modArrayForReportTextInsert($insertReportTextArray, $textIdArray, $reportId);
      $this->reportTextRepository->insert($insertReportTextArray);
      return true;
    } catch (\Exception $e) {
      throw new \Exception(config('report_text_info.error_message'));
      \Log::error('failed to insert report text info');
      return false;
    }
  }

  /**
   * 既存の参考書と学習報告の結びつきを中間テーブルに保存する
   * @param object $request フォーム送信値
   * @param int    $reportId 学習報告ID
   * @return object 参考書のID値
   */
  public function insertExistTextRelation(object $request, int $reportId)
  {
    $textIdArray = [];
    $existTextKeyValues = config('text_info.exist_text_key_values');
    $keyCount = 0;
    foreach (array_keys($existTextKeyValues) as $key) {
      $textColumnName = $existTextKeyValues[$key];
      $textName = $request->$textColumnName;
      if (is_null($textName) === true) {
        continue;
      }
      $textIdObj = $this->textInfoRepository->getId($textName);
      $textIdArray[$keyCount] = $textIdObj->id;
      ++$keyCount;
    }
    // ここで配列に格納されているidを使って中間テーブルに保存する
    try {
      $insertReportTextArray = [];
      $insertReportTextArray = $this->modArrayForReportTextInsert($insertReportTextArray, $textIdArray, $reportId);
      $this->reportTextRepository->insert($insertReportTextArray);
      return true;
    } catch (\Exception $e) {
      throw new \Exception(config('report_text_info.error_message'));
      \Log::error('failed to insert report text info');
      return false;
    }
  }

  /**
   * 参考書の情報のインサート用配列の整形
   * @param array  $insertTextInfoArray インサート用配列（編集前）
   * @param object $request フォーム送信値
   * @return array インサート用配列
   */
  public function modArrayForTextInfoInsert(array $insertTextInfoArray, object $request): array
  {
    // ここでnew_text_name_firstとnew_text_name_secondをそれぞれ格納する
    $newTextKeyValues = config('text_info.new_text_key_values');
    foreach (array_keys($newTextKeyValues) as $key) {
      $textColumnName = $newTextKeyValues[$key];
      $insertTextInfoArray[$key]['text_name']  = $request->$textColumnName;
      $insertTextInfoArray[$key]['created_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
      $insertTextInfoArray[$key]['updated_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    }
    return $insertTextInfoArray;
  }

  /**
   * 参考書とレポートの中間テーブル保存用配列を作成する
   * @param array $insertReportTextArray 中間テーブル格納用の配列（編集前）
   * @param array $textIdArray 参考書IDの配列
   * @param int   $reportId    学習報告ID
   * @return array 中間テーブル格納用の配列
   */
  public function modArrayForReportTextInsert(array $insertReportTextArray, array $textIdArray, int $reportId): array
  {
    foreach ($textIdArray as $key => $textIdElement) {
      $insertReportTextArray[$key]['report_id']  = $reportId;
      $insertReportTextArray[$key]['text_id']    = $textIdElement;
      $insertReportTextArray[$key]['created_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
      $insertReportTextArray[$key]['updated_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    }
    return $insertReportTextArray;
  }
}