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

  
  /**
   * 参考書名から参考書IDを取得する
   * @param string $textName 参考書名
   * @return object $textId 参考書ID
   */
  public function getId($textName): object;

    /**
   * 教材を教材名で検索する
   * @param string $textName 参考書名
   * @return object $textList 参考書リスト
   */
  public function searchText($textName): object;
}