<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/8/31
 * Time: 上午11:34
 */
namespace App\Services\Admin;

use App\Models\Category;
use App\Services\ApiService;

class CategoryService extends ApiService
{
    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }

    /**
     * 获取子分类
     * @param $category_id
     * @return array
     */
    public function getCategories() {
        $rows = Category::where('level','>','0')->get()->toArray();
        $categories = [];
        if (!empty($rows)) {
            foreach ($rows as $row) {
                if ($row['parent_id']) {
                    $categories[$row['level']][$row['parent_id']][]=$row;
                }else{
                    $categories[$row['level']][]=$row;
                }

            }
        }
        return $categories;
    }
}