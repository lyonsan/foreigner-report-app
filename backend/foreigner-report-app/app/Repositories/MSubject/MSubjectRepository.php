<?php

namespace App\Repositories\MSubject;
use App\Models\MSubject;

class MSubjectRepository implements MSubjectRepositoryInterface
{
  /**
   * @param MSubject $model
   */
  private $model;

  /**
   * コンストラクタ
   */
  public function __construct(MSubject $model) {
    $this->model = $model;
  }

  /**
   * 科目の番号（ID）を取得する
   * @return array 取得結果
   */
  public function getSubjectNumArray(): array
  {
    return $this->model->select('id')
                       ->get()
                       ->toArray();
  }
}