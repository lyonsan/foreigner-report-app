<?php

namespace App\Repositories\TextInfo;
use App\Models\TextInfo;

class TextInfoRepository implements TextInfoRepositoryInterface
{
  /**
   * @param TextInfo $model
   */
  private $model;

  /**
   * コンストラクタ
   */
  public function __construct(TextInfo $model) {
    $this->model = $model;
  }

  /**
   * 参考書情報の格納
   * @param array $insertElement インサート用配列
   * @return int インサート結果
   */
  public function insertAndGetId(array $insertElement): int
  {
    return $this->model->insertGetId($insertElement);
  }

  /**
   * 参考書名から参考書IDを取得する
   * @param string $textName 参考書名
   * @return object $textId 参考書ID
   */
  public function getId($textName)
  {
    return $this->model->where('text_name', $textName)
                       ->pluck('id');
  }
}