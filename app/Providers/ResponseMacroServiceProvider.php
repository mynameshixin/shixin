<?php
namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {

        Response::macro('forApi', function ($data, $code = 200, $message = '请求成功') {
            if (!empty($data)) {
                $data = ['message' => $message, 'code' => $code, 'data' =>$data];
            }else{
                $data = ['message' => $message, 'code' => $code];
            }
            return $data;
            exit();
        });

        Response::macro('forApiList', function ($data, $haveNext = 0, $code = 200, $message = '请求成功') {
            $data = ['message' => $message, 'code' => $code, 'data' => $data,'have_next'=> $haveNext];
            return $data;
            exit();
        });
    }

}
