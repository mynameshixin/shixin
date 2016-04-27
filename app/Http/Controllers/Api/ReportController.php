<?php
namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Models\UserContact;
use App\Services\MessageService;
use Illuminate\Support\Facades\Input;

use App\SystemMsg;


/**
 *
 * @SWG\Resource(
 *  resourcePath="/feedback",
 * )
 */
class ReportController extends BaseController
{
    private static $user_id;

    public function __construct()
    {
        $access_token = Input::get('access_token');
        $rs = parent::validateAcessToken($access_token);
        self::$user_id = $rs['user_id'];
    }


    /**
     *
     * @SWG\Api(
     *   path="/feedback",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="意见反馈",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="登录返回token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="content",
     *           description="内容",
     *           paramType="query",
     *           required=true,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function store ()
    {
        $data = Input::all();
        $rules = array(
            'content'=> 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        Feedback::insert(['user_id'=>self::$user_id,'content'=>$data['content']]);
        return response()->forApi(['status'=>1]);
    }


}