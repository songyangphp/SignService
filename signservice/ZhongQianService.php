<?php

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/2/25
 * Time: 上午11:27
 */
namespace wslibs\wscontract\signservice;

use wslibs\wscontract\signservice\zhongqian\ZhongQianConfig;
use wslibs\wscontract\ContractConfig;
/*use wslibs\wscontract\bean\Signer;*/

class ZhongQianService extends SignServiceCommon
{

    public function initUser($signer)
    {


//        $url="http://test.sign.zqsign.com:8081/personReg";
        $zhongQianConfig = new ZhongQianConfig();

        if ($signer->isPersonal()) {

            $userInfo = $signer->getUserInfo();
            $url = $zhongQianConfig->initUserUrl;


            //组合接口需要的参数
            $arr = array(
                "user_name" => $userInfo['real_name'],
                "name" => $userInfo['real_name'],
                "mobile" => $userInfo['phone'],
                "user_type" => $signer->getType(),
                "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
                "user_code" => $signer->getUCode(),  //用户唯一标示
                "id_card_no" => $userInfo['id_card'],//身份证号码
            );


        } else {
            $cominfo = $signer->getCompayInfo();


            $url = $zhongQianConfig->initEntpUrl;
            $arr = array(
                "contact" => $cominfo['f_info']['real_name'],
                "name" => $cominfo['com_name'],
                "mobile" => $cominfo['f_info']['phone'],   //联系人电话
                "user_type" => $signer->getType(),   //用户类型  0企业  1个人
                "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
                "user_code" => $signer->getUCode(),  //用户唯一标示
                "certificate" => $cominfo['credit_code'],  //社会统一代码或营业执照号码
                "address" => $cominfo['address'],

            );


        }

        $res = $this->postToServer($url, $arr, $zhongQianConfig);

        if ($res['code'] == 0 || $res['code'] == "120000") {

            return true;
        } else {
            return false;
        }
    }


    public function createContractByPdf($contract)
    {


        $zhongQianConfig = new ZhongQianConfig();


        $con = base64_encode(file_get_contents($contract->info('pdf0')));

        $notify_url = ContractConfig::whenCreateContractUrl($contract->getNo());

//        $url="http://test.sign.zqsign.com:8081/uploadPdf";
        $url = $zhongQianConfig->createContractByPdfUrl;
        //组合接口需要的参数
        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'contract' => $con,
            'no' => $contract->getNo(),
            'name' => $contract->getName(),
            "notify_url" => $notify_url,   //异步回调

        );


        $res = $this->postToServer($url, $arr, $zhongQianConfig);
 

        if ($res['code'] == 0 || $res['code'] == '120001') {
            return true;
        } else {
            return false;
        }
    }

    public function createContractByTemplate($contract)
    {
        // TODO: Implement createContractByTemplate() method.
    }

    public function signContractAuto($contractSigner)
    {
        $zhongQianConfig = new ZhongQianConfig();


//        $url="http://test.sign.zqsign.com:8081/signAuto";
        $url = $zhongQianConfig->signContractAutofUrl;
        //组合接口需要的参数    
        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'no' => $contractSigner->getHtInfo()['c_no'],
            'signers' => $contractSigner->getSigner()->getUCode(),


        );


        $res = $this->postToServer($url, $arr, $zhongQianConfig);



        if(input('lee')==4){

            echo 'zhongqian';
            dump($res);

        }



        if ($res['code'] == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function signContractH5($contractSigner)
    {
        //回调地址
        //"https://zhygz.wszx.cc/Wscontract-whenSign-c_no-".$no."-notify-1-uid-".$contractSigner->info['uid']."-id-".$contractSigner->info['id'].".html";
        //"https://zhygz.wszx.cc/Wscontract-whenSign-c_no-".$no."-notify-0-uid-".$contractSigner->info['uid']."-id-".$contractSigner->info['id'].".html"

        $zhongQianConfig = new ZhongQianConfig();

        $no = $contractSigner->getHtInfo()['c_no'];

        if (ZhongQianConfig::$is_test_static) {
            $notify_url = ContractConfig::whenSign($no, $contractSigner->info['uid'], $contractSigner->info['id'], 3);
            $return_url = ContractConfig::whenSign($no, $contractSigner->info['uid'], $contractSigner->info['id'], 2);
        } else {

            $notify_url = ContractConfig::whenSign($no, $contractSigner->info['uid'], $contractSigner->info['id'], 1);
            $return_url = ContractConfig::whenSign($no, $contractSigner->info['uid'], $contractSigner->info['id'], 0);
        }


        $url = $zhongQianConfig->signContractH5Url;
        //接口地址
//		$url="http://test.sign.zqsign.com:8081/signView";
//        $url="http://test.sign.zqsign.com:8081/mobileSignView";
//		$url="http://test.sign.zqsign.com:8081/videoSignView";
        //组合接口需要的参数


        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'no' => $no,
            'user_code' => $contractSigner->getSigner()->getUCode(),
            "sign_type" => ZhongQianConfig::getQsTypeByint($contractSigner->getQsType()),
            "notify_url" => $notify_url,   //异步回调
            "return_url" => $return_url,   //同步可省略
        );


        //签字sign规则
        $ws_sign_val = $zhongQianConfig->Sign($arr, $zhongQianConfig->get_private_key());
        $arr['sign_val'] = $ws_sign_val;

        return array("url" => $url, "args" => $arr);
    }

    public function getContractPdfBase64($c_no)
    {
        $zhongQianConfig = new ZhongQianConfig();


//        $url="http://test.sign.zqsign.com:8081/getPdf";
        $url = $zhongQianConfig->getContractPdfBase64Url;

        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),
            'no' => $c_no,
        );

        //签字sign规则
        $ws_sign_val = $zhongQianConfig->Sign($arr, $zhongQianConfig->get_private_key());
        $arr['sign_val'] = $ws_sign_val;

        //得到结果

        $content = $zhongQianConfig->curlPost($url, $arr);

        if (json_decode($content, true)['code'] || !$content) {
            return false;
        } else {
            return base64_encode($content);
        }
    }

    public function getContractImagesUrl($c_no)
    {
        $zhongQianConfig = new ZhongQianConfig();

//        $notify_url = "http://127.0.0.1:8080";

        //接口地址
//        $url="http://test.sign.zqsign.com:8081/getImg";
        $url = $zhongQianConfig->getContractImagesUrlUrl;
        //组合接口需要的参数
        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'no' => $c_no,
//            "notify_url"=>$notify_url,   //异步回调
        );

        $result = $this->postToServer($url, $arr, $zhongQianConfig);

        if ($result['code'] == 0) {

            $out = array();
            foreach ($result['imgList'] as $value) {
                $out[] = $value . '.jpg';
            }
            return $out;
        } else {
            return false;
        }


    }

    public function getContractPdfUrl($c_no)
    {
        $zhongQianConfig = new ZhongQianConfig();


        $url = $zhongQianConfig->getContractPdfUrl;

        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'no' => $c_no,
        );

        $result = $this->postToServer($url, $arr, $zhongQianConfig);

        if ($result['code'] == 0) {


            return $result['pdfUrl'];
        } else {
            return false;
        }
    }

    private function postToServer($url, $arr, $zhongQianConfig)
    {

        $ws_sign_val = $zhongQianConfig->Sign($arr, $zhongQianConfig->get_private_key());
        $arr['sign_val'] = $ws_sign_val;
        //得到结果
        $content = $zhongQianConfig->curlPost($url, $arr);
        return json_decode($content, true);
    }

    public function completionContract($c_no)
    {
        $zhongQianConfig = new ZhongQianConfig();


        $url = $zhongQianConfig->completionContractfUrl;

        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'no' => $c_no,
        );

        $result = $this->postToServer($url, $arr, $zhongQianConfig);

        if ($result['code'] == 0) {


            return true;
        } else {
            return false;
        }
    }

    public function signatureChange($signer, $img_file)
    {
        $zhongQianConfig = new ZhongQianConfig();

        $arr = array(
            "zqid" => $zhongQianConfig->get_zqid(),  //众签唯一标示
            'user_code' => $signer->getUCode(),
            "signature" => base64_encode(file_get_contents($img_file)),


        );



        $result = $this->postToServer($zhongQianConfig->signatureChangeUrl, $arr, $zhongQianConfig);

 

        if ($result['code'] == 0) {


            return true;
        } else {

            return false;
        }
    }
}