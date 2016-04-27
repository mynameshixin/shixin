<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/29
 * Time: 下午2:46
 */
namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Models\CommentAction;
use App\Models\Folder;
use App\Models\GoodAction;
use App\Services\CommentService;
use App\Services\FolderService;
use App\Services\FollowService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * @SWG\Resource(
 *  resourcePath="/comment/action",
 *  description="评论操作",
 * )
 */

class CommentActionController extends BaseController
{
    private static $user_id;

    public function __construct()
    {

    }


    /**
     *
     *
     * @SWG\Api(
     *   path="/comment/action/create",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="评论点赞操作",
     *       @SWG\Parameters(
     *        @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *        @SWG\Parameter(
     *           name="comment_id",
     *           description="评论ID",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */

    public function postCreate()
    {

        $params = Input::all();
        $rules = array(
            'comment_id' => 'required|exists:comments,id',

        );
        //请求参数验证
        parent::validator($params, $rules);
        $access_token =$params['access_token'];
        $rs = parent::validateAcessToken($access_token);
        self::$user_id = $rs['user_id'];
        $user_id = self::$user_id;
        $row = CommentAction::where(['user_id'=>$user_id,'comment_id'=>$params['comment_id'],'action'=>1])->first();
        if (!empty($row)) {
            return response()->forApi(array(), 1001, '你已赞过该商品');
        }
        $rs = CommentService::getInstance()->addAction ($user_id,$params['comment_id'],1);
        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
    }

}