<?php
namespace App\Http\Controllers\Web;

use App\Lib\LibUtil;
use App\Models\Folder;
use App\Models\FolderGood;
use App\Models\GoodAction;
use App\Models\Product;
use App\Services\TaoBaoService;
use App\Services\FancyService;
use Illuminate\Support\Facades\Input;
use App\Services\ProductService;
use App\Models\Shop;

class SearchController extends CmController{


	public function postIndex(){
		$data = [
			'self_id'=>$this->user_id,
			'self_info'=>$this->self_info,
			'user_info'=>!empty($user_info)?$user_info:[],
		];
		return view('web.search.index',$data);
	}

	//获取商品或图集
	public function postGoods(){
		$data = Input::all();

        $rules = array(
            'kind' => 'in:1,2',
            'category_id' => 'exists:categories,id',
            'folder_id' => 'exists:folders,id',
            'user_id' => 'exists:users,id',
        );
        $self_id = $uid = 0;
        $uid = isset($data['user_id'])?$data['user_id']:0;
        //请求参数验证
        parent::validator($data, $rules);
        if (isset($data['folder_id']) && $data['folder_id']) {
            $folder = Folder::find($data['folder_id'])->toArray();
            if($folder){
                $uid = $folder['user_id'];
                $self_id = $folder['user_id'];
            }
            $data['password'] = isset($data['password']) ? $data['password'] : '';
            if ($folder['private']>0 && $folder['password']!=$data['password']) {
                $access_token = Input::get('access_token');
                $rs = parent::validateAcessToken($access_token);
                if ($rs['user_id'] !=$folder['user_id']){
                    return response()->forApi(array(), 1001, '无权限查看该文件夹');
                }
            }
        }
        
        if (isset($data['access_token']) && $data['access_token']) {
            $rs = parent::getToken($data['access_token']);
            $self_id = isset($rs['user_id']) ? $rs['user_id'] : 0;
        }

        $num = isset($data['num']) ? $data['num'] : 20;
        $data['sort'] = isset($data['sort']) ? $data['sort'] : 0;
        //先搜索folders 查询到结果后返回id
        

        $rs = ProductService::getInstance()->getProductList ($data,$num,$self_id,$uid);
        return response()->forApi($rs);
	}

	// 获得文件夹
	public function postFolder(){
        $params = Input::all();
        $num = isset($params['num']) ? $params['num'] : 10;

        if (isset($params['user_id']) && $params['user_id']!=self::$user_id) {
            $params['private'] = 0;
        }
        $params['current_uid'] = self::$user_id;


        $outData = FolderService::getInstance()->getFolders($params,$num);
        return response()->forApi($outData);
    }







}