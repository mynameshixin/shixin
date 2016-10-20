<?php 

namespace App\Http\Controllers\Api;
use App\Lib\LibUtil;
use Illuminate\Support\Facades\Input;
use DB;
use App\Services\Cq\ProductService;

class CqController extends BaseController{
	// 测试传入数据
	public function getIndex(){
		return view('cq.index');
	}

	

	 //发布出清商品
    public function postPub(){
    	$data = Input::all();
    	$rules = array(
            'access_token'=>'required',
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
        	'access_token.required'=>'令牌必须填写',
            'image.required' => '图片必须填写',
            'title.required'=>'标题必须填写',
            'description.required'=>'描述必须填写',
            'cityid.required'=>'地区必须填写',
            'price.required'=>'价格必须填写',
            'reserve_price.required'=>'一口价必须填写',
            'source.required'=>'来源必须填写',
            'contact.required'=>'联系方式必须填写',
            'tags.required'=>'分类必须填写'
        ];
        parent::validator($data, $rules,$renews);
        $rs = parent::validateAcessToken($data['access_token']);
        $userId = $rs['user_id'];

        //用户发布，先发后审
        $data['status'] = 1;
        $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '发布失败！');
        }
    }

    // 首页展示数据
    public function getMain(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);

        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num);
        return response()->forApi($rs);
    }

    // 我的展示数据
    public function getMy(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);

        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num,$rs['user_id']);
        return response()->forApi($rs);

    }

    // 筛选展示数据
    public function getSearch(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'keyword'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num);
        return response()->forApi($rs);

    }


    // 采集或收藏操作
    public function postCol(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'good_id'=>'required'
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $entry = [
        	'good_id'=>$data['good_id'],
        	'user_id'=>$rs['user_id']
        ];
        $id = DB::table('cq_cg_record')->insertGetId($entry);
        if ($id) {
            return response()->forApi(['id' => $id]);
        }else{
            return response()->forApi(array(), 1001, '采集失败！');
        }
    }


    //我的采集或收藏数据
    public function getMycol(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);

        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $rs = ProductService::getInstance()->getProductsByCol ($data,$skip,$num,$rs['user_id']);
        return response()->forApi($rs);
    }

    // 商品点赞
    public function postGlike(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'good_id'=>'required'
        );
         //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        
        $id = DB::table('cq_goods')->where('id',$data['good_id'])->increment('praise_count');
        if ($id) {
            return response()->forApi(['status' => 1]);
        }else{
            return response()->forApi(array(), 1001, '点赞失败！');
        }
    }

    // 评论点赞
    public function postClike(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'comment_id'=>'required'
        );
         //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $id = DB::table('cq_comments')->where('id',$data['comment_id'])->increment('praise_count');
        if ($id) {
            return response()->forApi(['status' => 1]);
        }else{
            return response()->forApi(array(), 1001, '点赞失败！');
        }
    }


    // 发表评论
    public function postComment(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'to_good_id'=>'required',
            'content'=>'required',

        );
         //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $entry = [
        	'user_id'=>$rs['user_id'],
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

    // 商品详细页面
    public function getGood(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'good_id'=>'required',
        );
         //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $res = ProductService::getInstance()->getProductsDetail($data,$rs['user_id']);
        return response()->forApi($res);
    }

    // 发布该商品的人也发布了
    public function getOgoods(){
    	$data = Input::all();
        $rules = array(
            'access_token' => 'required',
            'good_id'=>'required',
        );
        //请求参数验证
        parent::validator($data, $rules);
        $rs = parent::validateAcessToken($data['access_token']);
        $num = isset($data['num']) ? $data['num'] : 10;
        $page = isset($data['page'])?$data['page']:1;
        $skip = ($page-1)*$num;
        $res = ProductService::getInstance()->getOproducts($data,$skip,$num,$rs['user_id']);
        return response()->forApi($res);
    }

}