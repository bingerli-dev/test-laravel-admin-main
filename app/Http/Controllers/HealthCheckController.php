<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessLog;
use App\Jobs\ProcessMain;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class HealthCheckController extends Controller
{
    public function check(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now(),
        ]);
    }

    public function checkCloudWatch(): JsonResponse
    {
        Log::info('health check');
        return response()->json([
            'status' => 'ok',
            'timestamp' => now(),
        ]);
    }

    public function checkLog(): JsonResponse
    {
        ProcessLog::dispatch('health check');
        return response()->json([
            'status' => 'ok',
            'timestamp' => now(),
        ]);
    }

    public function checkMain(): JsonResponse
    {
        ProcessMain::dispatch('health check');
        return response()->json([
            'status' => 'ok',
            'timestamp' => now(),
        ]);
    }
}