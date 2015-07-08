<?php
session_start();
set_time_limit(0);//设置超时时间
require_once('global.php');
use Rest\Client;
require 'autoload.php';

useclass("weiboinfo");

$weibo_obj = new weiboinfo();
$weibo_obj->weiboinfo();
$api_key = "09079d4a0ddbe174d3905c1d46bce757804e9189";

// ��ȡparam��ֵ
// $_SESSION['elggpage'] = 1;
// if(isset($_REQUEST['guid'])){
//     $_SESSION['compereCode'] = $_REQUEST['guid']; 
// }

if( isset($_REQUEST['page'])){
        $page = intval( $_REQUEST['page']);
}else{
        $page = 1;
}
if( isset($_REQUEST['action']) ){
            $action = $_REQUEST['action'];
}else{
        $action = "init";
}
// //频率账号信息
// if($_REQUEST['username'] && $_REQUEST['password']){
// 	$username = $_REQUEST['username'];
// 	$password = $_REQUEST['password'];
// 	if($username != $_SESSION['adminstatus']['admin_name']){
// 		$_SESSION['adminstatus']['admin_name'] = $username;
// 		$_SESSION['adminstatus']['password'] = $password;
// 	}
// }

//主持人账号信息
if($_REQUEST['hostername'] && $_REQUEST['hosterpassword']){
	$hostername = $_REQUEST['hostername'];
	$hosterpassword = $_REQUEST['hosterpassword'];
	if($hostername != $_SESSION['adminstatus']['admin_hostername']){
		$_SESSION['adminstatus']['admin_hostername'] = $hostername;
		$_SESSION['adminstatus']['hosterpassword'] = $hosterpassword;
	}
}
$_SESSION['adminstatus']['admin_hostername']="zhb.163.com";
$_SESSION['adminstatus']['hosterpassword']="123456";
$_SESSION['radioID']="0024";
//将radioID写入SESSION，以便客户整个访问会话期间均能通过SESSION使用该值
// if (isset($_REQUEST['radioID'])) {
// 	$_SESSION['radioID']=$_REQUEST['radioID'];
// }
//else {
//	$_SESSION['radioID']="0024";//放到云端后去掉
//}
print_r($_SESSION['radioID']);
if (isset($_REQUEST['freqid'])) {
	$_SESSION['freqid']=$_REQUEST['freqid'];	
//	print_r($_SESSION['freqid']);
}
//�ϴ�ͼƬ
require_once("uploadimg.php");

if($_FILES["upload_img"]){
//--------------------------------------------- lichun 添加 pics upload 2014.11.07 -Start--3/---------
	
	//file_put_contents("d:\\zhuchiren.txt","1---start-----:",FILE_APPEND);
	$tp = array("image/gif","image/pjpeg","image/jpeg","image/x-png","image/bmp");
    if ($_POST["upload_img_id"]!=""){
    	//file_put_contents("d:\\zhuchiren.txt","2---:".$_POST["upload_img_id"]."-----".$_FILES["upload_img"]["type"]."----",FILE_APPEND);
	    if(!in_array($_FILES["upload_img"]["type"],$tp)){
	        echo "<meta http-equiv='content-type' content='text/html;charset=utf-8' /><script language='javascript' charset='utf-8'>";
	        //file_put_contents("d:\\zhuchiren.txt","2.5---:".$_POST["upload_img_id"]."-----".$_FILES["upload_img"]["type"],FILE_APPEND);
	        //echo "window.parent.document.getElementById('single_image_div".$_POST["upload_img_id"]."').style.display='none';";
	        echo "parent.delete_image(".$_POST["upload_img_id"].");";	         
	        echo "parent.error_image();";
	        
	        echo"</script>";
	        exit;
	    }//END IF	    
	    if($_FILES["upload_img"]["name"]){
	    	$file=uploadImg($_FILES["upload_img"]["tmp_name"]);
	        $file= str_replace(PHP_EOL, '', $file);
	        //file_put_contents("d:\\zhuchiren.txt","3---".$file,FILE_APPEND);
	        echo "<script language='javascript'>";	        
	        echo "window.parent.document.getElementById('single_image".$_POST["upload_img_id"]."').src='".$file."';";
	        echo "</script>";
	        exit;
	        
	    }//END IF 
	 
    }
    //--------------------------------------------- lichun 添加 pics upload 2014.11.07 -End--3/---------
    
}
                                                 


$pageSize= 15;
$nowiresmsg = null;
$client = new Client('http://42.121.34.216/elgg/services/api/');

//------------------- 测试130上新添接口，移到云上后把config.php中的webserviceIP_s的代码去掉，并把以下两行代码去掉 ------------------
//$client = new Client('http://'.$webserviceIP_s.'/elgg/services/api/');
//$api_key = "cac5482e54c4bbb259cd85c25076973bfcf7e351";
//------------------- 测试130上新添接口，移到云上后把config.php中的webserviceIP_s的代码去掉，并把以下两行代码去掉  End--------------

//obtain the token
$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_hostername'],"password"=>$_SESSION['adminstatus']['hosterpassword']));

$group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        $group_guid = $group_original['result'][0]['guid'];
//print_r($gettoken);
//print_r($_SESSION['adminstatus']['admin_name']);
//print_r($_SESSION['adminstatus']['password']);
//

//获取当前时段的栏目名称，若无则默认第一个栏目，并存入session中 --------------- Start --------------------------
            $columns = $client->post("/rest/json/?method=get.program_by_compere",array("guid"=>$group_guid,"UserName"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key));
            $timearr = explode(':',date('h:i:s',time()));
            $nowColumnSec = intval($timearr[0])*3600+intval($timearr[1])*60+intval($timearr[2]);
            if($columns['status']=='0'){
            	foreach($columns['result'] as $key => $value){
            		if($value['StartTime']<=$nowColumnSec && $nowColumnSec<$value['EndTime']){
            			$nowColumnName = $value['ProgramName'];
            			$_SESSION['ProgramName'] = $nowColumnName;
            		}else{
            			$nowColumnName = $columns['result'][0]['ProgramName'];
            			$_SESSION['ProgramName'] = $nowColumnName;
            		}
            	}
            }
//获取当前时段的栏目名称，若无则默认第一个栏目，并存入session中 --------------- End ----------------------------
              
if($gettoken["result"] != null){
    if($action == "init"){
            //init items of weibo,get least weibos
            $wires = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>$pageSize,"offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"status"=>"compere","sinceID"=>"-1","frename"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
//            print_r($wires);
            if($wires["result"] != null){
                    $num = $weibo_obj->getElggWeiboNum($wires["result"]);
                    $maxID = $wires["result"][0]['guid'];
                    $minID = $wires["result"][$num-1]['guid'];
                    if($num < $pageSize){
                            $tail = true;
                            $hasNext = 0;
                    }else{
                         $wiresmore = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>1,"offset"=>0,"username"=>$_SESSION['adminstatus']['admin_hostername'],"status"=>"compere","maxID"=>$wires['result'][$pageSize-1]['guid'],"frename"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
                         if($wiresmore['status'] != -1){
                                 $tail = false;
                                 $hasNext = 1;
                         }else{
                                 $tail = true;
                                 $hasNext = 0;
                         }
                    }
            }
    }else if($action == "more"){
            $min = $_REQUEST['min'];
            //get more weibos
            $wires = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>$pageSize,"offset"=>0,"username"=>$_SESSION['adminstatus']['admin_hostername'],"status"=>"compere","maxID"=>$min,"frename"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
            if($wires["result"] != null){
                    $num = $weibo_obj->getElggWeiboNum($wires["result"]);
                    $minID = $wires["result"][$num-1]['guid'];
                    if($num < $pageSize){
                            $tail = true;
                            $hasNext = 0;
                    }else{
                         $wiresmore = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>1,"offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"status"=>"compere","maxID"=>$wires['result'][$pageSize-1]['guid'],"frename"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
                         if($wiresmore['status'] != -1){
                                 $tail = false;
                                 $hasNext = 1;
                         }else{
                                 $tail = true;
                                 $hasNext = 0;
                         }
                    }
            }
    }
    /*else if($action == "back"){
            $max = $_REQUEST['max'];
            //get back weibos
            $wires = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>$pageSize,"offset"=>"0","username"=>$_SESSION['adminstatus']['admin_name'],"status"=>"compere","sinceID"=>$max,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
            if($wires["result"] != null){
                    $num = $weibo_obj->getElggWeiboNum($wires["result"]);
                    //$maxID = $wires["result"][$num-1]['guid'];
                    //$minID = $wires["result"][0]['guid'];
                    //$maxID = $_REQUEST['max2'];
                    if($num < $pageSize){
                            $page = 1;
                    }
                    $tail = false;
                    $hasNext = 1;
            }
    }*/
    if($wires["result"] != null){
        $pageUrlString = $weibo_obj->getPageUrlString2($page, $tail, $minID, $maxID, "op=baseinfomgr_myWeiboList", "1=1");
	    $pageUrlString = iconv("GB2312","UTF-8",$pageUrlString);
        if( isset($_REQUEST['time']) ){
            $time = $_REQUEST['time'];
            $weiboList = $weibo_obj->transElggData($wires["result"],$_SESSION['adminstatus']['admin_hostername'],$time);
        }else
            $weiboList = $weibo_obj->transElggData($wires["result"],$_SESSION['adminstatus']['admin_hostername']);
    }else{
        $nowiresmsg = "û��΢��";
    }

}
    	//obtain weibo nums from database

       $profile = $client->post("/rest/json/?method=user.get_profile",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
 //      echo $weiboList;<br>

if( isset($_REQUEST['time']) ){
        $finalWeiboList = array();
        $finalWeiboList['pageLink'] = $pageUrlString;
        $finalWeiboList['weiboList'] = $weiboList;
        $finalWeiboList['max1'] = $maxID1;
        $finalWeiboList['pageNumber'] = $pageNumber;
        $finalWeiboList['hasNext'] = $hasNext;
        if($nowiresmsg){
            $finalWeiboList['nowires'] = 1;
        }
       // echo json_encode($finalWeiboList);
        print_r($finalWeiboList);
}else{
$a = array();
$a["friends"] = "admin.php?op=baseinfomgr_myFriends";
$a["friendsof"] = "admin.php?op=baseinfomgr_myFriendsOf";
//print_r($weiboList);
//print_r($maxID);
$tpl->assign("userInfo",$profile['result']);
$tpl->assign("weiboList",$weiboList);
$tpl->assign("isExistData", $nowiresmsg);
$tpl->assign("page", $page);
$tpl->assign("min", $minID);
$tpl->assign("max", $maxID);
$tpl->assign("hasNext", $hasNext);
$tpl->assign("a", $a);
$tpl->assign("page_string", $pageUrlString);
$tpl->display("myWeiboList.tpl");
}
?>
