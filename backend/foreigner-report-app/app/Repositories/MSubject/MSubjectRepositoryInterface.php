<?php

namespace App\Repositories\MSubject;
use App\Models\MSubject;

interface MSubjectRepositoryInterface
{
  /**
   * 科目の番号（ID）を取得する
   * @return array 取得結果
   */
  public function getSubjectNumArray(): array;
}
