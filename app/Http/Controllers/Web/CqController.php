<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\CmController;
use Illuminate\Support\Facades\Input;
use App\Websupply\UserWebsupply;
use App\Websupply\FolderWebsupply;
use App\Websupply\ProductWebsupply;
use App\Lib\LibUtil;
use App\Services\CollectionService;
use App\Services\Cq\ProductService;
use App\Services\Admin\ImageService as ImageService;
use App\Models\CollectionGood;
use App\Services\MessageService;
use DB;


class CqController extends CmController{


	
	public function __construct(){
		parent::__construct();
        $getdata = Input::all();
        if(isset($getdata['oid']) && !empty($getdata['oid'])){
            $this->other_id = $getdata['oid'];
        }else{
            $this->other_id = $this->user_id;
        }
	}

	public function getIndex(){
        $goods = $this->postGoods();
        $user_id = $this->user_id; 
        // dd($goods);
        $data = [
            'self_id'=>$user_id,
            'self_info'=>$this->self_info,
            'goods'=>$goods['data'],
        ];
        return view('web.cq.index',$data);

	}

    // 上传出清商品
    public function postUcq(){
        $data = Input::all();
        $rules = array(
            'user_id'=>'required',
            'image' => 'required',
            'title'=>'required',
            'description'=>'required',
            'cityid'=>'required',
            'price'=>'required',
            'reserve_price'=>'required',
            'source'=>'required|in:1,2',
            'contact'=>'required',
            'tags'=>'required'

        );
        $renews = [
            'user_id.required'=>'user_id必须填写',
            'image.required' => '图片必须填写',
            'title.required'=>'标题必须填写',
            'description.required'=>'描述必须填写',
            'cityid.required'=>'位置必须填写',
            'price.required'=>'原价必须填写',
            'reserve_price.required'=>'出价必须填写',
            'source.required'=>'来源必须填写',
            'contact.required'=>'联系方式必须填写',
            'tags.required'=>'分类必须填写'
        ];
        parent::validator($data, $rules,$renews);
        $userId = self::get_user_cache($data['user_id']);

        //用户发布，先发后审
        $data['status'] = 1;
        $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }


	//获取瀑布流数据
	public function postGoods(){
        $data = Input::all();
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $userId = 0;
        if(isset($data['user_id'])){
            $userId = self::get_user_cache($data['user_id']);
        }
        $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num,$userId);
        return response()->forApi($rs);
	}

    //我的采集或收藏数据
    public function postMycol(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $rs = ProductService::getInstance()->getProductsByCol ($data,$skip,$num,$userId);
        return response()->forApi($rs);
    }
	
    // 筛选展示数据
    public function postSearch(){
        $data = Input::all();
        $rules = array(
            'keyword'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $entry = [];
        if(isset($data['keyword'])) $entry['keyword'] = $data['keyword'];
        if(isset($data['cityid'])) $entry['cityid'] = $data['cityid'];
        if(isset($data['tags'])) $entry['tags'] = $data['tags'];
        if(isset($data['price1'])) $entry['price1'] = $data['price1'];
        if(isset($data['price2'])) $entry['price2'] = $data['price2'];
        if(isset($data['source'])) $entry['source'] = $data['source'];
        $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num,0,$entry);
        return response()->forApi($rs);

    }

    // 展示数据
	public function show($id){
        $good = ProductService::getInstance()->getProductsDetail(['good_id'=>$id]);
        if(empty($good)) die('no such pic!');
        DB::table('cq_goods')->where('id',$good['id'])->increment('views');
        $ogood = $this->getOgoods($good['id']);
        $ogood = $ogood['data']['list'];
        // dd($ogood);
        // gmore
        $gmore = DB::table('cq_goods')->where('user_id',$good['user_id'])->orderBy('created_at','desc')->select('id')->take(100)->get();
        $last = count($gmore)-1;
        $good['next'] = $good['pre'] = $good['id'];
        foreach ($gmore as $k => $v) {
            if($v['id'] == $good['id']){
                if(isset($gmore[$k+1])){
                    $good['next'] = $gmore[$k+1]['id'];
                }else{
                    $good['next'] = isset($gmore[0]['id'])?$gmore[0]['id']:'';
                }
                if(isset($gmore[$k-1])){
                    $good['pre'] = $gmore[$k-1]['id'];
                }else{
                    $good['pre'] = isset($gmore[$last]['id'])?$gmore[$last]['id']:'';
                }
            }
        }
        // dd($good);
        $data = [
            'self_id'=>$this->user_id,
            'self_info'=>$this->self_info,
            'good'=>$good,
            'ogood'=>$ogood
        ];
		return view('web.cq.show',$data);
	}


    // 发布该商品的人也发布了
    public function getOgoods($good_id = 0){
        $data = Input::all();
        $rules = array(
            'good_id'=>'required',
        );
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        if(!empty($good_id)) $data['good_id'] = $good_id;
        $res = ProductService::getInstance()->getOproducts($data,$skip,$num);
        return response()->forApi(['list'=>$res]);
    }
    

    // 发表评论
    public function postComment(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'to_good_id'=>'required',
            'content'=>'required',

        );
         //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);

        $entry = [
            'user_id'=>$userId,
            'good_id'=>$data['to_good_id'],
            'content'=>$data['content']
        ];
        $id = DB::table('cq_comments')->insertGetId($entry);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }

    // 采集或收藏操作
    public function postCol(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'good_id'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $res = DB::table('cq_cg_record')->where(['good_id'=>$data['good_id'],'user_id'=>$userId])->first();
        if($res) return response()->forApi(array(), 1001, '您已经采集过');
        $entry = [
            'good_id'=>$data['good_id'],
            'user_id'=>$userId
        ];
        $id = DB::table('cq_cg_record')->insertGetId($entry);
        $c = DB::table('cq_goods')->where('id',$data['good_id'])->increment('collection_count');
        if ($id && $c) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '采集失败！');
        }
    }

    // 商品点赞
    public function postGlike(){
        $data = Input::all();
        $rules = array(
            'user_id' => 'required',
            'good_id'=>'required'
        );
         //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['user_id']);
        $res = DB::table('cq_goods_action')->where(['good_id'=>$data['good_id'],'user_id'=>$userId])->first();
        if($res) return response()->forApi(array(), 1001, '您已经点赞过');
        $id = DB::table('cq_goods')->where('id',$data['good_id'])->increment('praise_count');
        if ($id) {
            $entry = [
                'user_id'=>$userId,
                'good_id'=>$data['good_id'],
                'action'=>1
            ];
            DB::table('cq_goods_action')->insertGetId($entry);
            return response()->forApi(['status' => 1]);
        }else{
            return response()->forApi(array(), 1001, '点赞失败！');
        }
    }

    // 评论点赞
    public function postClike(){
        $data = Input::all();
        $rules = array(
            'u_id'=>'required',
            'user_id' => 'required',
            'comment_id'=>'required'
        );
         //请求参数验证
        parent::validator($data, $rules);
        $userId = self::get_user_cache($data['u_id']);
        $res = DB::table('cq_comments_action')->where(['user_id'=>$data['user_id'],'comment_id'=>$data['comment_id']])->first();
        if($res) return response()->forApi(array(), 1001, '您已经点赞过');
        $id = DB::table('cq_comments')->where('id',$data['comment_id'])->increment('praise_count');
        if ($id) {
            $entry = [
                'user_id'=>$data['user_id'],
                'comment_id'=>$data['comment_id'],
                'action'=>1
            ];
            DB::table('cq_comments_action')->insertGetId($entry);
            return response()->forApi(['status' => 1]);
        }else{
            return response()->forApi(array(), 1001, '点赞失败！');
        }
    }


}