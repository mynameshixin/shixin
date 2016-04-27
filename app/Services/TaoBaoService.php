<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/11/9
 * Time: 下午2:09
 */
namespace App\Services;

use App\Lib\LibUtil;
use App\Lib\Top\TopClient;
use App\Lib\Top\Request\ProductGetRequest;
use App\Lib\Top\Request\TaeItemsListRequest;
use App\Lib\Top\Request\TaeItemDetailGetRequest;
use App\Lib\Top\Request\ItemGetRequest;


class TaoBaoService extends ApiService
{
    //private static $appkey = '23272989';
    //private static $secret = '29af8863a7cd37fd34fe966ef7ebdb86';
    private static $appkey = '23272989';
    private static $secret = '29af8863a7cd37fd34fe966ef7ebdb86';
    private static $sessionKey = '29af8863a7cd37fd34fe966ef7ebdb86';

    public function getItemDetail ($id) {
        $c = new TopClient;
        $c->appkey = self::$appkey;
        $c->secretKey = self::$secret;
        //$c->nick = '廷廷严';
        //$itemId = 524840728568;
        $req = new TaeItemsListRequest();
        $req->setFields('num,title,nick,pic_url,location,cid,price');
        $req->setNumIids($id);
        $resp = $c->execute($req);
        //数据存入 redis

        if (isset($resp['items']) && !empty($resp['items'])) {
            $product = $resp['items'];
            $open_iid = $product['x_item'][0]['open_iid'];
            $product['mobile_desc_info'] = self::getDetail($id,$open_iid);
            return $product;
        }

        return false;


    }
    public function getDetail ($id,$open_iid) {
        $c = new TopClient;
        $c->appkey = self::$appkey;
        $c->secretKey = self::$secret;
        //$c->nick = '廷廷严';
        //$itemId = 524840728568;
        $req = new TaeItemDetailGetRequest();
        //$req->setFields("itemInfo,priceInfo,skuInfo,stockInfo,rateInfo,descInfo,sellerInfo,mobileDescInfo,deliveryInfo,storeInfo,itemBuyInfo,couponInfo");
        $req->setFields("descInfo,sellerInfo,mobileDescInfo");
        $req->setId($id);
        $req->setOpenIid($open_iid);
        //$req->setOpenIid('AAHqwaEbACI85PW75Ej69syV');
        $resp = $c->execute($req);
        //return $resp;
        if (isset($resp['data']['mobile_desc_info'])) {
            $detail = $resp['data']['mobile_desc_info'];
        }

        //数据存入 redis
        return isset($detail) ? $detail : false;

    }


}