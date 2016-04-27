<?php
/**
 * User: gyd
 * Date: 15/9/9
 * Time: 下午8:11
 */
namespace App\Lib;

class Requests
{

    public static function md5($str)
    {
        return md5(md5($str));
    }

    public static function getSign($params, $key)
    {
        unset($params['sign']);
        $param_values = array_values($params);
        $param_values[] = $key;
        sort($param_values, SORT_STRING);
        $value_string = implode('|', $param_values);
        return substr(self::md5($value_string), 9, 6);
    }

    public static function password($pwd, $salt)
    {
        return self::md5($pwd . $salt);
    }
    
    /**
     * 对query进行分页操作但不最终运行
     *
     * @param Builder $query query
     * @param int     $page  page
     * @param int     $take  take
     *
     * @return Builder
     */
    public static function paging($query, $page, $take)
    {
        if ($page < 1) {
            $page = 1;
        }
        $skip = ($page - 1) * $take;
        return $query->take($take)->skip($skip);
    }
    
    /**
     * 获得字符串的长度 中文两字节 字符一字节
     * @param type $str
     * @return type
     */
    public static function getStrLength($str) {
        return (mb_strlen(trim($str), 'UTF-8') + strlen(trim($str))) / 2;
    }
    
    /**
     * 10.55元转成1055分
     *
     * @param $price float
     *
     * @return int
     */
    public static function priceConvertBig($price)
    {
        return $price * 100;
    }

    /**
     * 1055分转成10.55元
     *
     * @param $price int
     *
     * @return float
     */
    public static function priceConvertSmall($price)
    {
        return $price / 100;
    }
    
    /**
     * 获取ids
     * @param $lists
     * @return array
     */
    public static function getIds($lists, $key='id'){
        $ids = [];
        foreach ($lists as $data){
            $ids[] = $data->$key;
        }
        if(empty($ids)){
            $ids[] = -1;
        }
        return $ids;
    }
    
    /**
     * 截取指定长度的字符串
     * @param string $str
     * @param int $length
     * @return string
     */
    public static function mbSubstr($str, $length=20 ,$encode='UTF-8'){
        return mb_strlen(trim($str), $encode) > $length ? mb_substr($str, 0, $length, $encode) . '...' : $str;
    }
}