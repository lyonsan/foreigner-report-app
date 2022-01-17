<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\TextInfoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * @param ReportService $reportService
     */
    private $reportService;

    /**
     * @param TextInfoService $textInfoService
     */
    private $textInfoService;

    public function __construct(
        ReportService $reportService,
        TextInfoService $textInfoService
    ) {
        $this->reportService = $reportService;
        $this->textInfoService = $textInfoService;
    }

    /**
     * 子供の学習記録の投稿
     * @param Request 投稿内容
     * @return JsonResponse
     */
    public function childPost(Request $request)
    {
        try {
            \DB::beginTransaction();
            $reportId = $this->reportService->insertReport($request); // 学習報告作成
            $this->reportService->insertMSubjectReport($request, $reportId); // 学習報告と科目の中間テーブル作成
            $this->textInfoService->insertNewTextInfoAndRelation($request, $reportId); // この中で内部的にレポート参考書の中間テーブルも作成する？
            // ここで挿入したtext_infoのidを取得して中間テーブルに保存したい。既存テキストのものはサーチしてくる
            $this->textInfoService->insertExistTextRelation($request, $reportId);
            \DB::commit();
            $result = [
                'message' => '学習報告を作成しました。'
            ];
            return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json($e->getMessage(), 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 今日の気分のリスト取得
     * @return JsonResponse
     */
    public function getMotivationConf()
    {
        $motivationList = config('report.motivation');
        $result = [
            'motivation' => $motivationList
        ];
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 子供の学習記録を表示する
     * @param int $userId （子供の）ユーザーID
     * @return JsonResponse
     */
    public function getReport(Request $request)
    {
        $userId = $request->userId;
        $reportList = $this->reportService->getReportList($userId);
        $result = [
            'reports' => $reportList
        ];
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
