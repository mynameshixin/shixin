<?php
namespace App\Http\Controllers\Api;

use App\Lib\LibUtil;
use App\Models\Banner;
use App\Models\CollectionFolder;
use App\Models\Column;
use App\Models\Folder;
use App\Models\Follow;
use App\Services\FolderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\Facades\Input;
use DB;

/**
 *
 * @SWG\Resource(
 *   apiVersion="2.0.0",
 *   swaggerVersion="1.2",
 *   resourcePath="/home",
 *   description="首页相关",
 *   @SWG\Produces("application/json")
 * )
 */
class HomeController extends BaseController
{
    public function index () {
    }
    /**
     *  首页轮播广告
     * GET http://farm.local/api/home/banner
     *
     * @SWG\Api(path="/home/banner",
     *   @SWG\Operation(
     *     method="GET",
     *     summary="首页轮播广告",
     *     notes="",
     *     authorizations={},
     *   )
     * )
     * */
    public function getBanner()
    {
        $advArr = [];
        $rows = Banner::All()->toArray();
        if (!empty($rows)) {
            $ids = array_column($rows,'folder_id');
            $folders= FolderService::getInstance()->getFoldersByIds ($ids);
            foreach ($rows as $row) {
                $entry = [
                    'id'=>$row['id'],
                    'folder_id' => isset($row['folder_id']) ? $row['folder_id'] : 0,
                    'img' => !empty($row['image_id']) ?  LibUtil::getPicUrl($row['image_id'],1) : '',
                    'title' => $row['title'],
                ];
                if (isset($folders[$row['folder_id']])) {
                    $entry['folder'] = $folders[$row['folder_id']];
                }
                $advArr[] = $entry;
            }
        }
        return response()->forApi($advArr , 200);
    }
    /**
     *
     * GET http://farm.local/api/home/banner
     *
     * @SWG\Api(path="/home/recommend",
     *   @SWG\Operation(
     *     method="GET",
     *     summary="首页行家推荐",
     *     notes="",
     *     authorizations={},
     *   )
     * )
     * */
    public function getRecommend()
    {
        $advArr = [];
        $rows =  Column::All()->toArray();
        if (!empty($rows)) {
            foreach ($rows as $key=>$row) {
                 $entry = [
                    'id'=>$row['id'],
                    'key' => $row['key'],
                    'title' => $row['title'],
                    'img_b' => !empty($row['img_b']) ?   LibUtil::getColumnPic($row['img_b']) : '',
                    'img_o' => !empty($row['img_o']) ?   LibUtil::getColumnPic($row['img_o']) : '',
                ];
                if(empty($entry['img_o'])){
                    $entry['img_b'] = LibUtil::getColumnPic($key+1);
                    $entry['img_o'] = LibUtil::getColumnPic($key+1);
                }
                $advArr[] =$entry;
            }
        }
        return response()->forApi($advArr , 200);
    }
    /**
     *
     * @SWG\Api(path="/home/count",
     *   @SWG\Operation(
     *     method="GET",
     *     summary="检索数字集",
     *     notes="",
     *     @SWG\Parameter(
     *           name="keyword",
     *           description="关键字",
     *           paramType="query",
     *           required=true,
     *           type="string"
     *     ),
     *     authorizations={},
     *   )
     * )
     * */
    public function getCount(){
        $data = Input::all();
        $rules = array (
            'keyword' =>'required|min:1',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $keyword = urldecode($data['keyword']);
        $outData = [
            'good_count'=>ProductService::getInstance()->getSearchCount ($keyword,1),
            'image_count'=>ProductService::getInstance()->getSearchCount ($keyword,2),
            'folder_count'=>FolderService::getInstance()->getSearchCount ($keyword),
            'user_count'=>UserService::getInstance()->getSearchCount ($keyword)
        ];
        return response()->forApi($outData , 200);
    }

    /**
     *
     *
     * @SWG\Api(
     *   path="/home/goods",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="首页商品列表",
     *       notes="Returns special list",
     *       @SWG\Parameters(
     *          @SWG\Parameter(
     *           name="access_token",
     *           description="access_token",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *       @SWG\Parameter(
     *           name="kind",
     *           description="类型：1 => 采集商品, 2 => 灵感图",
     *           paramType="query",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="page",
     *           description="页数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *        @SWG\Parameter(
     *           name="num",
     *           description="条数",
     *           paramType="query",
     *           required=false,
     *           type="integer"
     *         ),
     *       )
     *     )
     *   )
     * )
     *
     * @return Response
     */
    public function getGoods()
    {
        $data = Input::all();
        $rules = array(
            'kind' => 'in:1,2',
        );
        $data['kind'] = isset($data['kind']) ? $data['kind'] : 1 ;
        //请求参数验证
        parent::validator($data, $rules);
        $access_token = Input::get('access_token');
        $rs = parent::getToken($access_token);
        $user_ids = $self_id = [];
        $num = isset($data['num']) ? $data['num'] : 10;
        $folder_ids = [];
        if (isset($rs['user_id'])){
            $self_id = $rs['user_id'];
            $user_ids2 =  Follow::where('user_id',$rs['user_id'])->lists('userid_follow')->toArray();
            $folder_ids1 = CollectionFolder::where('user_id',$rs['user_id'])->lists('folder_id')->toArray();
            $user_ids = $user_ids2;
        }
        $adminIds = UserService::getInstance()->getAdminIds();
        $user_ids = array_merge($user_ids,$adminIds);
//        if(empty($user_ids2)){
//            $user_ids = UserService::getInstance()->getAdminIds();
//        }
       if (isset($rs['user_id']) && !empty($rs['user_id']))    $user_ids[] = $rs['user_id'];

        $user_ids = array_unique($user_ids);
        $folder_ids = Folder::whereIn('user_id',$user_ids)->lists('id')->toArray();
        if(isset($folder_ids1) && !empty($folder_ids1)) $folder_ids = array_merge($folder_ids,$folder_ids1);
        $folder_ids = array_unique($folder_ids);
        $rs = ProductService::getInstance()->getProductsByFids ($folder_ids,$user_ids,$data,$num,$self_id);
        //$rs = ProductService::getInstance()->getUserProducts ($user_ids,$data,$num);
        return response()->forApi($rs);
    }

    //获得堆图达人 10个
    public function getHuman(){
        $params = Input::all();
        $rules = array(
            'num'=>'required|integer'
        );
        parent::validator($params,$rules);
        $access_token = Input::get('access_token');
        $user_id = 0;
        if(!empty($access_token)){
            $rs = parent::validateAcessToken($access_token);
            $user_id = $rs['user_id'];
        }
    
        $num  = ($params['num']-1)%10;
        $params['current_uid'] = $user_id;
        $outData = UserService::getInstance()->getBindUserList($params,$num);
        return response()->forApi($outData);
    }

    //发现页获得堆图达人 10个
    public function getBindhuman(){

        $params = Input::all();
        $page = isset($params['page'])?$params['page']:1;
        $num = isset($params['num'])?$params['num']:10;
        $access_token = Input::get('access_token');
        $user_id = 0;
        if(!empty($access_token)){
            $rs = parent::validateAcessToken($access_token);
            $user_id = $rs['user_id'];
        }

        $params['current_uid'] = $user_id;
        $outData = UserService::getInstance()->getBindUserList($params,$num,$page);
        return response()->forApi($outData);
    }
}