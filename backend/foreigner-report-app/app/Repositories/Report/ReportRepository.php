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
}