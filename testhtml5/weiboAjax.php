<?php
session_start();
require_once("global.php");
use Rest\Client;
require 'client/src/autoload.php';
$client = new Client('http://42.121.34.216/elgg/services/api/');
$api_key = "09079d4a0ddbe174d3905c1d46bce757804e9189";
$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_hostername'],"password"=>$_SESSION['adminstatus']['hosterpassword']));

$group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
$group_guid = $group_original['result'][0]['guid'];
useclass("weiboinfo");
$weibo_obj = new weiboinfo();

if( isset($_REQUEST['action']) ){
	$action = $_REQUEST['action'];
}
if($action=="sendweibo"){
	//        $group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
	$group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
	$group_guid = $group_original['result'][0]['guid'];

	$gettoken_freq= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_name'],"password"=>$_SESSION['adminstatus']['password']));
	$profile_c = $client->post("/rest/json/?method=user.get_profile",array("username"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=> $gettoken_freq["result"]));
	$name_c = $profile_c['result']['core']['name'];//频率账号对应的名称，

	if($_SESSION['compereCode']){
		$compereCode = $_SESSION['compereCode'];
	}
	//
	if (isset($_REQUEST['columntext'])){

		if ($name_c) {
			 
			$wireText = "#".$_REQUEST['columntext']."# "."@".$name_c.' '.$_REQUEST['saytext'];
		}
		else
		{
			$wireText = "#".$_REQUEST['columntext']."# ".$_REQUEST['saytext'];
		}
	}
	else {
		$wireText = $_REQUEST['saytext'];
	}
	// $wireText = "#".$_REQUEST['columntext']."# ".$_REQUEST['saytext'];
	// $wireText = $_REQUEST['saytext'];
	$tail = strstr($wireText,"http://im.yqting.com/test_demo_version2/admin.php?op=baseinfomgr_voting");
	$head = strstr($wireText,"http://im.yqting.com/test_demo_version2/admin.php?op=baseinfomgr_voting",true);
	if($tail && $head){
		$short_url_json = $c->get_short_url($tail);
		$short_url = json_decode($short_url_json,true);
		$short_result = $short_url['urls'][0]['url_short'];
		if($short_result)
			$wireText = $head.$short_result;
	}
	if(isset($_REQUEST['from'])){
		if($_REQUEST['from'] == "sina"){
			$wireText = str_replace('>!<','"',$wireText);
			$wireText = str_replace('>?<','\'',$wireText);
			//$wireText .= iconv("GB2312","UTF-8","(转发自新浪微博)");
			$wireText.='(转发自新浪微博)';
		}
	}
	if(isset($_REQUEST['picture'])){
		$picUrl = $_REQUEST['picture'];
	}
	if($picUrl){
		$wirePost = $client ->post("/rest/json/?method=wire.save_post",array("text"=>$wireText,"access" =>2,"wireMethod" => "api", "username" =>$_SESSION['adminstatus']['admin_hostername'],"classfication"=>"public","group_guid"=>$group_guid,"api_key"=>$api_key,"pic"=>$picUrl,"compereCode"=>$compereCode,"auth_token"=>$gettoken["result"]));

	}else{
		//42.121.34.216
		$wirePost = $client ->post("/rest/json/?method=wire.save_post",array("text"=>$wireText,"access" =>2,"wireMethod" => "api", "username" =>$_SESSION['adminstatus']['admin_hostername'],"classfication"=>"public","group_guid"=>$group_guid,"api_key"=>$api_key,"compereCode"=>$compereCode,"auth_token"=>$gettoken["result"]));
	}
	// echo json_encode($wireText);
	//192.168.139.147
	//$wirePost = $client ->post("/rest/json/?method=wire.save_post",array("text"=>$wireText,"api_key"=>"9e2e6f35fb039ee62761c58cba143dda2eb8215f","auth_token"=>$gettoken["result"]));
	if($wirePost["result"]["success"]){
		if($_REQUEST['is_top']){
			/*       $top_wire = $client ->post("/rest/json/?method=wire.get_top",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"count"=>3,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
			 if(count($top_wire['result']) >= 3){*/
			$make_down = $client ->post("/rest/json/?method=wire.change_top",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"guid"=>$wirePost["result"]['wire_guid'],"topstatus"=>"top","api_key"=>$api_key,"auth_token"=>$gettoken["result"]));

			// }


		}
		echo json_encode("success");
	}else{
		echo json_encode("failure");
	}
}
else if($action=="getcomment"){
	$guid = $_REQUEST['weiboID'];
	$commentWire = $client->post("/rest/json/?method=wire.comment.list",array("guid"=>$guid,"username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
	 
	//print_r($commentWire);
	//  file_put_contents("/home/zsc.txt",$commentWire['status']."\n");
	if($commentWire["result"]["success"]==-1){
		echo json_encode(null);
	}
	else if($commentWire["status"]==0){
		$commentList = $weibo_obj->transElggCommentData($commentWire["result"]);
		echo json_encode($commentList);
	}

	//$commentList = $weibo_obj->transElggCommentData($commentWire["result"]);
	//echo json_encode($commentList);
	//echo json_encode("comment");
}
else if($action=="getmorecomments"){
	$guid = $_REQUEST['weiboID'];
	$limit = $_REQUEST['limit'];
	$offset = $_REQUEST['offset'];
	$commentWire = $client ->post("/rest/json/?method=wire.comment.list",array("guid"=>$guid,"username"=>$_SESSION['adminstatus']['admin_hostername'],"limit"=>$limit,"offset"=>$offset,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
	//print_r($commentWire);
	if($commentWire["status"]==-1){
		echo json_encode(null);
	}
	else if($commentWire["status"]==0){
		$commentList = $weibo_obj->transElggCommentData($commentWire["result"]);
		echo json_encode($commentList);
	}
}else if($action=="submitcomment"){
        $guid = $_REQUEST['weiboID'];
        $text = " ".$_REQUEST['commentText'];
        $addComment = $client ->post("/rest/json/?method=wire.comment.add",array("guid"=>$guid,"access"=>"2","username"=>$_SESSION['adminstatus']['admin_hostername'],"wireMethod"=>"api","text"=>$text,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        if($addComment['result']['success']){
            echo json_encode("success");
        }else{
            echo json_encode("failure");
        }
}else if($action=="deletecomment"){
        $guid = $_REQUEST['weiboID'];
        $commentID = $_REQUEST['commentID'];
        //delete from elgg
        $deleteComment = $client ->post("/rest/json/?method=wire.comment.remove",array("guid"=>$guid,"username"=>$_SESSION['adminstatus']['admin_hostername'],"commentid"=>$commentID,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        
        if($deleteComment['result']['success']){
            echo json_encode("success");
        }else{
            echo json_encode("failure");
        }
}
?>