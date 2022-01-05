<?php

namespace App\Repositories\ReportText;

interface ReportTextRepositoryInterface
{
  /**
   * @param array $insertArray インサート用配列
   * @return bool インサートされたレコードのID
   */
  public function insert(array $insertArray): bool;
}