<?php
namespace App\Http\Library;

/**
 * 微信授权相关接口
 */
class OauthSign {

    public $token;
     
    /**
     * 从微信获取用户信息
     * @param type $Appid
     */
    public static function GetUserInfoFromWechat($token,$openid)
    {
        
        $url="https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}";
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL,$url);
        curl_setopt($tuCurl, CURLOPT_HEADER,false);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($tuCurl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($tuCurl, CURLOPT_TIMEOUT, 5);
        $data=false;
        try{
            $tuData = curl_exec($tuCurl);
            //var_dump($tuData);
            if(!curl_errno($tuCurl)){
                $info = curl_getinfo($tuCurl);
                if($info['http_code']!=200){
                    return false;
                } else{
                    $data_ar=json_decode($tuData);
                    if(isset($data_ar->openid)){
                        $data=$data_ar;
                    }elseif($data_ar->errcode=='40001'||$data_ar->errcode=='42001'){
                        return false;
                    }
                }
            } else {
                Yii::info(curl_error($tuCurl));
            }
        }catch (Exception $e){
            return false;
        }
        curl_close($tuCurl);
        //var_dump($data);
        return $data;
    }


    //发送短信
    public static function sendMessage($senddata){
        $host = "http://sms.market.alicloudapi.com";
        $path = "/singleSendSms";
        $method = "GET";
        $appcode = "57fc3167f5f341c39884bd8cef9eed66";
        $ParamString = urlencode('{"no":"'.$senddata['rand'].'"}');
        $RecNum = $senddata['phone'];
        $SignName = "老祖母";
        $TemplateCode = "SMS_27630120";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "ParamString={$ParamString}&RecNum={$RecNum}&SignName={$SignName}&TemplateCode={$TemplateCode}";
        $url = $host . $path . "?" . $querys;
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);

        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }

        $data = curl_exec($curl);//抓取URL并把他传递给浏览器
        curl_close($curl);//释放资源 
        $res = explode("\r\n\r\n",$data);
        return json_decode($res[1]); 
    }

    
}
