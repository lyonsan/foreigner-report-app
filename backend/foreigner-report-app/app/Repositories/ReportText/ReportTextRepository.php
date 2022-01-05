<?php

namespace App\Repositories\ReportText;
use App\Models\ReportTextInfo;

class ReportTextRepository implements ReportTextRepositoryInterface
{
  /**
   * @param ReportTextInfo $model
   */
  private $model;

  /**
   * コンストラクタ
   */
  public function __construct(ReportTextInfo $model) {
    $this->model = $model;
  }

  /**
   * @param array $insertArray インサート用配列
   * @return bool インサートされたレコードのID
   */
  public function insert(array $insertArray): bool
  {
    return $this->model->insert($insertArray);
  }
}