<?php 

namespace App\Http\Controllers\Api;
use App\Lib\LibUtil;
use Illuminate\Support\Facades\Input;
use DB;
use App\Services\Wz\WzService;

class WzController extends BaseController{
	// 测试传入数据
	public function getIndex(){
		$data = Input::all();
			
		   	// $rules = array(
		   	// 'sike' => 'required',
      //      	'num' => 'required',
      //  		);
		   	// $renews = [
      //   	'sike.required'=>'写入从第几个开始',
      //   	'num.required'=>'需要多少篇',       
      //   	];
        	//parent::validator($data, $rules,$renews);
        	$rs=WzService::getInstance()->newwz(1,2);

		return view('cq.index');
	}
	public function getWz(){
		$data = Input::all();			
		   	$rules = array(
		   	'skip' => 'required',
           	'num' => 'required',
       		);
		   	$renews = [
        	'skip.required'=>'写入从第几个开始',
        	'num.required'=>'需要多少篇',       
        	];
        	parent::validator($data, $rules,$renews);

        	$rs=WzService::getInstance()->newwz($data['skip'],$data['num']);

		 return response()->forApi($rs);
	}
	public function getFen(){
		// $data = Input::all();			
		   	// $rules = array(
		   	// 'pid' => 'required',
           	
      //  		);
		   	// $renews = [
      //   	'pid.required'=>'写入从第几个开始',      	     
      //   	];
        	//parent::validator($data, $rules,$renews);
        	$rs=WzService::getInstance()->fenlei();
        	$num=count($rs);
        	for ($i=0; $i < $num; $i++) { 
        		$data[$i]=$rs[$i];
        		$data[$i]['children']=WzService::getInstance()->fenlei($rs[$i]['id']);
        	}
		 return response()->forApi($data);
	}

	
}

// 	 //发布出清商品
//     public function postPub(){
//     	$data = Input::all();
//     	$rules = array(
//             'access_token'=>'required',
//             'image' => 'required',
//             'title'=>'required',
//             'description'=>'required',
//             'cityid'=>'required',
//             'price'=>'required',
//             'reserve_price'=>'required',
//             'source'=>'required|in:1,2',
//             'contact'=>'required',
//             'tags'=>'required'

//         );
//         $renews = [
//         	'access_token.required'=>'令牌必须填写',
//             'image.required' => '图片必须填写',
//             'title.required'=>'标题必须填写',
//             'description.required'=>'描述必须填写',
//             'cityid.required'=>'地区必须填写',
//             'price.required'=>'价格必须填写',
//             'reserve_price.required'=>'一口价必须填写',
//             'source.required'=>'来源必须填写',
//             'contact.required'=>'联系方式必须填写',
//             'tags.required'=>'分类必须填写'
//         ];
//         parent::validator($data, $rules,$renews);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $userId = $rs['user_id'];

//         //用户发布，先发后审
//         $data['status'] = 1;
//         $id = ProductService::getInstance()->addProduct ($userId,$data,$_FILES);
//         if ($id) {
//             return response()->forApi(['id' => $id]);
//         }else{
//             return response()->forApi(array(), 1001, '发布失败！');
//         }
//     }

//     //编辑自己发布的出清商品
//     public function postEdit(){
//     	$data = Input::all();
//     	$rules = array(
//             'access_token'=>'required',
//             'title'=>'required',
//             'description'=>'required',
//             'cityid'=>'required',
//             'price'=>'required',
//             'reserve_price'=>'required',
//             'source'=>'required|in:1,2',
//             'contact'=>'required',
//             'tags'=>'required',
//             'good_id'=>'required'

//         );
//         $renews = [
//         	'access_token.required'=>'令牌必须填写',
//             'title.required'=>'标题必须填写',
//             'description.required'=>'描述必须填写',
//             'cityid.required'=>'地区必须填写',
//             'price.required'=>'价格必须填写',
//             'reserve_price.required'=>'一口价必须填写',
//             'source.required'=>'来源必须填写',
//             'contact.required'=>'联系方式必须填写',
//             'tags.required'=>'分类必须填写',
//             'good_id.required'=>'商品id必须填写'
//         ];
//         parent::validator($data, $rules,$renews);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $userId = $rs['user_id'];

//         //用户发布，先发后审
//         $data['status'] = 1;
//         $id = ProductService::getInstance()->updateProduct ($userId,$data,$_FILES);
//         if ($id) {
//             return response()->forApi(['id' => $id]);
//         }else{
//             return response()->forApi(array(), 1001, '编辑失败！');
//         }
//     }

//     // 首页展示数据
//     public function getMain(){
//     	$data = Input::all();
//         // $rules = array(
//         //     'access_token' => 'required',
//         // );
//         //请求参数验证
//        // parent::validator($data, $rules);
//        // $rs = parent::validateAcessToken($data['access_token']);

//         $num = isset($data['num']) ? $data['num'] : 10;
//         $page = isset($data['page'])?$data['page']:1;
//         $skip = ($page-1)*$num;
//         $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num);
//         return response()->forApi($rs);
//     }

//     // 我的展示数据
//     public function getMy(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//         );
//         //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);

//         $num = isset($data['num']) ? $data['num'] : 10;
//         $page = isset($data['page'])?$data['page']:1;
//         $skip = ($page-1)*$num;
//         $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num,$rs['user_id']);
//         return response()->forApi($rs);

//     }

//     // 筛选展示数据
//     public function getSearch(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'keyword'=>'required'
//         );
//         //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $num = isset($data['num']) ? $data['num'] : 10;
//         $page = isset($data['page'])?$data['page']:1;
//         $skip = ($page-1)*$num;
//         $entry = [];
//         if(isset($data['keyword'])) $entry['keyword'] = $data['keyword'];
//         if(isset($data['cityid'])) $entry['cityid'] = $data['cityid'];
//         if(isset($data['tags'])) $entry['tags'] = $data['tags'];
//         if(isset($data['price1'])) $entry['price1'] = $data['price1'];
//         if(isset($data['price2'])) $entry['price2'] = $data['price2'];
//         if(isset($data['source'])) $entry['source'] = $data['source'];
//         $rs = ProductService::getInstance()->getProductsByFids ($data,$skip,$num,0,$entry);
//         return response()->forApi($rs);

//     }


//     // 采集或收藏操作
//     public function postCol(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'good_id'=>'required'
//         );
//         //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $res = DB::table('cq_cg_record')->where(['good_id'=>$data['good_id'],'user_id'=>$rs['user_id']])->first();
//         if($res) return response()->forApi(array(), 1001, '您已经采集过');
//         $entry = [
//         	'good_id'=>$data['good_id'],
//         	'user_id'=>$rs['user_id']
//         ];
//         $id = DB::table('cq_cg_record')->insertGetId($entry);
//         $c = DB::table('cq_goods')->where('id',$data['good_id'])->increment('collection_count');
//         if ($id && $c) {
//             return response()->forApi(['id' => $id]);
//         }else{
//             return response()->forApi(array(), 1001, '采集失败！');
//         }
//     }


//     //我的采集或收藏数据
//     public function getMycol(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//         );
//         //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);

//         $num = isset($data['num']) ? $data['num'] : 10;
//         $page = isset($data['page'])?$data['page']:1;
//         $skip = ($page-1)*$num;
//         $rs = ProductService::getInstance()->getProductsByCol ($data,$skip,$num,$rs['user_id']);
//         return response()->forApi($rs);
//     }

//     // 商品点赞
//     public function postGlike(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'good_id'=>'required'
//         );
//          //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $res = DB::table('cq_goods_action')->where(['good_id'=>$data['good_id'],'user_id'=>$rs['user_id']])->first();
//         if($res) return response()->forApi(array(), 1001, '您已经点赞过');
//         $id = DB::table('cq_goods')->where('id',$data['good_id'])->increment('praise_count');
//         if ($id) {
//             $entry = [
//                 'user_id'=>$rs['user_id'],
//                 'good_id'=>$data['good_id'],
//                 'action'=>1
//             ];
//             DB::table('cq_goods_action')->insertGetId($entry);
//             return response()->forApi(['status' => 1]);
//         }else{
//             return response()->forApi(array(), 1001, '点赞失败！');
//         }
//     }

//     // 评论点赞
//     public function postClike(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'comment_id'=>'required'
//         );
//          //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);

//         $res = DB::table('cq_comments_action')->where(['user_id'=>$rs['user_id'],'comment_id'=>$data['comment_id']])->first();
//         if($res) return response()->forApi(array(), 1001, '您已经点赞过');

//         $id = DB::table('cq_comments')->where('id',$data['comment_id'])->increment('praise_count');
//         if ($id) {
//             $entry = [
//                 'user_id'=>$rs['user_id'],
//                 'comment_id'=>$data['comment_id'],
//                 'action'=>1
//             ];
//             DB::table('cq_comments_action')->insertGetId($entry);
//             return response()->forApi(['status' => 1]);
//         }else{
//             return response()->forApi(array(), 1001, '点赞失败！');
//         }
//     }


//     // 发表评论
//     public function postComment(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'to_good_id'=>'required',
//             'content'=>'required',

//         );
//          //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $entry = [
//         	'user_id'=>$rs['user_id'],
//         	'good_id'=>$data['to_good_id'],
//         	'content'=>$data['content']
//         ];
//         $id = DB::table('cq_comments')->insertGetId($entry);
//         if ($id) {
//             return response()->forApi(['id' => $id]);
//         }else{
//             return response()->forApi(array(), 1001, '发布失败！');
//         }
//     }


//     // 增加浏览量
//     public function postIview(){
//         $data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'good_id'=>'required',
//         );
//          //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);

//         $status = DB::table('cq_goods')->where('id',$data['good_id'])->increment('views');
//         if ($status) {
//             return response()->forApi(['status' => 1]);
//         }else{
//             return response()->forApi(array(), 1001, '操作失败！');
//         }
//     }

//     // 商品详细页面
//     public function getGood(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'good_id'=>'required',
//         );
//          //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $res = ProductService::getInstance()->getProductsDetail($data,$rs['user_id']);
//         return response()->forApi($res);
//     }

//     // 发布该商品的人也发布了
//     public function getOgoods(){
//     	$data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'good_id'=>'required',
//         );
//         //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $num = isset($data['num']) ? $data['num'] : 10;
//         $page = isset($data['page'])?$data['page']:1;
//         $skip = ($page-1)*$num;
//         $res = ProductService::getInstance()->getOproducts($data,$skip,$num);
//         return response()->forApi($res);
//     }

//     // 获取分类接口
//     public function getCate(){
//         $tags = <<<str
// [{"name":"沙发","pid":0,"children":[{"name":"三人沙发","pid":1},{"name":"双人沙发","pid":1},{"name":"单人沙发","pid":1},{"name":"沙发床","pid":1},{"name":"布艺沙发","pid":1},{"name":"皮质沙发","pid":1},{"name":"古典沙发","pid":1},{"name":"现代沙发","pid":1},{"name":"美式沙发","pid":1},{"name":"东南亚沙发","pid":1},{"name":"简欧沙发","pid":1},{"name":"日式沙发","pid":1}]},{"name":"桌","pid":0,"children":[{"name":"餐桌","pid":2},{"name":"书桌","pid":2},{"name":"茶几","pid":2},{"name":"办公桌","pid":2},{"name":"梳妆台","pid":2},{"name":"吧台","pid":2},{"name":"会议桌","pid":2},{"name":"沙发桌","pid":2},{"name":"咖啡桌","pid":2}]},{"name":"床","pid":0,"children":[{"name":"双人床","pid":3},{"name":"儿童床","pid":3},{"name":"单人床","pid":3},{"name":"实木床","pid":3},{"name":"板式床","pid":3},{"name":"铁艺床","pid":3},{"name":"水床","pid":3},{"name":"吊床","pid":3},{"name":"榻榻米床","pid":3},{"name":"欧式床","pid":3},{"name":"折叠床","pid":3},{"name":"美式床","pid":3},{"name":"地中海床","pid":3},{"name":"高低床","pid":3}]},{"name":"柜","pid":0,"children":[{"name":"电视柜","pid":4},{"name":"衣柜","pid":4},{"name":"书柜","pid":4},{"name":"床头柜","pid":4},{"name":"浴室柜","pid":4},{"name":"酒柜","pid":4},{"name":"玄关柜","pid":4},{"name":"五斗柜","pid":4},{"name":"厨柜","pid":4},{"name":"餐边柜","pid":4},{"name":"餐具柜","pid":4},{"name":"食品柜","pid":4},{"name":"文件柜","pid":4},{"name":"组合柜","pid":4},{"name":"吧柜","pid":4}]},{"name":"架子","pid":0,"children":[{"name":"书架","pid":5},{"name":"鞋架","pid":5},{"name":"衣帽架","pid":5},{"name":"花架","pid":5},{"name":"伞架","pid":5},{"name":"博古架","pid":5},{"name":"格架","pid":5}]},{"name":"装饰摆设","pid":0,"children":[{"name":"摆件","pid":6},{"name":"镜子","pid":6},{"name":"钟","pid":6},{"name":"装置画","pid":6},{"name":"香薰","pid":6},{"name":"挂钩","pid":6},{"name":"收纳","pid":6},{"name":"相框","pid":6}]},{"name":"灯饰","pid":0,"children":[{"name":"台灯","pid":7},{"name":"吊灯","pid":7},{"name":"壁灯","pid":7},{"name":"户外灯","pid":7},{"name":"镜前灯","pid":7},{"name":"吸顶灯","pid":7},{"name":"创意","pid":7},{"name":"落地灯","pid":7},{"name":"厨卫灯","pid":7},{"name":"水晶灯","pid":7},{"name":"铜灯","pid":7},{"name":"阳台灯","pid":7}]},{"name":"家纺家饰","pid":0,"children":[{"name":"床品","pid":8},{"name":"抱枕","pid":8},{"name":"布料","pid":8},{"name":"窗帘","pid":8},{"name":"坐垫","pid":8},{"name":"桌布","pid":8},{"name":"枕头","pid":8},{"name":"桌旗","pid":8},{"name":"靠垫","pid":8},{"name":"地毯","pid":8}]},{"name":"卫生间","pid":0,"children":[{"name":"浴帘","pid":9},{"name":"浴巾","pid":9},{"name":"衣架","pid":9},{"name":"洗漱套瓶","pid":9},{"name":"杯子","pid":9},{"name":"马桶垫","pid":9},{"name":"防滑垫","pid":9},{"name":"毛巾架","pid":9},{"name":"毛巾环","pid":9}]},{"name":"花艺植物","pid":0,"children":[{"name":"多肉植物","pid":10},{"name":"花瓶","pid":10},{"name":"花盆","pid":10},{"name":"仿真花","pid":10},{"name":"鲜花","pid":10},{"name":"干花","pid":10},{"name":"水景","pid":10},{"name":"野兽派","pid":10},{"name":"RoseOnly","pid":10}]},{"name":"厨房用品","pid":0,"children":[{"name":"餐具","pid":11},{"name":"盘子","pid":11},{"name":"杯子","pid":11},{"name":"勺子","pid":11},{"name":"刀叉","pid":11},{"name":"碟子","pid":11},{"name":"碗架","pid":11}]},{"name":"其他","pid":0,"children":[{"name":"隔断","pid":12},{"name":"窗帘","pid":12},{"name":"沐浴","pid":12},{"name":"浴缸","pid":12}]}]
// str;
// echo "{\"code\":200,\"message\":\"请求成功\",\"data\":$tags}";
//     }


//     // 删除出清商品
//     public function postDcqgood(){
//         $data = Input::all();
//         $rules = array(
//             'access_token' => 'required',
//             'good_id'=>'required',
//         );
//         //请求参数验证
//         parent::validator($data, $rules);
//         $rs = parent::validateAcessToken($data['access_token']);
//         $res = DB::table('cq_goods')->where(['user_id'=>$rs['user_id'],'id'=>$data['good_id']])->first();
//         if($res){
//             DB::table('cq_goods')->where(['user_id'=>$rs['user_id'],'id'=>$data['good_id']])->delete();
//             DB::table('cq_goods_action')->where(['good_id'=>$data['good_id']])->delete();
//             DB::table('cq_comments')->where(['good_id'=>$data['good_id']])->delete();
//             DB::table('cq_cg_record')->where(['good_id'=>$data['good_id']])->delete();
//             return response()->forApi(['status' => 1]);
//         }else{
//             return response()->forApi(array(), 1001, '删除失败！');
//         }
//     }
// }