<?php
namespace App\Service;
use Carbon\Carbon;
use App\Repositories\Report\ReportRepositoryInterface;

class ReportService {

  /**
   * @param ReportRepositoryInterface $reportRepository
   */
  protected $reportRepository;

  public function __construct(
    ReportRepositoryInterface $reportRepository
  ) {
    $this->reportRepository = $reportRepository;
  }
  
  /**
   * 学習報告を保存する
   * @param object $request フォーム送信値
   */
  public function insertReport($request) {
    $insertArray = [];
    $reportColumns = config('report.columns');
    // リクエストからインサート用配列に格納する
    $insertArray = $this->modArrayForInsert($insertArray, $request, $reportColumns);
    // 共通要素を追加する
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
      $insertArray['user_id'] = $request['user_id'];
      $insertArray['created_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    }
    $insertArray['updated_at'] = Carbon::now('Asia/Tokyo')->format('Y:m:d H:i:s');
    return $insertArray;
  }
}