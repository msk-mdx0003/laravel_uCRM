<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;
use App\Services\AnalysisService;
use App\Services\DecileService;

class AnalysisController extends Controller
{
    public function index (Request $request) {
        //期間指定
        $subQuery = Order::betweenDate($request->startDate, $request->endDate);

        if ($request->type === 'perDay') {
            //ファットコントローラ対策
            //サービスへ切り離し
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        }

        if ($request->type === 'perMonth') {
            //ファットコントローラ対策
            //サービスへ切り離し
            list($data, $labels, $totals) = AnalysisService::perMonth($subQuery);
        }

        if ($request->type === 'perYear') {
            //ファットコントローラ対策
            //サービスへ切り離し
            list($data, $labels, $totals) = AnalysisService::perYear($subQuery);
        }

        if ($request->type === 'decile') {
            //ファットコントローラ対策
            //サービスへ切り離し
            list($data, $labels, $totals) = DecileService::decile($subQuery);
        }

        return response()->json([
            'data' => $data,
            'type' => $request->type,
            'labels' => $labels,
            'totals' => $totals
        ], Response::HTTP_OK);
    }
}
