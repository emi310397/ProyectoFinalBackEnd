<?php

namespace Tests\Utils\Handlers;

use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;

class TestErrorHandler implements ExceptionHandlerContract
{
    public function render($request, Exception $e)
    {
        throw $e;
    }

    public function shouldReport(Exception $e)
    {
        return false;
    }

    public function renderForConsole($output, Exception $e)
    {
        throw $e;
    }

    public function report(Exception $e)
    {

    }
}
