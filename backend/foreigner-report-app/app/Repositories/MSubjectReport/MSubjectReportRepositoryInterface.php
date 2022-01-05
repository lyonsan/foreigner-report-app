<?php

namespace App\Repositories\MSubjectReport;
use App\Models\MSubjectReport;

interface MSubjectReportRepositoryInterface
{
  /**
   * @param array $insertArray インサート用配列
   * @return bool インサート結果
   */
  public function insert(array $insertArray): int;
}