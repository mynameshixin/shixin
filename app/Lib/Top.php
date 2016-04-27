<?php
namespace App\Lib;
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/10/30
 * Time: 下午4:49
 */
use App\Lib\Top\TopClient;
use App\Lib\Top\TaeItemsListRequest;

class Top {

    public static $appKey='';
    public static $appSecret='';

    function test () {
        $itemId = 1;
        $c  = new TopClient();
        $c->appkey = self::$appKey;
        $c->secretKey = self::$appSecret;
        $req = new TaeItemsListRequest();
        $req->setFields('num,title,nick,pic_url,location,cid,price');
        $req->setNumIids($itemId);
        $resp = $c->execute($req);
        print_r($resp);


        $req = new TaobaokeItemsDetailGetRequest;
        $req->setFields("num_iid,detail_url");
        $req->setNick("jayzhou");
        $req->setPid("123456");
        $req->setNumIids("1,2,3");
        $req->setTrackIids("value1,value2,value3");
        $req->setOuterCode("abc");
        $req->setIsMobile("false");
        $req->setReferType("1");
        $resp = $c->execute($req);
    }

}