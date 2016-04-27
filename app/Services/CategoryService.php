<?php
namespace App\Services;

/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/10
 * Time: 下午3:36
 */
use \App\Models\Category;
use \App\Lib\LibUtil;

class CategoryService extends \App\Services\ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    //图片文件夹
    public static $image_dir = '';

    public function __construct()
    {
        self::$image_dir = \Config::get('farm.categories_image_dir');
    }

    /**
     * 新增分类
     * @param $params
     * @param array $file
     */
    public function addCategory($params, $file = array())
    {
        $entry = [
            'name' => $params['name'],
            'name_e' => $params['name_e']
        ];
        $categoryId = Category::insertGetId($entry);
        return $categoryId;
    }

    /**
     * 修改分类
     * @param $categoryId
     * @param $params
     * @param array $file
     * @return bool
     */

    public function editCategory($categoryId,$params,$file=array()){
        //上传图片
        if (isset($params['name']) && !empty($params['name'])) $entry['name']= $params['name'];
        if (isset($params['name_e']) && !empty($params['name_e'])) $entry['name_e']= $params['name_e'];
        if (isset($entry) && !empty($entry)) $rs = Category::where(['id'=>$categoryId])->update($entry);

        return true;
    }

    public function delCategory ($categoryId) {
        $rs = Category::where(['id'=>$categoryId])->delete();
        return $rs;
    }

    /**
     * 分类树
     * @param int $pid
     * @param int $level
     * @param int $kind
     * @param array $perms
     * @return array
     */
    function getCategoryTree($pid = 0, $level = 0,$kind=1)
    {

        $data = Category::where(['parent_id' => $pid, 'level' => $level,'kind'=>$kind])->get()->toArray();
        //目录树
        $tree = array();
        //层级
        $level++;
        if (!empty($data)) {
            foreach ($data as $k => $v) {
                $entry = ['id' => $v['id'], 'name' => $v['name'],'name_e'=>$v['name_e'],'level' =>$v['level']];
                if($v['level']<2) {
                    $entry['children'] = self::getCategoryTree($v['id'], $level, $kind);
                }

               // if($v['image_id'])$entry['img'] = LibUtil::getPicUrl($v['image_id'],3);

                $tree[] = $entry;
            }
        }
        //$tree = json_encode($tree);
        return $tree;
    }

    function updateCategoryHot($id){
        $hot = Category::where('id',$id)->increment('hot');
        $hot = $hot + 1;
        Category::where('id',$id)->update(['hot'=>$hot]);
        return true;
    }

}