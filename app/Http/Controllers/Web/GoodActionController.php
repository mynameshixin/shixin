<?php

namespace App\Http\Controllers\Web;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\GoodAction;
use App\Services\FolderService;
use App\Services\FollowService;
use App\Services\CollectionService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use DB;

//点赞或踩
class GoodActionController extends CmController
{

    

    public function postCreate()
    {

        $data = Input::all();
        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'action' => 'required|in:1,2',
            'user_id' => 'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        $row = GoodAction::where(['user_id'=>$user_id,'good_id'=>$data['good_id'],'action'=>$data['action']])->first();
        if (!empty($row)) {
            $p = $data['action'] == 1?'赞过':'踩过';
            return response()->forApi(array(), 1001, "你已{$p}该商品");
        }
        $rs = ProductService::getInstance()->addAction ($user_id,$data['good_id'],$data['action']);
        if ($rs) {
            return response()->forApi(['status' => 1], 200, '操作成功');
        } else {
            return response()->forApi(array(), 1001, '操作失败');
        }
    }

    public function postDel()
    {

        $data = Input::all();
        $rules = array(
            'good_id' => 'required|exists:goods,id',
            'action' => 'required|in:1,2',
            'user_id' => 'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $user_id = self::get_user_cache($data['user_id']);
        $user = DB::table('users')->where('id',$user_id)->first();
        if(empty($user)) return response()->forApi([],1001,'不存在的用户');
        $row = GoodAction::where(['user_id'=>$user_id,'good_id'=>$data['good_id'],'action'=>$data['action']])->first();
        if (!empty($row)) {
            $rs = DB::table('good_action')->where(['user_id'=>$user_id,'good_id'=>$data['good_id'],'action'=>$data['action']])->delete();
            if ($rs) {
                $good = DB::table('goods')->where('id',$data['good_id'])->first();
                if($good){
                    $entry2['id'] = $data['good_id'];
                    if ($data['action'] == 2) {
                        $entry2['boo_count'] = $good['boo_count'] - 1;
                    } else {
                        $entry2['praise_count'] = $good['praise_count'] - 1;
                    }
                    DB::table('goods')->where('id', $data['good_id'])->update($entry2);
                }
                return response()->forApi(['status' => 1], 200, '操作成功');
            } else {
                return response()->forApi(array(), 1001, '操作失败');
            }
        }
        
    }



}