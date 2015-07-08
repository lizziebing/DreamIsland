<?php 
//----------------------------------------  路况信息录入 -----------------------------------------------
session_start();

// require_once("global.php");
// use Rest\Client;
// require 'client/src/autoload.php';

// useclass("weiboinfo");
// $rm_obj = new weiboinfo();
require 'roadmeth.php';
$rm_obj=new roadmeth();
$api_key = "09079d4a0ddbe174d3905c1d46bce757804e9189";

// $_SESSION['elggpage'] = 1;
// if(isset($_REQUEST['guid'])){
// 	$_SESSION['compereCode'] = $_REQUEST['guid']; 
// }
// if( isset($_REQUEST['page'])){
// 	$page = intval( $_REQUEST['page']);
// }else{
// 	$page = 1;
// }
if( isset($_REQUEST['action']) ){
	$action = $_REQUEST['action'];
}else{
	$action = "init";
}
// if($_REQUEST['username'] && $_REQUEST['password']){
// 	$username = $_REQUEST['username'];
// 	$password = $_REQUEST['password'];
// 	if($username != $_SESSION['adminstatus']['admin_name']){
// 		$_SESSION['adminstatus']['admin_name'] = $username;
// 		$_SESSION['adminstatus']['password'] = $password;
// 	}
// }

// //主持人账号信息
// if($_REQUEST['hostername'] && $_REQUEST['hosterpassword']){
// 	$hostername = $_REQUEST['hostername'];
// 	$hosterpassword = $_REQUEST['hosterpassword'];
// 	if($hostername != $_SESSION['adminstatus']['admin_hostername']){
// 		$_SESSION['adminstatus']['admin_hostername'] = $hostername;
// 		$_SESSION['adminstatus']['hosterpassword'] = $hosterpassword;
// 	}
// }

//将radioID写入SESSION，以便客户整个访问会话期间均能通过SESSION使用该值
if (isset($_REQUEST['radioID'])) {
	$_SESSION['radioID']=$_REQUEST['radioID'];
}
//else {
//	$_SESSION['radioID']="0024";//放到云端后去掉
//}
//print_r($_SESSION['radioID']);
if (isset($_REQUEST['freqid'])) {
	$_SESSION['freqid']=$_REQUEST['freqid'];
	//	print_r($_SESSION['freqid']);
}

$client = new Client('http://42.121.34.216/elgg/services/api/');
//$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_name'],"password"=>$_SESSION['adminstatus']['password']));
$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_hostername'],"password"=>$_SESSION['adminstatus']['hosterpassword']));
if($gettoken["result"] != null){
    if($action == "init"){
    	//接口预留 Start
        //$wires = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>$pageSize,"offset"=>"0","username"=>$_SESSION['adminstatus']['admin_name'],"status"=>"compere","sinceID"=>"-1","api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        //接口预留 End
        $roadlist = $rm_obj->query_CommonRoad();
//        print_r($roadlist);
        
        
        $tpl->assign("commonroadList", $roadlist);
        $tpl->display("info/roadInfoInput.tpl");
    }else if($action=="addCommonRoad"){
    	//same
        $rid = $_REQUEST['rid'];
        $roadname = $_REQUEST['roadname'];
        $position = $_REQUEST['position'];
        $initials = $rm_obj->getInitials($roadname);
        if(!empty($rid)&&!empty($roadname)&&!empty($position)){
                $str = $rm_obj->add_CommonRoad("commonroad",$rid,$roadname,$initials,$position);
                if($str == "success"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
}else if($action=="quickSearch"){
                if(empty($_POST['quickkwd'])){
                	$commonroadList = $rm_obj->query_CommonRoad();
                }else{
                	$quickkwd = $_POST['quickkwd'];
                	$commonroadList = $rm_obj->quick_Search($quickkwd);
                }
                if($commonroadList[0]){
                	$innerhtml = "";
                	$innerhtml .= "<table id='road_table' border='0' align='left' cellpadding='0' cellspacing='0'>";
                	foreach($commonroadList as $index => $value){
                		if($commonroadList[$index]['num']%2 != 0){
                			$innerhtml .= "<tr><td>";
                		}else{
                			$innerhtml .= "<td>";
                		}
                		$innerhtml .= "<table width='240px' border='0' cellpadding='0' cellspacing='0' id='table_road".$commonroadList[index]['num']."'>
                	                     <tr onmouseover=\"document.getElementById('delete_road".$commonroadList[$index]['num']."').style.display='block';\" onmouseout=\"document.getElementById('delete_road".$commonroadList[$index]['num']."').style.display='none';\">
                                             <td align='left' class='list_td' onclick=\"select_road('".$commonroadList[$index]['num']."','".$commonroadList[$index]['rid']."','".$commonroadList[$index]['roadname']."','".$commonroadList[$index]['position']."')\">".$commonroadList[$index]['roadname']."</td>
                                             <td align='right'>
                                                  <div class='delete_road_button' id='delete_road".$commonroadList[$index]['num']."' onclick=\"before_delete('".$commonroadList[$index]['num']."','".$commonroadList[$index]['rid']."')\"></div>
                                             </td>
                                         </tr>
                                    </table>";
                		if($commonroadList[$index]['num']%2 == 0){
                			$innerhtml .= "</td></tr>";
                		}else{
                			$innerhtml .= "</td>";
                		}
                	}
                	$innerhtml .= "</table><div class='clear'></div>";
                }else{
                	$innerhtml = "<p style=\"font-family:'Microsoft YaHei';font-size:14px;color:#585858;\">亲，人家没有找到啦！</p>";
                }
                echo $innerhtml;
}else if($action=="addRoadInfo"){
        $roadname = $_REQUEST['roadname'];
        $position = $_REQUEST['position'];
        $direction = $_REQUEST['direction'];
        $situation = $_REQUEST['situation'];
        $roadtext = $_REQUEST['roadtext'];
        if(!empty($roadname)&&!empty($position)&&!empty($direction)&&!empty($situation)&&!empty($roadtext)){
        	    $SerialNo="123456";
        	    //$RadioID="0024";
        	    $profile = $client->post("/rest/json/?method=user.get_profile",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        	    $hostweibo=$profile['result']['core']['name'];
        	    $Type="1";
                $info = $rm_obj->add_roadinfo($SerialNo,$RadioID,$hostweibo,$roadname,$position,$Type,"",$direction,$situation,"",$roadtext);
                $result = $clint->InsertRoadInfo($info);
                preg_match_all('/<OK>([^<]+)</',$result,$rs);
                $str = $rs[1][0];
                if($str == "00"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
}else if($action=="delCommomRoad"){
        $rid = $_REQUEST['rid'];
        if(!empty($rid)){
                $str = $rm_obj->del_CommonRoad($rid);
                if($str == "success"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
}
    
    else if($action == "more"){
    	
    	
    }
    
}
      

//$s='fdsf<a>ds：<OK>http://www.baidu.com>百度</OK> fdsfsdfs';
//preg_match_all('/<OK>([^<]+)</',$s,$rs);
//print_r($rs);
//echo $rs[1][0];



?>
