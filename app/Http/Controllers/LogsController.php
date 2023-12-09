<?php

namespace App\Http\Controllers;

use Monolog\Logger;
use App\Helpers\Logs;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;

class LogsController extends Controller
{

    public function index()
    {
        $logs = Logs::logActivityLists();

        return view('logs.index', [
            'logs' => $logs,
        ]);
    }

}
