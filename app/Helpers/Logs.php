<?php

namespace App\Helpers;
use Request;
use App\Models\Student;
use App\Models\Logs as LogsModel;


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
    	return LogsModel::latest()->get();
    }


}