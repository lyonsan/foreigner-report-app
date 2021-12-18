<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * 
     */
    // private 

    public function __construct() {

    }

    /**
     * 子供の学習記録の投稿
     * @param Request 投稿内容
     * @return JsonResponse
     */
    public function childPost(Request $request) {
        try {
            DB::beginTransaction();
            $reportId = $this->reportService->insertReport($request); // 学習報告作成
            $this->reportService->insertMSubjectReport($request, $reportId); // 学習報告と科目の中間テーブル作成
            $this->textInfoService->insertTextInfo($request); // この中で内部的にレポート参考書の中間テーブルも作成する？
            DB::commit();
            return response()->json('保存処理に成功しました', 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 500);
        }
        // \Log::debug($request['study_content']); // これでフォーム値を取得できる
        $result = [
            'message' => '学習報告を作成しました。'
        ];
        return response()->json($result, 200);
    }
}
