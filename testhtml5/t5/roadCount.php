<?php
include('Modifyifo.php');

function getroadcount($SerialNo,$RadioID,$WeiboID,$MaxIsMark,$MaxIsMark){
	$data_array = 
    array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'WeiboID' => $WeiboID,
           'MaxIsMark' =>$MaxIsMark,
           'MaxIsMark' => $MaxIsMark,
           );
  
  $root=  "QueryIn";
  $info= writeXML($root,$data_array) ;//传给服务器的参数消息
  $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
  $response= $clint->getRoadCount($info);//调用服务端路况修改接口获得返回值
  print_r($response);
  
  $dom = new DOMDocument();
  $dom->loadXML($response);
  $infos = $dom->getElementsByTagName("QueryOut"); 
  
  foreach ($infos as $info){ 
  $OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
  
  $MarkCount=$info->getElementsByTagName("MarkCount")->item(0)->nodeValue;//最新标记数
  
  $NoCount=$info->getElementsByTagName("NoCount")->item(0)->nodeValue;//[最新路况数]
 
  $ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
 // print_r("$OK,$MarkCount,$NoCount,$ErrorInfo") ;
 
  } 
   $resarray=
  array(
         'OK'=>$OK,
         'ErrorInfo'=>$ErrorInfo,
         'NoCount'=>$NoCount,
         'MarkCount'=>$MarkCount
        );
  
  return $resarray;
}







?>