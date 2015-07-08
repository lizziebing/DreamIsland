<?php
include('Modifyifo.php');

//主持人日志添加
function  insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo)
{
	$data_array = 
    array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'rstamp' => $rstamp,//时间戳
           'hostweibo' =>$hostweibo,//主持人微博账号
           'op' => $op,//操作码
           'memo'=>$memo,
           );
  
  $root=  "InsertIn";
  $info= writeXML($root,$data_array) ;//传给服务器的参数消息
  $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
//  $clint=new SoapClient('http://42.121.125.50/bsys/webservice/webserver.wsdl');
  $response= $clint->InsertHostLog($info);//调用服务端添加主持人日志接口输出返回值
  print_r($response);
  
  
  $dom = new DOMDocument();
  $dom->loadXML($response);
  $infos = $dom->getElementsByTagName("InsertOut"); 
  
  foreach ($infos as $info)
  {
  	$OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
    $ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
    $op=$info->getElementsByTagName("op")->item(0)->nodeValue;//
  }
  
  if ($op=="success"&&$OK==00)
   {
  	echo "亲~添加日志成功啦";
   }
  else 
  echo "亲~添加日志失败了"+$ErrorInfo;
  
	
}
// 主持人日志删除
function deleteHostLog($SerialNo,$RadioID,$rstamp) 
{
	$data_array = 
    array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'rstamp' => $rstamp,//时间戳
          );
  
  $root=  "DeleteIn";
  $info= writeXML($root,$data_array) ;//传给服务器的参数消息
  $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
  $response= $clint->DeleteHostLogt($info);//调用服务端删除主持人日志接口输出返回值
  print_r($response);
  
  $dom = new DOMDocument();
  $dom->loadXML($response);
  $infos = $dom->getElementsByTagName("DeleteOut"); 
  
  foreach ($infos as $info)
  {
  	$OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
    $ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
    $op=$info->getElementsByTagName("op")->item(0)->nodeValue;//
  }
  
  if ($op=="success"&&$OK==00)
   {
  	echo "亲~删除日志成功啦";
   }
  else 
  echo "亲~删除日志失败了"+$ErrorInfo;
  
}
function getActivityList($SerialNo,$RadioID,$FreqID,$ShakeID,$Starttime,$Endtime){
	$data_array = array('SerialNo'=>$SerialNo,
			'RadioID' => $RadioID,
			'FreqID' => $FreqID,
			'ShakeID' =>$ShakeID,
			'Starttime' => $Starttime,
			'Endtime' => $Endtime,
	);
	$root = "GetActivityIn";
	$info = writeXML($root,$data_array) ;//传输信息
	$clint=new SoapClient('http://42.121.125.50/bsys/webservice/webserver.wsdl');
	// 	$clint->getActivityList($info);//调用服务端路况修改接口
	//打印服务器端返回的信息
	$result=$clint->getActivityList($info);
	print_r($result);
	// 	return $info;
}

?>