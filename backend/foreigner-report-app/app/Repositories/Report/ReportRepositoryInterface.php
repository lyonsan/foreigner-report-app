<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface
{
  /**
   * @param array $insertArray インサート用配列
   * @return int インサートされたレコードのID
   */
  public function insertAndGetId(array $insertArray): int;
}