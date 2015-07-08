<?php
include('Modifyifo.php');
///天气预报查询接口2014.09.17
function queryWeather($SerialNo,$RadioID,$Location){
	$data_array = 
    array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'Location'=>$Location
           );
  
  $root=  "QueryWeatherIn";
  $info= writeXML($root,$data_array) ;//传给服务器的参数消息
  $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
  $response= $clint->QueryWeather($info);//调用服务端路况修改接口获得返回值
  print_r($response);
  
  $dom = new DOMDocument();
  $dom->loadXML($response);
  $infos = $dom->getElementsByTagName("DeleteOut"); 
  
  foreach ($infos as $info){ 
  $OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
  $ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
  $WeatherInfo=$info->getElementsByTagName("WeatherInfo")->item(0)->nodeValue;
  //解析天气信息weatherInfo
//  $weatherInfos=$dom->getElementsByTagName("WeatherInfo");
//  foreach ($weatherInfos as $wInfo)
//  {
//  	$Temperature=$wInfo->getElementsByTagName("Temperature")->item(0)->nodeValue;//气温
//  	$Wind=$wInfo->getElementsByTagName("Wind")->item(0)->nodeValue;//风力
//  	$pm=$wInfo->getElementsByTagName("pm2.5")->item(0)->nodeValue;//空气污染度
//  }
 // print_r("$OK,$MarkCount,$NoCount,$ErrorInfo") ;
 
  } 
  $obj=json_decode($WeatherInfo);  
  echo $obj->weatherinfo->city.'：'.$obj->weatherinfo->temp.':'.$obj->weatherinfo->WD; 
  $Weather=array
  (
     'city'=>$obj->weatherinfo->city,
     'Temperature'=>$obj->weatherinfo->temp,
     'Wind'=>$obj->weatherinfo->WD,
     'pm2.5'=>$pm
  
  );
  
   $weatherarray=
  array(
         'OK'=>$OK,
         'ErrorInfo'=>$ErrorInfo,
         'WeatherInfo'=>$WeatherInfo
        );
  print_r($weatherarray);
  $w=$weatherarray[WeatherInfo];
  print_r($w);
  //print_r($w[weatherinfo][city]);
  return $weatherarray;
}





?>