<?php

namespace App\Repositories\Report;
use App\Models\Report;

class ReportRepository implements ReportRepositoryInterface
{
  /**
   * @param Report $model
   */
  private $model;

  /**
   * コンストラクタ
   */
  public function __construct(Report $model) {
    $this->model = $model;
  }

  /**
   * @param array $insertArray インサート用配列
   * @return int インサートされたレコードのID
   */
  public function insertAndGetId(array $insertArray): int
  {
    return $this->model->insertGetId($insertArray);
  }

  /**
   * 学習報告の情報を取得する
   * @param int $userId ユーザーID
   * @return object 学習報告のリスト
   */
  public function getReports(int $userId): object
  {
    return $this->model->where('user_id', $userId)
                       ->with('mSubjects')
                       ->with('textInfos')
                       ->get();
  }
}