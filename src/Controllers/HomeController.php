<?php

namespace BertBijnens\LaravelAnalytics\Controllers;

use BertBijnens\LaravelAnalytics\Models\RequestLog;
use BertBijnens\LaravelAnalytics\Models\Site;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return view('analytics::sites.timeline');
    }

    public function details() {
        return view('analytics::sites.details', [
            'site' => Site::first()
        ]);
    }

    public function stats($site) {
        $site = Site::find($site);

        return [
            'data_logs_count' => $site->request_logs()->count(),
            'data_api_count' => $site->request_logs()->where('is_api', 1)->count(),
            'data_web_count' => $site->request_logs()->where('is_file', 0)->where('is_api', 0)->count(),
            'data_file_count' => $site->request_logs()->where('is_file', 1)->count(),

            'data_error_count' => $site->request_logs()->where('response_code', '>=', 500)->count(),
            'data_get_count' => $site->request_logs()->where('request_type', 'GET')->count(),
            'data_post_count' => $site->request_logs()->where('request_type',  'POST')->count(),
            'data_average_response_size' => round($site->request_logs()->where('is_file', 0)->whereNotNull('response_time')->avg('response_bytes'), 2) . 'bytes',

            'data_average_web_response_size' => round($site->request_logs()->where('is_file', 0)->where('is_api', 0)->avg('response_bytes'), 2) . 'bytes',
            'data_average_api_response_size' => round($site->request_logs()->where('is_file', 0)->where('is_api', 1)->avg('response_bytes'), 2) . 'bytes',
            'data_average_web_response_time' => round($site->request_logs()->where('is_file', 0)->where('is_api', 0)->whereNotNull('response_time')->avg('response_time'), 2) . 's',
            'data_average_api_response_time' => round($site->request_logs()->where('is_file', 0)->where('is_api', 1)->whereNotNull('response_time')->avg('response_time'), 2) . 's',
        ];
    }

}
