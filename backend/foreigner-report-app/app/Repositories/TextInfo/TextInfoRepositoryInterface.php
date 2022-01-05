<?php

namespace App\Repositories\TextInfo;
use App\Models\TextInfo;

interface TextInfoRepositoryInterface
{
  /**
   * @param array $insertArray インサート用配列
   * @return int インサート結果
   */
  public function insertAndGetId(array $insertArray): int;
}