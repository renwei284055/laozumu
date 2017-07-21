<?php
namespace App\Http\Library;

/**
 * 文字翻译
*
 */
class  WordTranslate
{

      //接口API URL前缀
      const API_URL_PREFIX = 'http://v.juhe.cn/xhzd/query';

      /** 
       * 文字翻译
       * @return array
       */
      static  function translate($data)
     {

          //接口地址
          $url = self::API_URL_PREFIX;
          $params = array(
              "word" => $data['word'],//填写需要查询的汉字，UTF8 urlencode编码
              "key" => $data['key'],//应用APPKEY(应用详细页查询)
              "dtype" => "json",//返回数据的格式,xml或json，默认json
          );
          $paramstring = http_build_query($params);
          $content = self::curl_url($url,$paramstring);
          $result = json_decode($content,true);
          return $result;
     }

     /** 
       * curl
       * @return array
       */
      static protected function curl_url($url,$params=false,$ispost=0)
     {

        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
          curl_setopt( $ch , CURLOPT_POST , true );
          curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
          curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
          if($params){
              curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
          }else{
              curl_setopt( $ch , CURLOPT_URL , $url);
          }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
          //echo "cURL Error: " . curl_error($ch);
          return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
     } 



}
