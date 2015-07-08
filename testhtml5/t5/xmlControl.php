<?php
header("Content-Type:text/plain; charset=utf-8");

include('./control_hotlog.php');
// include('./newRoad.php');
//$result=queryNewRoadCount ("123456","0024","gaoqiao.qq.com",'133','0');
//print_r($result);

$result=getActivityList("123456","0024","105",2,"","");
// $result=insertHostlog("123456","0024",time(),"gaoqiao.qq.com","insertweibo","主持人添加微博");
//$result=insertHostlog("123456","0024",time(),"gaoqiao.qq.com","markweibo","主持人标记微博");
//$result=DeleteHostLog("123456","0024",time());
print_r($result);
//getroadcount("123456","0024","562179462.qq.com","53","3");
//include('./QueryWeather.php');
//
//$weather=queryWeather("123456","0024","沈阳");
//
//$w=$weather[WeatherInfo];
//$obj=json_decode($w);  
//echo $obj->weatherinfo->city.'：'.$obj->weatherinfo->temp.':'.$obj->weatherinfo->WD;  
//$xmlstring=queryinfo("123456","0024","2","","No","2","1","8");
//
//print_r($xmlstring);
//$url_array = explode("\"", $xmlstring);
//echo $url_array[1];
//readXML($xmlstring);

//echo $result; 

//$result=Modifyroadinfo("123456","0024","562179462.qq.com","39","isread","1");
//print_r($result);





//$item1=$dom->createElement("SerialNo");
//$root->appendChild($item1);
//$item1text=$dom->createTextNode("123456");
//$item1->appendChild($item1text);

//readXML("1");





?>