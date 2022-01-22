<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\TextInfo\TextInfoRepositoryInterface;

class TextInfoController extends Controller
{
    /**
     * @var TextInfoRepositoryInterface $textInfoRepository
     */
    protected $textInfoRepository;

    public function __construct(
        TextInfoRepositoryInterface $textInfoRepository
    ) {
        $this->textInfoRepository = $textInfoRepository;
    }
    /**
     * 教材を文言で検索する
     * @param Request 教材欄の文字列
     * @return JsonResponse 
     */
    public function searchText(Request $request)
    {
        $textName = $request->text_name;
        if ($textName === '') {
            $result = [
                'text_infos' => [],
            ];
        } else {
            $textNameList = $this->textInfoRepository->searchText($textName);
            $result = [
                'text_infos' => $textNameList
            ];
        }
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
