<?php


header("Content-Type:text/html; charset=utf-8");//解决与网页编码的冲突
/*
//require"main.inc.php";

//$content="@获取“abc123一!起东陵区sict”首字母：";
//$tpl->assign("content",$content);
//$tpl->assign("result",$result);
//$tpl->display("road.tpl");

echo "测试searchtest";
if($_POST['action']=='ajax')
{
//$result=$db->get_one("select*fromshtq_shoporderbyrand()limit1");
$result=date("Hhi l d F", time());
echo "测试11111111";

echo $result;
//exit;
}


*/

echo $_POST['qwert'];

$list=array("东北","东陵区");
//echo $_POST[$list];
echo json_encode($list);
//echo $list;
?>