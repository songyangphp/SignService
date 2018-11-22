<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/26
 * Time: 7:28
 */
namespace wslibs\wscontract\signservice\zhongqian;
class ZhongQianConfig
{






//    private $is_test = true;
     public $is_test = false;

     public static $is_test_static = false;
//     public static $is_test_static = true;


    //测试
    public $initUserUrl = 'http://test.sign.zqsign.com:8081/personReg';
    public $initEntpUrl = 'http://test.sign.zqsign.com:8081/entpReg';
    public $createContractByPdfUrl = 'http://test.sign.zqsign.com:8081/uploadPdf';
    public $signContractAutofUrl = 'http://test.sign.zqsign.com:8081/signAuto';
    //            $this->signContractH5Url = 'http://sign.zqsign.com/mobileSignView';
//    public $signContractH5Url = 'http://test.sign.zqsign.com:8081/signView';
    public $signContractH5Url = 'http://test.sign.zqsign.com:8081/signViewNT';
    public $getContractPdfBase64Url = 'http://test.sign.zqsign.com:8081/getPdf';
    public $getContractImagesUrlUrl = 'http://test.sign.zqsign.com:8081/getImg';
    public $getContractPdfUrl = 'http://test.sign.zqsign.com:8081/getPdfUrl';
    public $completionContractfUrl = 'http://test.sign.zqsign.com:8081/completionContract';

    public $signatureChangeUrl = 'http://test.sign.zqsign.com:8081/signatureChange';




    

//
//    正式
//    public $initUserUrl = 'http://sign.zqsign.com/personReg';
//    public $initEntpUrl = 'http://sign.zqsign.com/entpReg';
//    public $createContractByPdfUrl = 'http://sign.zqsign.com/uploadPdf';
//    public $signContractAutofUrl = 'http://sign.zqsign.com/signAuto';
//    public $signContractH5Url = 'http://sign.zqsign.com/mobileSignView';
//    public $getContractPdfBase64Url = 'http://sign.zqsign.com/getPdf';
//    public $getContractImagesUrlUrl = 'http://sign.zqsign.com/getImg';

    public function __construct()
    {
        if(!$this->is_test){
            $this->initUserUrl = 'http://sign.zqsign.com/personReg';
            $this->initEntpUrl = 'http://sign.zqsign.com/entpReg';
            $this->createContractByPdfUrl = 'http://sign.zqsign.com/uploadPdf';
            $this->signContractAutofUrl = 'http://sign.zqsign.com/signAuto';
//            $this->signContractH5Url = 'http://sign.zqsign.com/mobileSignView';
//            $this->signContractH5Url = 'http://sign.zqsign.com/SignView';
            $this->signContractH5Url = 'http://sign.zqsign.com/signViewNT';
            $this->getContractPdfBase64Url = 'http://sign.zqsign.com/getPdf';
            $this->getContractImagesUrlUrl = 'http://sign.zqsign.com/getImg';
            $this->getContractPdfUrl = 'http://sign.zqsign.com/getPdfUrl';
            $this->completionContractfUrl = 'http://sign.zqsign.com/completionContract';


            
            $this->signatureChangeUrl = 'http://sign.zqsign.com/signatureChange';
        }
    }


    public function get_private_key(){
        if($this->is_test){
                return  "MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBANIwqMKRiZMTMerWYJsp54AoM UcIbgZsdB4FjtGAzabh/NYH9ptNgNBfBo78yShPCP5c0wB0MVqg3wv5ExQRcCA5uj1ajO+FuHy5ESx mDDftxOzQlpHlMdvxCLZwJjy0+Il2AsZcbcSy3HMDN8HGhOG01A9rllbx6JnyC8hFdd+7AgMBAAECg YBztZHRuqjPrGt4ahe4k3L73CR0hDF9m8q4lDqxHoUX76RudufNSvc0vnsvz/01EX1T+em2gECDMbh YMP/ NtmPQegoVIsojSGSSF8Q+q7JOCQlDi9JXiRMkoj+uSMeSqa4EbqOdoFAj+F8BlzYJCUCdfdcJRR4 Zb8seFNlpUfDToQJBAPMGQt8dWfFGDGlo9Tnif5GIlz09Of7odn/NOyFb6c+fca0ufrg816GWGgLBl0q nj8bO/93P+EY0MWsVF8RytRkCQQDdaZtWGm9YImGT+PKdKapQvt0C5RAfi2OAnRndqCs8bA1K1k PII8hg/t2QFPshx48pqayJ7ve5/dmeig1y0eHzAkAKWnHu32k9hiZxNy97T9LveEo5KaqW2YBy4WNrg GbtmXVWU2zCnJTzJVnmVCkF3S2a4qaz5HBHTWHtlfB1Rg3BAkEA0cpr3fTkRX0mOf/rWhENiL6gSU rjsQ/ w8v9ob8cVWIYFPkCxLuUAyy8Snp/SqFofA1n62yMrZPbriTXDsmS+EwJBAOFhYJS/x04TKX3H4i GDXLKLTSaQWoDyHBIZG61HSLVI8UTTre/Efc8jrs6GnYXkXAA0KeAcUQDxdeF0YRFhc2g=";
        }else {
            return "MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMzKMJUqv774cXcS3xPxUMNnLhx8b3zacq8x46SCk83rTEAX5un1CNQdPQ+Itgg3xPxAs0t9mw21sERGYE1BAru4R230jPdV1nHJKL2t2+6wAEmfHPFwR+uULwP+pRMfbad7LeNzjgAK+zb8T7dWfkEN8k/4jRXtoFvvXCmtKTx1AgMBAAECgYEAmqSf9TR34SzY+dLtU7DpjPUQdABfbAfFjJh+z46vMFNbnBawj8EyboK5xk41L5V1kgsFmZ77BGpL9fKy7AOInH/YyghCMXBSxIgaHGiBkJqNLT9DYsY3Dhh2N4MI+oqWLmp+1UPD0s8yPS7TkidceX1Wgg+Hbux1OOylCaFgXCECQQD3nVE/y94eF7tIcX7iYIgAs7cFBJxADBjctdwFjzgsKq5pSx1mKA3Ci4Y2YK+HqOl8vFk0u6u2i3l3INANuE85AkEA07mbAax0hXdanNev1ui2rBUtbxRS140KalrEBDGz+EKRxknMNcrtm0jgZO2foxlEitp1gqMpdjc1tk0fZRdbHQJBAKB9AYVU8JEWlpd8oF2/bUbvNGd3NoK4lICxCns7+Y9+1m5+df6ZZVm7rvCduAc4bqUfOr5YCRKW0dJpnQ/XbtkCQCbHxGCWGfGoXuyDhS20CmGSr3O9IT9iEhpQ7b5m7DP43YKYWdMwjDz5KEDUVX0mT6uvP/7hq+J/UlNF5Q47LPECQDSVNEOAWQsW7AX3MxRe9J+THU2DoHIFwpmLSz+X01ryjsdtqpdNo2A04ZAhQlOz2Zxbo904WHTmg1NL434+HiA=";

        }

    }

    public function get_public_key(){
        if($this->is_test) {
        return   "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDSMKjCkYmTEzHq1mCbKeeAKDFHCG4GbHQ eBY7RgM2m4fzWB/abTYDQXwaO/MkoTwj+XNMAdDFaoN8L+RMUEXAgObo9Wozvhbh8uREsZgw 37cTs0JaR5THb8Qi2cCY8tPiJdgLGXG3EstxzAzfBxoThtNQPa5ZW8eiZ8gvIRXXfuwIDAQAB";
        }else{
            return   "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC6N8jbOIzTwEhDUzdlbHZT7+eI7+/nSM6KGXtiuF3qve4orUe6wa8hzEs7soFlV4JnzdvRvakE2LIQI9N3FqxqZ0h2dANO9DprnaEWOtuf/XReAQoE4oqxEJ2Tcsd+lPy9XA8fq6YwetWc8kTsf86uZO8oHcLLLHrsA/jDoRF/uwIDAQAB";
        }

    }

    //众签唯一标示
    public function get_zqid(){
        if($this->is_test) {
        return "ZQABA206A379B342FB987B8DCCBA679549";
        }else {
            return "ZQ999134654C2647B8B071EA458F276CBA";
        }
    }
    /**
     * curl post
     */
    public function curlPost($url, $postData = array() )
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //设置返回值
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        //得到结果
        $result = curl_exec($ch);
        curl_close($ch); //关闭curl
        return $result;
    }


//参数排序
    /**
     * 数组排序
     * @param query  需要排序的数组
     * @return  排序后拼接成arg0=1&arg1=2&..........
     */
    public function buildQuery( $query ){
        if ( !$query ) {
            return null;
        }
        //将要 参数 排序
        ksort( $query );
        //重新组装参数
        $params = array();
        foreach($query as $key => $value){
            $params[] = $key .'='. $value ;
        }
        $data = implode('&', $params);
        return $data;
    }


    /**
     * 私钥签名签名
     * @param content  代签名字符串
     * @param privateKey
     * @return  签名后的数据
     */
    public function Sign($query = array(),$privateKey){




        if( ! is_array( $query ) ){
            return null;
        }
        //排序参数，
        $data = $this->buildQuery( $query );
        // 私钥密码
        $passphrase = '';
        $key_width = 64;
        $p_key = array();
        //如果私钥是 1行
        if( ! stripos( $privateKey, "\n" )  ){
            $i = 0;
            while( $key_str = substr( $privateKey , $i * $key_width , $key_width) ){
                $p_key[] = $key_str;
                $i ++ ;
            }
        }else{
            //echo '一行？';
        }

        //将一行代码
        $privateKey = "-----BEGIN PRIVATE KEY-----\n" . implode("\n", $p_key) ;
        $privateKey = $privateKey ."\n-----END PRIVATE KEY-----";

        $pkeyid = openssl_get_privatekey($privateKey);

        openssl_sign($data, $sign, $pkeyid);
        openssl_free_key($pkeyid);
        $sign = base64_encode($sign);
        return $sign;
    }

    public static function getQsTypeByint($type)
    {
        $signTypes = array(
            1=>'SIGNATURE',//签章不验证签署
            2=>'SIGNATURECODE',//签章验证签署
            3=>'WRITTEN',//手写不验证签署
            4=>'WRITTENCODE',//手写验证签署
            5=>'CODE',//短信验证签署
        );

        $res = $signTypes[$type] ? $signTypes[$type] : $signTypes[3];
        return $res;
    }
}