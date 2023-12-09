<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Logs as LogsModel;
use Illuminate\Support\Facades\Request;


class Logs
{

    public static function addToLog($subject)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->user()->id : 1;

    	LogsModel::create($log);
    }


    public static function logActivityLists()
    {
		$startDate = Carbon::now()->subWeek();

		return LogsModel::latest()
			->where('created_at', '>=', $startDate)
			->paginate(15);
    }


}
