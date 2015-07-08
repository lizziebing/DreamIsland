<?php
header("Content-Type:text/html; charset=utf-8");
$clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
echo '<xmp>';
echo "提供的方法\n";
print_r($clint->__getFunctions());


try {

$clint->InsertRoadInfo($info);
echo '</xmp>';
print_r($clint->__saveInter(array()));
}
catch (SoapFault $f)
{
	echo 'error:'.$f -> faultstring; //打印错误信息
	//var_dump($client->__InsertRoadInfoResponse());打印服务器端返回的错误信息
}

?>