<?php
namespace App\Http\Controllers\Web;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class TloginController extends Controller
{
    public function getQq(){
        require_once("tlogin/qq/qqConnectAPI.php");
        $qc = new \QC();
        $login_url = $qc->qq_login();
        header("Location: $login_url"); 
        die();
        
    }

    public function getQqback(){
        require_once("tlogin/qq/qqConnectAPI.php");
        $qc = new \QC();
        var_dump($qc->qq_callback());
        var_dump($qc->get_openid());

    }
}