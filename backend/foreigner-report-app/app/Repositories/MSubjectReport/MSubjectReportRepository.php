<?php

namespace App\Repositories\MSubjectReport;
use App\Models\MSubjectReport;

class MSubjectReportRepository implements MSubjectReportRepositoryInterface
{
  /**
   * @param MSubjectReport $model
   */
  private $model;

  /**
   * コンストラクタ
   */
  public function __construct(MSubjectReport $model) {
    $this->model = $model;
  }

  /**
   * @param array $insertArray インサート用配列
   * @return bool インサート結果
   */
  public function insert(array $insertArray): int
  {
    return $this->model->insert($insertArray);
  }
}