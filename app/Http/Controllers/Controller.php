<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function logError(\Exception $e, $message = 'An error occurred!')
    {
        Log::error(
            $message . '
                Message: ' . $e->getMessage() . '
                File: ' . $e->getFile() . ' (' . $e->getLine() . ')
                Trace:
                    ' . $e->getTraceAsString()
        );
    }
}
