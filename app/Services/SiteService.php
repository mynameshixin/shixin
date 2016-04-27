<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/7/23
 * Time: 上午11:23
 */
namespace App\Services;


use App\Lib\LibUtil;
use App\Models\SiteVersion;


class SiteService extends ApiService
{

    /**
     * @return Service_Pay
     */
    public static function getInstance()
    {
        return parent::getInstance();
    }
    /**
     * 检查是否有版本更新
     *
     * @param $current_version 当前版本
     *
     * @return array()
     */
    public function checkUpdate($current_version, $ct) {
        $row = SiteVersion::where ( 'ct', '=', $ct )->orderBy ( 'version', 'desc' )->first ();
        $version = array ();
        if (method_exists ( $row, 'toArray' )) {
            $version = $row->toArray ();
        }
        $last_version = isset ( $version ['version'] ) ? $version ['version'] : '';

        $is_update = LibUtil::isSecondBigger ( $current_version, $last_version );
        if ($is_update) {
            $version = array (
                'version' => $version ['version'],
                'version_code' => $version ['version_code'],
                'url' => $version ['url'],
                'content' => $version ['content'],
                'time' => strtotime ( $version ['time'] ),
                'status' => isset ( $version ['status'] ) ? $version ['status'] : 0,
                'app' => isset ( $version ['app'] ) ? $version ['app'] : 1
            );
        }
        return $is_update ? $version : array ();
    }

}