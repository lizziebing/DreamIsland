<?php
session_start();
require_once("global.php");
use Rest\Client;
require 'client/src/autoload.php';



$username = empty($_SESSION['adminstatus']['admin_hostername'])?'admin':$_SESSION['adminstatus']['admin_hostername'];

$_REQUEST['radioID']=empty($_REQUEST['radioID'])?'0024':$_REQUEST['radioID'];//方便业务层调用
$radioid=empty($_SESSION['radioID'])?$_REQUEST['radioID']:$_SESSION['radioID'];

$check='0';
if($_REQUEST['isBack']){
$check='1';
}

$password = $_SESSION['adminstatus']['hosterpassword'];
if(!$username)
    exit;
$isBack="";
//判断是否后台登陆使用，隐藏‘已发送按钮’    
if (!$password){
	$isBack="none";
}
$upload_img_path = "uploadimage/$username";

if($_FILES["upload_img"]){
    if(!file_exists($upload_img_path)){
        mkdir("$upload_img_path", 0700);
    }
    $tp = array("image/gif","image/pjpeg","image/jpeg","image/x-png","image/png","image/bmp");
    if(!in_array($_FILES["upload_img"]["type"],$tp)) 
    {   
        echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' /><script language='javascript' charset='utf-8'>parent.error_image();</script>"; 
        exit; 
    }//END IF 
    $filetype = $_FILES['upload_img']['type']; 
    if($filetype == 'image/jpeg'){ 
        $type = '.jpg'; 
    }   
    if ($filetype == 'image/jpg') { 
        $type = '.jpg'; 
    }   
    if ($filetype == 'image/pjpeg') { 
        $type = '.jpg'; 
    }   
    if($filetype == 'image/gif'){ 
        $type = '.gif'; 
    }   
    if($filetype == 'image/x-png'){ 
        $type = '.png'; 
    }   
    if($filetype == 'image/bmp'){ 
        $type = '.bmp'; 
    }   
    if($_FILES["upload_img"]["name"]) 
    {   
        //$random = substr($md5("".rand()),10,10); //获取时间并赋值给变量 
        $rand =  rand();
        $md5 = md5($rand);
        $random = substr($md5, 10, 10);
        $file = $upload_img_path."/".$random.$type; //图片的完整路径 
        $result = move_uploaded_file($_FILES["upload_img"]["tmp_name"],$file);
        echo "<img src='".$file."' style='width:80px;height:auto'/>";
        echo "<script language='javascript'>";
        if(isset($_POST["upload_value"])){
            $more_value = $_POST["upload_value"];
            echo " window.parent.document.getElementById('more_image_left".$more_value."').src='".$file."';";
            echo " window.parent.document.getElementById('more_image').src='".$file."';";
        }else{
            echo " window.parent.document.getElementById('single_image_left').src='".$file."';";
            echo " window.parent.document.getElementById('single_image').src='".$file."';";
        }
        //echo " window.parent.document.getElementById('single_image_div').style.display='';";
        echo "</script>";
        exit;
    }//END IF 
}
$client = new Client('http://42.121.34.216/elgg/services/api/');
$api_key = "09079d4a0ddbe174d3905c1d46bce757804e9189";
//------------------- 测试130上新添接口，移到云上后把config.php中的webserviceIP_s的代码去掉，并把以下两行代码去掉 ------------------
//if(){
//$client = new Client('http://'.$webserviceIP_s.'/elgg/services/api/');
//$api_key = "cac5482e54c4bbb259cd85c25076973bfcf7e351";
//}
//------------------- 测试130上新添接口，移到云上后把config.php中的webserviceIP_s的代码去掉，并把以下两行代码去掉  End--------------

$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$username,"password"=>$password));

if($gettoken['result'] != null){
    $result = $client->post("/rest/json/?method=get.broadcast_by_compere",array("username"=>"$username","api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    if($result['status'] != -1){
        $broadcast = $result['result']['id'];
    }
}
$date = date('Y-m-d');

$tpl->assign("isBack", $isBack);//控制‘已发送‘按钮的显示与隐藏
$tpl->assign("broadcast", $broadcast);
$tpl->assign("radioid", $radioid);//不传参数的情况下默认0024
$tpl->assign("check", $check);//审核状态
$tpl->assign("date", $date);
$tpl->display("info/announce.tpl");
?>
