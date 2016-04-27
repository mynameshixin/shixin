<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\Services\Admin\AppService;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\ApiController;



/**
 * Class PermissionForStore
 * @package App\Http\Middleware
 */
class PermissionForStore
{

    protected $auth;

    const checkParams = 'store_id';


    public function handle($request, Closure $next)
    {
        $data = Input::all();

        if(isset($data[self::checkParams])){
            $userId = Auth::user()->id;

            $appService = AppService::getInstance();

            $allStore = $appService->getAllowStore($userId);

            $storeArr = array_keys($allStore);



            if (empty($allStore))
                return ApiController::error(Lang::get('admin.no_permission_store'));

            if (isset($data['store_id']) && !in_array($data['store_id'], $storeArr)) {
                return ApiController::error(Lang::get('admin.no_permission_store'));
            }
        }

        return $next($request);
    }


}
