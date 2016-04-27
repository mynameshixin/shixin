<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        if ($e instanceof CustomException) {
            $data = \Input::all ();

            $log = '[' . date ( 'Y-m-d H:i:s' ) . "]==============================================================>\n";
            $log .= var_export ( $data, true );
            $log .= "\n------------------------------------------------------------------------------------\n";
            $log .=  ' <br>at file' . $e->getFile () . ' <br>line:' . $e->getLine () . "\n" . '<br>===<br>';
            $log .= "\n<===================================================================================\n\n";
            return Log::error ( $log );
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof CustomException) {

        }


        // If the request wants JSON (AJAX doesn't always want JSON)
        if ($request->ajax() || $request->wantsJson())
        {
            // Define the response
            $response = [
                'errors' => 'Sorry, something went wrong.'
            ];

            // If the app is in debug mode
            if (config('app.debug'))
            {
                // Add the exception class name, message and stack trace to response
                $response['exception'] = get_class($e); // Reflection might be better here
                $response['message'] = ' at file' . $e->getFile () . '  line:' . $e->getLine ();
                $response['trace'] = $e->getTrace();

            }

            // Default response of 400
            $status = 400;

            // If this exception is an instance of HttpException
            if ($this->isHttpException($e))
            {
                // Grab the HTTP status code from the Exception
                $status = $e->getStatusCode();
            }


            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        }

        return parent::render($request, $e);
    }
}
