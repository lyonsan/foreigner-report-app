<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface
{
  /**
   * @param array $insertArray インサート用配列
   * @return int インサートされたレコードのID
   */
  public function insertAndGetId(array $insertArray): int;

  /**
   * 学習報告の情報を取得する
   * @param int $userId ユーザーID
   * @return object 学習報告のリスト
   */
  public function getReports(int $userId): object;
}