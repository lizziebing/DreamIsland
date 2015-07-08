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
/////////调用查询路况信息
   function roadinfoquery($info)
   {
         $clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
      
         	   //print_r($clint->__getFunctions());
                $clint->RoadInfoQuery($info);
               $result=$clint->RoadInfoQuery($info);//打印服务器端返回的错误信息                
               //var_dump($clint->RoadInfoQuery($info));//打印服务器端返回的错误信息 
               return $result;
           
   }
function queryinfo($SerialNo,$RadioID,$Type,$Situation,$Key,$Value,$Page,$PageCount)
{
	$data_array = 
    array(
    'SerialNo'=>$SerialNo,
    'RadioID' => $RadioID,
    'Type' => $Type,
    'Situation' =>$Situation,
     'Key' => $Key,
     'Value'=>$Value,
     'Page'=>$Page,
     'PageCount' =>$PageCount
    );
  
  $root=  "QueryIn";
 $info= writeXML($root,$data_array) ;//传输信息

 $xmlstring=roadinfoquery($info);
 $queryArr=readXML($xmlstring);
 
// print_r($queryArr);
 return $queryArr;
}


function readXML($xmlstring){
//echo $xmlstring;
$dom = new DOMDocument();
$dom->loadXML($xmlstring);

//print_r(getArray($dom->documentElement));
$arry=getArray($dom->documentElement);
// $infos=$dom->getElementsByTagName('')
 
$array_y=changeArray($arry);
 return $array_y;
}

function getArray($node) 
{
  $array = false;
 if ($node->hasChildNodes()) {
    if ($node->childNodes->length == 1) {
      $array[$node->firstChild->nodeName] = getArray($node->firstChild);
    } else {
      foreach ($node->childNodes as $childNode) {
      if ($childNode->nodeType != XML_TEXT_NODE) {
        $array[$childNode->nodeName][] = getArray($childNode);
      }
    }
  }
  } else {
    return $node->nodeValue;
  }
  return $array;
}

function changeArray($array){
	$g_array=array();
	$g_array['OK']=$array['OK'][0]['#text'];
	$array_a=$array['InfoList'][0]['info'];
	foreach ($array_a as $akey=>$avalue){
		foreach($avalue as $a_key => $a_value){
			$g_array[$akey][$a_key]=$a_value[0]['#text'];
		}
	}
	print_r($g_array);
}



?>