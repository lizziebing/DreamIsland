<?php


//将数据写入xml类型的字符串传输信息$info
function writeXML($root,$data_array)
{
	//  创建一个XML文档并设置XML版本和编码。。
$dom=new DomDocument('1.0', 'utf-8');
//  创建根节点
$croot = $dom->createElement($root);
$dom->appendchild($croot);
foreach ($data_array as $key => $val) {
            //  创建元素
            $$key = $dom->createElement($key);
           $croot->appendchild($$key);
           //  创建元素值
            $text = $dom->createTextNode($val);
            $$key->appendchild($text);
 
        }
$info=$dom->saveXML();//传输信息
return $info;	
}
/////////修改路况2014.09.11
function Modifyroadinfo($SerialNo,$RadioID,$WeiboID,$No,$Name,$Op)
{
	$data_array = 
    array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'WeiboID' => $WeiboID,
           'No' =>$No,
           'Key' => $Key,
           'Name'=>$Name,
           'Op'=>$Op
           );
  
  $root=  "ModifyIn";
  $info= writeXML($root,$data_array) ;//传给服务器的参数消息
  
  $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
  $clint->ModifyRoadInfo($info);//调用服务端路况修改接口
  //打印服务器端返回的信息
  $result=$clint->ModifyRoadInfo($info);
  print_r($result);
}

////主持人日志添加
//	function  insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo){
//		$data_array = array(
//           'SerialNo'=>$SerialNo,
//           'RadioID' => $RadioID,
//           'rstamp' => $rstamp,//时间戳
//           'hostweibo' =>$hostweibo,//主持人微博账号
//           'op' => $op,//操作码
//           'memo'=>$memo
//           );
//		$root = "InsertIn";
//		$info = $this->writeXML($root,$data_array) ;//传给服务器的参数消息
//		return $info;
//	}



?>