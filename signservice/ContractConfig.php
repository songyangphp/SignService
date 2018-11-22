<?php

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/2/27
 * Time: ����9:01
 */

namespace wslibs\wscontract;

use think\Session;
use wslibs\wszc\LoginUser;

class ContractConfig
{

//    const WEB_SITE_URL = 'http://zcw.wszx.cc/index.php/admin.php/';



    const PROJECT_PRE = 'zc_';


    public static function getRoot()
    {
        return WEB_SITE_ROOT."admin/";
    }


    public static function getCunChuHtmlPre()
    {

 
        return "http://filestore1.wszx.cc/zhongcai/uploads/sign/gongzheng/";
//        return "http://124.239.196.194:8080/zhongcai/uploads/sign/";
    }
    public static function makePdf0SavePath($c_id)
    {
//    zcdossier
        return "zcdossier/pdf0/".date("Ymd")."/".$c_id.rand(1,100).".pdf";
    }
    public static function getPdf0NoticeUrl($c_no)
    {


        return self::getRoot()."contract/pdf0/c_no/{$c_no}?_s_code_=".Session::getSessionId();


    }

    public static function getGoToSignUrl($c_no,$uid,$id_code=0)
    {
        return self::getRoot()."contract/gotoSign/c_no/".$c_no."/uid/".$uid."/id_code/".$id_code."/_isCrossscreen/1";
    }

    public static function whenCreateContractUrl($c_no,$notify=1)
    {
        return self::getRoot()."contract/whenSign/notify/".$notify."/c_no/".$c_no;
    }


    
    public static function whenSign($c_no,$uid,$id,$notify=1)
    {
//        return self::WEB_SITE_URL."contract/whenSign/c_no/".$c_no."-notify-".$notify."/uid/".$uid."-id-".$id.".html";
        return self::getRoot()."contract/whenSign/c_no/".$c_no."/notify/".$notify."/uid/".$uid."/id/".$id;
    }


}