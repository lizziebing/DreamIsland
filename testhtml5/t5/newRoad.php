<?php
include('Modifyifo.php');

function queryNewRoadCount($SerialNo,$RadioID,$WeiboID,$MaxNo,$MaxIsMark){
	$data_array = 
    array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'WeiboID' => $WeiboID,
           'MaxNo' =>$MaxNo,
           'MaxIsMark' => $MaxIsMark,
           );
  
  $root=  "QueryIn";
  $info= writeXML($root,$data_array) ;//传给服务器的参数消息
  $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
  $response= $clint->queryNewRoadCount ($info);//调用服务端路况修改接口获得返回值
  print_r($response);
  
  $dom = new DOMDocument();
  $dom->loadXML($response);
  $infos = $dom->getElementsByTagName("QueryOut"); 
  
  foreach ($infos as $info){ 
  $OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
  if ($OK=='00') {
  	$MarkCount=$info->getElementsByTagName("MarkCount")->item(0)->nodeValue;//最新标记数
  
  $NoCount=$info->getElementsByTagName("NoCount")->item(0)->nodeValue;//[最新路况数]
  $NewMaxNo=$info->getElementsByTagName("NewMaxNo")->item(0)->nodeValue;//最新标记数
  
  $NewMaxIsmark=$info->getElementsByTagName("NewMaxIsmark")->item(0)->nodeValue;//[最新路况数]
  
  }
  else 
  $ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
 // print_r("$OK,$MarkCount,$NoCount,$ErrorInfo") ;
 
  } 
   $resarray=
  array(
         'OK'=>$OK,
         'ErrorInfo'=>$ErrorInfo,
         'NoCount'=>$NoCount,
         'MarkCount'=>$MarkCount,
         'NewMaxNo'=>$NewMaxNo,
         'NewMaxIsmark'=>$NewMaxIsmark
        );
  
  return $resarray;
}
?>