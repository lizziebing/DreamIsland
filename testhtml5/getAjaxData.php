<?php
session_start();
require_once("global.php");
use Rest\Client;
require 'client/src/autoload.php';
include_once( 'sinaweibo/config.php' );
include_once( 'sinaweibo/saetv2.ex.class.php' );
$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$c->set_debug( DEBUG_MODE );
$client = new Client('http://42.121.34.216/elgg/services/api/');
//$clint = new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
$clint = new SoapClient('http://42.121.125.50/bsys/webservice/webserver.wsdl');
$api_key = "09079d4a0ddbe174d3905c1d46bce757804e9189";
//------------------- 测试130上新添接口，移到云上后把config.php中的webserviceIP_s的代码去掉，并把以下两行代码去掉 ------------------
//$client = new Client('http://192.168.139.130/elgg/services/api/');
//$api_key = "cac5482e54c4bbb259cd85c25076973bfcf7e351";
//------------------- 测试130上新添接口，移到云上后把config.php中的webserviceIP_s的代码去掉，并把以下两行代码去掉  End--------------
//$client = new Client('http://192.168.139.147/elgg/services/api/');
//obtain the token
//$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>"languoliang","password"=>"123456"));
$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_hostername'],"password"=>$_SESSION['adminstatus']['hosterpassword']));
//lichunlichunlichun
$group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
$group_guid = $group_original['result'][0]['guid'];
 

 
 
//print_r($gettoken);
useclass("weiboinfo");
useclass("admininfo");
$weibo_obj = new weiboinfo();
$admin_obj = new admininfo();
// ��ȡaction��ֵ
$RadioID = $_SESSION['radioID'];
//$RadioID="0024";//放到云上后去掉

$SerialNo="123456";
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
else if($action=="markweixin"){
        $guid = $_REQUEST['weiboID'];
        $isTag = $_REQUEST['isTag'];
        if($isTag==0){
            $str = $weibo_obj->markWeixin($guid);
            if($str == "old")
                echo json_encode("mark");
            if($str == "new")
                echo json_encode("newmark");
        }else if($isTag==1){
                $weibo_obj->unmarkWeixin($guid);
                echo json_encode("unmark");
        }else{
                echo json_encode("failure");
        }
	
	
}
else if($action=="readweixin"){
        $guid = $_REQUEST['weiboID'];
        $isRead = $_REQUEST['isRead'];
        if($isRead==0){
            $str = $weibo_obj->readWeixin($guid);
            if($str == "old")
                echo json_encode("read");
            if($str == "new")
                echo json_encode("newread");
        }else if($isRead==1){
                $weibo_obj->unreadWeixin($guid);
                echo json_encode("unread");
        }else{
                echo json_encode("failure");
        }
}
else if($action=="markweibo"){
	
        $guid = $_REQUEST['weiboID'];
        $isTag = $_REQUEST['isTag'];//0标记，1取消标记
//        $guid = $_GET['weiboID'];
//        $isTag = $_GET['isTag'];
         if ($isTag=='0') {
	         $op = "markweibo";
             $memo = "主持人标记微博";
                          }
           elseif ($isTag=='1')
             {
                $op = "cancel_markweibo";
                $memo = "主持人取消标记微博";
             }//zhb20
        //主持人填写日志操作 Start
        $rstamp = time();
        $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
       // $op = $action;
        $memo = "主持人标记微博";
        $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
        $xmlstring = $clint->InsertHostLog($zcrinfo);
        $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
        //主持人填写日志操作 End
//        print_r($infoarrays);
        if($infoarrays['InsertOut']['op']=="success"){
        	
        //tagWeibo is another table in database 
	//modify by languoliang, 2013.03.14
        if($isTag==0){
                $str = $weibo_obj->markWeibo("tagWeibo",$guid);
                if($str == "old")
                    echo json_encode("mark");
                if($str == "new")
                    echo json_encode("newmark");
        }
        else if($isTag==1){
                $weibo_obj->unmarkWeibo("tagWeibo",$guid);
                echo json_encode("unmark");
        }else{
    		//不成功时，主持人删除日志操作 Start
    		$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    		$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    		//主持人删除日志操作 End
                echo json_encode("failure");
        }
        
        }
        else{
        	echo json_encode("failure");
        }
	
}
else if($action=="readweibo"){
        $guid = $_REQUEST['weiboID'];
        $isRead = $_REQUEST['isRead'];//0 播出；1取消播出
        //echo $isTag;
      if ($isRead=='0') {
      	$op = "readweibo";
      	$memo = "主持人播出微博";
      } 
      if ($isRead=='1') {
      	$op = "cancel_readweibo";
      	$memo ="主持人取消播出微博";
      } //zhb20
    //主持人填写日志操作 Start
    $rstamp = time();
    $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
   // $op = $action;
    
    
    $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
    
    $xmlstring = $clint->InsertHostLog($zcrinfo);
    $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
    //主持人填写日志操作 End
    if($infoarrays['InsertOut']['op']=="success"){
    	
	//modify by languoliang, 2013.03.15
        if($isRead==0){
                $str = $weibo_obj->tagRead("tagRead",$guid);
                if($str == "old")
                    echo json_encode("read");
                if($str == "new")
                    echo json_encode("newread");
        }else if($isRead==1){
                $weibo_obj->untagRead("tagRead",$guid);
                echo json_encode("unread");
        }else{
    		//不成功时，主持人删除日志操作 Start
    		$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    		$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    		//主持人删除日志操作 End
                echo json_encode("failure");
        }
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
}
else if($action=="submitcomment"){
        $guid = $_REQUEST['weiboID'];
        $text = " ".$_REQUEST['commentText'];
        $addComment = $client ->post("/rest/json/?method=wire.comment.add",array("guid"=>$guid,"access"=>"2","username"=>$_SESSION['adminstatus']['admin_hostername'],"wireMethod"=>"api","text"=>$text,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        if($addComment['result']['success']){
            echo json_encode("success");
        }else{
            echo json_encode("failure");
        }
}
else if($action=="submitreply"){
        $group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        $group_guid = $group_original['result'][0]['guid'];
        $guid = $_REQUEST['weiboID'];
        $replyText = " ".$_REQUEST['replyContent'];
        $addReply = $client ->post("/rest/json/?method=wire.reply",array("text"=>$replyText,"access"=>"2","username"=>$_SESSION['adminstatus']['admin_hostername'],"wireMethod"=>"api","parentid"=>$guid,"group_guid"=>$group_guid,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        if($addReply['result']['success']==1){
            echo json_encode("success");
        }else{
            echo json_encode("failure");
        }
}
else if($action=="deletewb"){
    $guid = $_REQUEST['weiboID'];
    if($guid == 39972 || $guid==39973 || $guid==39974 || $guid==39975  ){
        echo json_encode("failure");
    }else{
    //主持人填写日志操作 Start
    $rstamp = time();
    $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
    $op = $action;
    $memo = "主持人删除微博";
    $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
    $xmlstring = $clint->InsertHostLog($zcrinfo);
    $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
    //主持人填写日志操作 End
    if($infoarrays['InsertOut']['op']=="success"){
    	
        $username = $_SESSION['adminstatus']['admin_name'];
        //delete from database
        $weibo_obj->unmarkWeibo("tagWeibo",$guid);
        $weibo_obj->untagRead("tagRead",$guid);
        $ret = $weibo_obj->deleteWeibo($weibo_obj->table_weibo,$guid);
               
$gettoken_freq= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_name'],"password"=>$_SESSION['adminstatus']['password']));        
        //delete from elgg
        $deleteWB = $client ->post("/rest/json/?method=wire.delete_posts",array("username"=>$username,"wireid"=>$guid,"api_key"=>$api_key,"auth_token"=>$gettoken_freq["result"]));
        if($deleteWB['result']['success']){
            echo json_encode("success");
        }else{
    		//不成功时，主持人删除日志操作 Start
    		$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    		$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    		//主持人删除日志操作 End
            echo json_encode("failure");
        }
    }else{
    	echo json_encode("failure");
    }
    }
//	echo $_SESSION['adminstatus']['admin_hostername']." +q";
}
else if($action=="deletecomment"){
        $guid = $_REQUEST['weiboID'];
        $commentID = $_REQUEST['commentID'];
        //delete from elgg
        $deleteComment = $client ->post("/rest/json/?method=wire.comment.remove",array("guid"=>$guid,"username"=>$_SESSION['adminstatus']['admin_hostername'],"commentid"=>$commentID,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        
        if($deleteComment['result']['success']){
            echo json_encode("success");
        }else{
            echo json_encode("failure");
        }
}else if($action == "getlistening"){
    $ms = $c->get_online_listening_count(301);
    echo $ms;
}else if($action == "getlistener"){
    $ms = $c->get_online_listener_count("shenyang",301);
    echo $ms;
}else if($action == "topweibo"){
    $guid = $_REQUEST["weiboID"];
    //主持人填写日志操作 Start
    $rstamp = time();
    $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
    $op = $action;
    $memo = "主持人置顶频率微博";
    $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
    $xmlstring = $clint->InsertHostLog($zcrinfo);
    $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true);     
    //主持人填写日志操作 End
    if($infoarrays['InsertOut']['op']=="success"){
    	$result = $client ->post("/rest/json/?method=wire.change_top_v2",array("username"=>$_SESSION['adminstatus']['admin_name'],"guid"=>$guid,"topstatus"=>"confirm","toptype"=>"freq","group_guid"=>$group_guid,"reason"=>"","api_key"=>$api_key));
    	if($result["result"]["success"]==1 || $result["result"]["success"]==2 || $result["result"]["success"]==3){
    		//接口调研成功
        	echo json_encode("success");
    	}else{
    		//不成功时，主持人删除日志操作 Start
    		$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    		$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    		//主持人删除日志操作 End
        	echo json_encode("failure");
    	}
    }else{
    	echo json_encode("failure");
    }
}else if($action == "downweibo"){
    $guid = $_REQUEST["weiboID"];
    if( $guid ==0){
        echo json_encode("failure");
    }else{
        //主持人填写日志操作 Start
        $rstamp = time();
        $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
        $op = $action;
        $memo = "主持人取消置顶频率微博";
        $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
        $xmlstring = $clint->InsertHostLog($zcrinfo);
        $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
        //主持人填写日志操作 End
        if($infoarrays['InsertOut']['op']=="success"){
            $result = $client ->post("/rest/json/?method=wire.change_top_v2",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"guid"=>$guid,"topstatus"=>"down","toptype"=>"freq","group_guid"=>$group_guid,"reason"=>"","api_key"=>$api_key));
            if($result["result"]["success"] == 1 ){
                echo json_encode("success");
            }else{
    			//不成功时，主持人删除日志操作 Start
    			$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    			$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    			//主持人删除日志操作 End
                echo json_encode("failure");
            }
        }else{
        	echo json_encode("failure");
        }
    }
}else if($action == "topweibo_c"){
    $guid = $_REQUEST["weiboID"];
    $progName = $weibo_obj->unescape($_REQUEST["progN"]);
    //主持人填写日志操作 Start
    $rstamp = time();
    $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
    $op = $action;
    $memo = "主持人置顶栏目微博";
    $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
    $xmlstring = $clint->InsertHostLog($zcrinfo);
    $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
    //主持人填写日志操作 End
    if($infoarrays['InsertOut']['op']=="success"){
    	$result = $client ->post("/rest/json/?method=wire.change_top_v2",array("username"=>$progName,"guid"=>$guid,"topstatus"=>"top","toptype"=>"prog","group_guid"=>$group_guid,"reason"=>"","api_key"=>$api_key));
    	if($result["result"]["success"] == 1){
    		//接口调研成功
        	echo json_encode("success");
    	}elseif($result["result"]["success"] == -1){
    		//不成功时，主持人删除日志操作 Start
    		$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    		$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    		//主持人删除日志操作 End
        	echo json_encode("enough");
    	}else{
    		//不成功时，主持人删除日志操作 Start
    		$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    		$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    		//主持人删除日志操作 End
        	echo json_encode("failure");
    	}
    }else{
    	echo json_encode("failure");
    }
}elseif($action == "downweibo_c"){
    $guid = $_REQUEST["weiboID"];
    $progName = $weibo_obj->unescape($_REQUEST["progN"]);
    if( $guid ==0){
        echo json_encode("failure");
    }else{
        //主持人填写日志操作 Start
        $rstamp = time();
        $hostweibo = $_SESSION['adminstatus']['admin_hostername'];
        $op = $action;
        $memo = "主持人取消置顶栏目微博";
        $zcrinfo = $weibo_obj->insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo);
        $xmlstring = $clint->InsertHostLog($zcrinfo);
        $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
        //主持人填写日志操作 End
        if($infoarrays['InsertOut']['op']=="success"){
            $result = $client ->post("/rest/json/?method=wire.change_top_v2",array("username"=>$progName,"guid"=>$guid,"topstatus"=>"down","toptype"=>"prog","group_guid"=>$group_guid,"reason"=>"","api_key"=>$api_key));
            if($result["result"]["success"] == 1 ){
                echo json_encode("success");
            }else{
    			//不成功时，主持人删除日志操作 Start
    			$zcrinfo2 = $weibo_obj->deleteHostLog($SerialNo,$RadioID,$rstamp);
    			$xmlstring2 = $clint->DeleteHostLogt($zcrinfo2);
    			//主持人删除日志操作 End
                echo json_encode("failure");
            }
        }else{
        	echo json_encode("failure");
        }
    }
}else if($action == "deletefriend"){
    $deleteName = $_REQUEST["deletename"];
    //file_put_contents("/home/zsc.txt",$result["message"]);
    $result = $client ->post("/rest/json/?method=user.friend.remove",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"friend"=>$deleteName,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    if($result["result"]["success"] == 1){
        echo json_encode("success");
    }else{
        echo json_encode("failure");
    }
}else if($action == "addfriend"){
    $addName = $_REQUEST["addname"];
    $result = $client ->post("/rest/json/?method=user.friend.add",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"friend"=>$addName,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    if($result["result"]["success"] == 1){
        echo json_encode("success");
    }else{
        echo json_encode("failure");
    }
}elseif($action=="announce_check_notice"){//通知z9
   
	$check=$_REQUEST["check"];
	$radioid=$_REQUEST["radioid"];
	$type=$_REQUEST["type"];//通知类型
	$receiver=$_REQUEST["receiver"];//一对一还是全部  
	$json = $_REQUEST["json"];
    $time = $_REQUEST["time"];
    
    $_REQUEST['admin_name']=empty($_REQUEST['admin_name'])?'ywxt.qq.com':$_REQUEST['admin_name'];//方便业务层调用 
    $username=empty($_SESSION['adminstatus']['admin_hostername'])?$_REQUEST['admin_name']:$_SESSION['adminstatus']['admin_hostername'];
    
    $result = $client ->post("/rest/json/?method=create.announce",array("username"=>$username,"json"=>$json,"receiver"=>$receiver,"type"=>$type,"radioID"=>$radioid,"check"=>$check,"send_time"=>$time,"api_key"=>$api_key));
    if($result["result"]["success"] == 1){
        echo json_encode("success");

    }elseif ($result["result"]["success"] == 2){
//    	echo json_encode("successed to create announce but not send");
       echo json_encode("success");
    }
    else {
        echo json_encode("failure");
    }
}else if($action == "announce_preview"){
    $json = $_REQUEST["json"];
    $topic = $_REQUEST["topic"];
    $time = $_REQUEST["time"];
    //$topic = "broadcast/1517203906.qq.com/announce";
    //$topic = "broadcast/ok.qq.com/announce";
    $result = $client ->post("/rest/json/?method=create.announce",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"json"=>$json,"topic"=>$topic,"send_time"=>$time,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    $json = json_encode($result);
 //   file_put_contents("/home/zsc.txt",json_encode($result[]  ."annouce\n",FILE_APPEND);
    if($result["result"]["success"] == 1){
        echo json_encode("success");
    }else{
        echo json_encode("failure");
    }
}else if($action == "announce_check"){
    $json = $_REQUEST["json"];
    $topic = $_REQUEST["topic"];
    $time = $_REQUEST["time"];
    //$topic = "broadcast/1517203906.qq.com/announce";
    //$topic = "broadcast/ok.qq.com/announce";
//    file_put_contents("/home/zsc.txt","\n gsggg:".$json,FILE_APPEND);
    $result = $client ->post("/rest/json/?method=create.announce_by_check",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"json"=>$json,"topic"=>$topic,"send_time"=>$time,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    $json = json_encode($result);
 //   file_put_contents("/home/zsc.txt",json_encode($result[]  ."annouce\n",FILE_APPEND);
    if($result["result"]["success"] == 1){
        echo json_encode("success");
    }else{
        echo json_encode("failure");
    }
}else if($action == "get_name"){
    $name = $_REQUEST["name"];
    
//     $result = $client ->post("/rest/json/?method=user.get_profile",array("username"=>$name,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    $result = $client ->post("/rest/json/?method=user.get_profile",array("username"=>$name,"api_key"=>$api_key));
    if($result["result"]["core"]["username"]){
        echo json_encode($result["result"]["core"]["username"]);
    }else{
        echo json_encode("failure");
    }
}else if($action == "create_vote"){
    $option_text= array();
    $theme = $_REQUEST["theme"];
    $detail = $_REQUEST["detail"];
    $option_text = $_REQUEST["option_text"];
    $option_pic = $_REQUEST["option_pic"];
    $deadline = $_REQUEST["death_time"];
    $vote_type = $_REQUEST["vote_type"];
    $max_vote_num = $_REQUEST["max_vote_num"];
    $data = array();
    $data["username"] = $_SESSION['adminstatus']['admin_hostername'];
    $data["theme"] = $theme;
    $data["description"] = $detail;
    if($option_text)
        foreach($option_text as $i => $text){
            $str = 'option_text['.$i.']';
            $data[$str] = $text;
        }
    $data["deadline"] = $deadline;
    $data["multiple"] = $vote_type;
    $data["max_vote_num"] = $max_vote_num;
    if($option_pic)
        foreach($option_pic as $i => $pic){
            $str = 'option_pic['.$i.']';
            $data[$str] = $pic;
        }
    $data["api_key"] = $api_key;
    $data["auth_token"] = $gettoken["result"];
    //file_put_contents("/home/zsc.txt","\nliyuanqq:".$data["max_vote_num"],FILE_APPEND);
    $result = $client ->post("/rest/json/?method=create.vote",$data);
    if($result["result"]["success"] == 1){
        echo json_encode($result["result"]);
    }else{
        echo json_encode("failure");
    }
}else if($action == "stop_vote"){
    $id = $_REQUEST["id"];
    $result = $client ->post("/rest/json/?method=stop.vote",array("id"=>$id,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    if($result['result']['success'] == 1){
        $time = date('Y-m-d H:i:s',$result['result']['deadline']);
        echo json_encode($time);

    }else{
        echo json_encode("failure");
    }
}else if($action == "get_top"){
    $top_wire = $client ->post("/rest/json/?method=wire.get_top",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"count"=>3,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    if($top_wire['status'] != -1){
        if(count($top_wire['result']) < 3){
            echo json_encode('success');
        }else{
            echo json_encode($top_wire['result']);
        }

    }else{
        echo json_encode("failure");
    }
}else if($action == "get_vote"){
    $id = $_REQUEST["vote_id"];
    $vote = $client ->post("/rest/json/?method=get.vote_by_id",array("id"=>$id,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));    
    //file_put_contents("/home/zsc.txt",json_encode($vote)." vote\n",FILE_APPEND);
    if($vote['status'] != -1){
        echo json_encode($vote['result']);
    }else{
        echo json_encode("failure");
    }
}else if($action == "create_luck"){
    $option_text= array();
    $theme = $_REQUEST["theme"];
    $good = $_REQUEST["good"];
    $id = $_REQUEST["id"];
    $vote_id=$_REQUEST["vote_id"];
    $count = $_REQUEST["count"];
    $data = array();
    $data["username"] = $_SESSION['adminstatus']['admin_hostername'];
    $data["vote_id"] = $vote_id;
    $data["theme"] = $theme;
    if($id)
        $id = array_reverse($id);
        foreach($id as $i => $d){
            $str = 'ids['.$i.']';
            $data[$str] = $d;
        }
    if($good)
        $good = array_reverse($good);
        foreach($good as $i => $g){
            $str = 'option_good['.$i.']';
            $data[$str] = $g;
        }
    if($count)
        $count = array_reverse($count);
        foreach($count as $i => $c){
            $str = 'option_number['.$i.']';
            $data[$str] = $c;
        }
    $data["api_key"] = $api_key;
    $data["auth_token"] = $gettoken["result"];
    $result = $client ->post("/rest/json/?method=create.luck",$data);
    if($result['result']['success'] == 1){
        echo json_encode($result['result']['luck_id']);
    }else{
        echo json_encode("failure");
    }
}else if($action == "get_luck"){
    $vote = $_REQUEST['vote'];
    $result = $client ->post("/rest/json/?method=get.luck",array("vote_id"=>$vote,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    //file_put_contents("/home/zsc.txt",json_encode($result)."asdf asfd\n",FILE_APPEND);
    if($result['result']['success'] == 1){
        $result['result']['time_created'] = date('Y-m-d H:i:s',$result['result']['time_created']);
        echo json_encode($result['result']);

    }else{
        echo json_encode("failure");
    }
}else if($action == "luck_success"){
    $id = $_REQUEST['id'];
    $result = $client ->post("/rest/json/?method=luck.success",array("vote_id"=>$id,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
    if($result['result']['success'] == 1){
        echo json_encode("success");
    }else{
        echo json_encode("failure");
    }
}else if($action == "areplyweixin"){
    $id = $_REQUEST['id'];
    $str = $weibo_obj->replyWeixin($id);
    echo json_encode("success");
}
else if($action=="replyweixin"){
	
       $profile = $client->post("/rest/json/?method=weixin.get_user",array("username"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        $appId = $profile["result"]['data']["AppId"];
        $appSecret = $profile["result"]['data']["AppSecret"];
        $text = $_REQUEST['commentText'];
        $id = $_REQUEST['id'];
        $weixinInfo = array();
        $weixinInfo["touser"] = $id;
        $weixinInfo["msgtype"] = "text";
        $weixinInfo["text"]["content"] = $text;
        $content = "{\"touser\":\"$id\",\"msgtype\":\"text\",\"text\":{\"content\":\"$text\"}}";
        //$content = json_encode($weixinInfo);
 //       file_put_contents("/home/zsc.txt", "$content\n", FILE_APPEND);
        $addComment = $client ->post("/rest/json/?method=weixin.send_info",array("username"=>$_SESSION['adminstatus']['admin_name'],"appid"=>$appId,"appsecret"=>$appSecret,"content"=>$content,"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
   //     file_put_contents("/home/zsc.txt", json_encode($addComment)."\n", FILE_APPEND);

        if($addComment['result']['success']){
            echo json_encode("success");
        }else{
            echo json_encode("failure");
        }
}else if($action=="addCommonRoad"){
        $rid = $_REQUEST['rid'];
        $roadname = $_REQUEST['roadname'];
        $position = $_REQUEST['position'];
        $initials = $weibo_obj->getInitials($roadname);
        if(!empty($rid)&&!empty($roadname)&&!empty($position)){
                $str = $weibo_obj->add_CommonRoad("commonroad",$rid,$roadname,$initials,$position);
                if($str == "success"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
}else if($action=="quickSearch"){
                if(empty($_POST['quickkwd'])){
                	$commonroadList = $weibo_obj->query_CommonRoad();
                }else{
                	$quickkwd = $_POST['quickkwd'];
                	$commonroadList = $weibo_obj->quick_Search($quickkwd);
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
}else if($action=="delCommomRoad"){
        $rid = $_REQUEST['rid'];
        if(!empty($rid)){
                $str = $weibo_obj->del_CommonRoad($rid);
                if($str == "success"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
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
                $info = $weibo_obj->add_roadinfo($SerialNo,$RadioID,$hostweibo,$roadname,$position,$Type,"",$direction,$situation,"",$roadtext);
                $result = $clint->InsertRoadInfo($info);
                preg_match_all('/<OK>([^<]+)</',$result,$rs);
                $str = $rs[1][0];
                if($str == "00"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
}else if($action=="modifyRoadInfo"){
        $No = $_REQUEST['No'];
        $Name = $_REQUEST['Name'];
        $Op = $_REQUEST['Op'];
        if(empty($No)){
        	echo json_encode("failure:No is null");
        }else{
        	    $SerialNo="123456";
        	    //$RadioID="0024";
//        	    $profile = $client->post("/rest/json/?method=user.get_profile",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
//        	    $WeiboID=$profile['result']['core']['name'];
        	    $WeiboID=$_SESSION['adminstatus']['admin_hostername'];
        	    if($Op!="0"){
        	    	$Op = time();
        	    }
                $info = $weibo_obj->Modifyroadinfo($SerialNo,$RadioID,$WeiboID,$No,$Name,$Op);
//                echo json_encode($info);
                $result = $clint->ModifyRoadInfo($info);
                preg_match_all('/<OK>([^<]+)</',$result,$rs);
                $str = $rs[1][0];
                if($str == "00"){
                	echo json_encode("success");
                }else{
                	echo json_encode("failure");
                }
        }
}else if($action=="getRoadCount"){
        $MaxNo = $_REQUEST['maxno'];
        $MaxIsMark = $_REQUEST['maxismark'];
        //echo json_encode($MaxNo." - ".$MaxIsMark);
        if($MaxNo!=""&&$MaxIsMark!=""){
        	    $SerialNo="123456";
        	    //$RadioID="0024";
//        	    $profile = $client->post("/rest/json/?method=user.get_profile",array("username"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
//        	    $WeiboID=$profile['result']['core']['name'];
        	    $WeiboID=$_SESSION['adminstatus']['admin_hostername'];
                $info = $weibo_obj->getroadcount($SerialNo,$RadioID,$WeiboID,$MaxNo,$MaxIsMark);
                $response= $clint->getRoadCount($info);
                //echo json_encode($MaxNo." - ".$MaxIsMark." - ".$response);
                $result = $weibo_obj->roadcountReadXML($response);
                if($result['OK'] == "00"){
                	if($result['NoCount'] != "0"||$result['MarkCount'] != "0"){
                		echo json_encode("hasnew");
                	}else{
                		echo json_encode("notnew");
                	}
                }else{
                	echo json_encode("failure");
                }
        }
}else if($action=="queryRoadOption"){
	//路况查询有时间限制，3600秒内的路况可查
    $SerialNo="123456";
    //$RadioID="0024";
    $Type="2";
    $Situation="";
    if($_POST['queryOpS']&&$_POST['queryOpS']!='00'){
        $Situation = $_POST['queryOpS'];
    }
    $Key="No";
    if($_POST['queryOpB']){
    	$Key = $_POST['queryOpB'];
    }
    if($_POST['queryOpVal']=='0'||$_POST['queryOpVal']=='1'){
    	$Value=$_POST['queryOpVal'];
    }else{
    	$Value="2";
    }
    $Page="1";
    $PageCount="15";
    //echo $SerialNo." - ".$RadioID." - ".$Type." - ".$Situation." - ".$Key." - ".$Value." - ".$Page." - ".$PageCount;
    //echo '<br>';
    $info_1 = $weibo_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,"","",$Key,$Value,$Page,$PageCount);
    $xmlstring = $clint->RoadInfoQuery($info_1);
    $roadinfo = $weibo_obj->readXML($xmlstring);
    //print_r($roadinfo);
    if($roadinfo['OK']=='00'){
    	if($roadinfo['InfoList']){
        	$roadinfolist = $roadinfo['InfoList'];
        	$innerhtml = "";
        	//print_r($roadinfolist);
        	//$innerhtml .= $Key." = ".$Value." = ".$Situation;
        	if($Key=="No" && $Value=="2" && $Situation==""){
        		$maxno = $roadinfo['MaxNo'];
        		$maxismark = $roadinfo['MaxIsMark'];
        	}else{
        		$maxno = $_POST['maxno'];
        		$maxismark = $_POST['maxismark'];
        	}
        	//$innerhtml .= $maxno." - ".$maxismark;
        	$innerhtml .= "<input type='hidden' id='maxno' name='maxno' value='".$maxno."'/>
                       <input type='hidden' id='maxismark' name='maxismark' value='".$maxismark."'/>";
        	foreach($roadinfolist as $akey=>$avalue){
        		$innerhtml .= "<div id='r_item".$avalue['No']."' class='r_item'>";
/*
//        		if($avalue['num'] == "1"){
//        			$innerhtml .= "<input type='hidden' id='maxno' name='maxno' value='".$avalue['No']."'/>";
//        		}
*/
                $innerhtml .= "<div id='r_left".$avalue['No']."' class='r_left'><!--星标记-->
                                <input type='hidden' id='fi_ismark".$avalue['No']."' name='fi_ismark".$avalue['No']."' value='".$avalue['Ismark']."' />";
        		if($avalue['Ismark'] == "0"){
        			$innerhtml .="<div id='xingbiao".$avalue['No']."' class='xingbiao' onclick=\"turn_Read('".$avalue['No']."','ismark')\"></div>";
        		}else{
        			$innerhtml .="<div id='xingbiao".$avalue['No']."' class='xingbiao_b' onclick=\"turn_Read('".$avalue['No']."','ismark')\"></div>
                                  <input id='markmax".$avalue['num']."' type='hidden' value=''/>";
        		}
        		$innerhtml .="</div>";
        		$innerhtml .="<div id='r_middle".$avalue['No']."' class='r_middle'><!--文字-->";
        		if($avalue['Type'] != "1"){
        			$innerhtml .="<div id='r_text".$avalue['No']."' class='r_text'>";
        		}else{
        			$innerhtml .="<div id='r_text".$avalue['No']."' class='r_text_q'>";
        		}
        		$avalue['num']=empty($avalue['num'])?'1':$avalue['num'];
        		$innerhtml .="<table border='0' align='left' cellpadding='0' cellspacing='0'>
                                     <tr>
                                         <td width='15px'>".$avalue['num'].".
                                         </td>
                                         <td>".$avalue['Memo'];
        		if($avalue['ImgUrl'] != "" && $avalue['ImgUrl'] != '0'){
        			$ImgUrlarray = explode(';', $avalue['ImgUrl'],-1);
        			 
        			$innerhtml .="&nbsp;<img style='cursor:pointer' id='image".$avalue['No']."' src='cn/img/weibo/road/picture.png' width='22px' height='17px' onClick=\"$('#image_div".$avalue['No']."').show()\"/>";
        			//$innerhtml .=$avalue['ImgUrl'];
        			$innerhtml .="<div id='image_div".$avalue['No']."' class ='Limage' style='display:none;' ><div style='width:90%;position:fixed;text-align:center;margin-top:80px;'>";
        			$innerhtml .="<img  id='showImageImg".$avalue['No']."' style='max-height:800px;' src='".$ImgUrlarray['0']."' /><button class='closebutton' type='button' onClick=\"$('#image_div".$avalue['No']."').hide()\"><font color='#FFFFFF'>&times;</font></button>";
        			$innerhtml .="</div><div style='width:10%;float:right;text-align:center;'>";
        			foreach ($ImgUrlarray as $imgvalue){
        				$innerhtml .="<img style='position:relative;padding-bottom: 8px; cursor:pointer;margin-top:80px;' class='img_small_show' src='".$imgvalue."' onClick=\"$('#showImageImg".$avalue['No']."').attr('src','".$imgvalue."')\" />";
        			}
        			$innerhtml .="</div></div>";
        		}
        		if($avalue['VoiceUrl'] != ""&&$avalue['VoiceUrl'] != '0'){
        			$innerhtml .="&nbsp;<span style='position:relative;'><a style='cursor:pointer;' href='".$avalue['VoiceUrl']."' ><img src='cn/img/weibo/road/voice.png' width='22px' height='17px'/></a></span><span style='position:relative;top:-1px;'><a title='下载语音' style='color:#25690c;cursor:pointer;' onclick=\"download_img('".$avalue['VoiceUrl']."')\"><font style=\"font-family:'Microsoft YaHei';font-size:12px;\">下载语音</font></a></span>";
        		}
        		$innerhtml .="</td>
                                     </tr>
                                  </table>
                                  </div>
                             </div>";
        		$innerhtml.="<div id='r_right".$avalue['No']."' class='r_right'>
                                <input type='hidden' id='fi_isread".$avalue['No']."' name='fi_isread".$avalue['No']."' value='".$avalue['Isread']."' />";
        		if($avalue['Isread'] == "0"){
        			$innerhtml.="<div id='r_up".$avalue['No']."' class='r_up' onclick=\"turn_Read('".$avalue['No']."','isread')\"><!--未读-->
                                  </div>";
        		}else{
        			$innerhtml.="<div id='r_up".$avalue['No']."' class='r_up_y' onclick=\"turn_Read('".$avalue['No']."','isread')\"><!--已读-->
                                  </div>";
        		}
        		$innerhtml.= "<div class='clear'></div>
                              </div>
        				     <div class='clear'></div>
        				     <div id='r_below".$avalue['No']."' class='r_below'><!--发布人和时间-->
                                        <div id='r_shijian".$avalue['No']."' class='r_shijian'><!--7:50-->".$avalue['CreateTime']."
                                        </div>
                                        <div id='r_nichen".$avalue['No']."' class='r_nichen'><!--Somon-->".$avalue['Hostweibo']."
                                        </div>
                                        <div class='clear'></div>
                              </div>
                                                              
                        </div>
                        <div class='clear'></div>";
        	}
        	echo $innerhtml;
        }else{
        	echo "dataisnull";
        }
    }else{
    	echo "failure";
    }
}else if($action=="loadRoadInfo"){
	//-----------滚轮加载路况信息-------------
	//路况查询有时间限制，3600秒内的路况可查
    $SerialNo = "123456";
    //$RadioID = "0024";
    $Type = "2";
    $Situation = "";
    if($_GET['situ']&&$_GET['situ']!='00'){
        $Situation = $_GET['situ'];
    }
    $Key = "No";
    if($_GET['key']){
    	$Key = $_GET['key'];
    }
    if($_GET['value']=='0'||$_GET['value']=='1'){
    	$Value = $_GET['value'];
    }else{
    	$Value = "2";
    }
    $Page = "1";
    if($_GET['page']){
    	$Page = $_GET['page'];
    }
    $PageCount = "15";
    if($_GET['pagec']){
    	$PageCount = $_GET['pagec'];
    }
    $beishu = intval($Page);
    //echo $SerialNo." - ".$RadioID." - ".$Type." - ".$Situation." - ".$Key." - ".$Value." - ".$Page." - ".$PageCount;
    //echo '<br>';
    $info_1 = $weibo_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,"","",$Key,$Value,$Page,$PageCount);
    $xmlstring = $clint->RoadInfoQuery($info_1);
    //file_put_contents("d:\\phptest.txt",$xmlstring.'$$$$$$$',FILE_APPEND);
    $roadinfo = $weibo_obj->readXML($xmlstring);
    //print_r($roadinfo);
    if($roadinfo['OK']=='00'){
    	if($roadinfo['InfoList']){
        	$roadinfolist = $roadinfo['InfoList'];
        	$innerhtml = "";
        	$index=0;//LC
        	foreach($roadinfolist as $akey=>$avalue){
        		$innerhtml .= "<div id='r_item".$avalue['No']."' class='r_item'>";
/*
        		if($avalue['num'] == "1"){
        			$innerhtml .= "<input type='hidden' id='maxno' name='maxno' value='".$avalue['No']."'/>";
        		}
*/
                $innerhtml .= "<div id='r_left".$avalue['No']."' class='r_left'><!--星标记-->
                                <input type='hidden' id='fi_ismark".$avalue['No']."' name='fi_ismark".$avalue['No']."' value='".$avalue['Ismark']."' />";
        		if($avalue['Ismark'] == "0"){
        			$innerhtml .="<div id='xingbiao".$avalue['No']."' class='xingbiao' onclick=\"turn_Read('".$avalue['No']."','ismark')\"></div>";
        		}else{
        			$innerhtml .="<div id='xingbiao".$avalue['No']."' class='xingbiao_b' onclick=\"turn_Read('".$avalue['No']."','ismark')\"></div>
                                  <input id='markmax".$avalue['num']."' type='hidden' value=''/>";
        		}
        		$innerhtml .="</div>";
        		$innerhtml .="<div id='r_middle".$avalue['No']."' class='r_middle'><!--文字-->";
        		if($avalue['Type'] != "1"){
        			$innerhtml .="<div id='r_text".$avalue['No']."' class='r_text'>";
        		}else{
        			$innerhtml .="<div id='r_text".$avalue['No']."' class='r_text_q'>";
        		}
        		$avalue['num']=empty($avalue['num'])?'1':$avalue['num'];
        		$xushu = 15*($beishu-1) + intval($avalue['num']);
        		$innerhtml .="<table border='0' align='left' cellpadding='0' cellspacing='0'>
                                     <tr>
                                         <td width='15px'>".$xushu.".
                                         </td>
                                         <td>".$avalue['Memo'];
        		if($avalue['ImgUrl'] != '0' && $avalue['ImgUrl'] != ''){
        			$ImgUrlarray= explode(';', $avalue['ImgUrl'],-1);
        			$innerhtml .="&nbsp;<img style='cursor:pointer' id='image".$avalue['No']."' src='cn/img/weibo/road/picture.png' width='22px' height='17px' onClick=\"$('#image_div".$avalue['No']."').show()\"/>";
        			$innerhtml .="<div id='image_div".$avalue['No']."' class ='Limage' style='display:none;' >";
        			$innerhtml .="<div style='width:90%;position:fixed;margin-top:80px;text-align:center;'>";
        			$innerhtml .="<img  id='showImageImg".$avalue['No']."' style='max-height:800px;' src='".$ImgUrlarray[0]."' />";
        			$innerhtml .="<button class='closebutton' type='button' onClick=\"$('#image_div".$avalue['No']."').hide()\"><font color='#FFFFFF'>&times;</font></button>";
        			$innerhtml .="</div>";
        			$innerhtml .="<div style='width:10%;float:right;text-align:center;margin-top:80px'>";
        			foreach($ImgUrlarray as $imgvalue){
        				if ($imgvalue!=''){
        					$innerhtml .="<img style='position:relative;padding-bottom: 8px; cursor:pointer;' class='img_small_show' src='".$imgvalue."'onClick=\"$('#showImageImg".$avalue['No']."').attr('src','".$imgvalue."')\" />";
        				}
        			}
        			$innerhtml .="</div></div>";
        		}
        		
        		
        		if($avalue['VoiceUrl'] != ""&&$avalue['VoiceUrl'] != '0'){
        			$innerhtml .="&nbsp;<span style='position:relative;'><a style='cursor:pointer;' href='".$avalue['VoiceUrl']."' ><img src='cn/img/weibo/road/voice.png' width='22px' height='17px'/></a></span><span style='position:relative;top:-1px;'><a title='下载语音' style='color:#25690c;cursor:pointer;' onclick=\"download_img('".$avalue['VoiceUrl']."')\"><font style=\"font-family:'Microsoft YaHei';font-size:12px;\">下载语音</font></a></span>";
        		}
        		
        		$innerhtml .="</td>
                                     </tr>
                                  </table>
                                  </div>
                             </div>";
        		$innerhtml.="<div id='r_right".$avalue['No']."' class='r_right'>
                                <input type='hidden' id='fi_isread".$avalue['No']."' name='fi_isread".$avalue['No']."' value='".$avalue['Isread']."' />";
        		if($avalue['Isread'] == "0"){
        			$innerhtml.="<div id='r_up".$avalue['No']."' class='r_up' onclick=\"turn_Read('".$avalue['No']."','isread')\"><!--未读-->
                                  </div>";
        		}else{
        			$innerhtml.="<div id='r_up".$avalue['No']."' class='r_up_y' onclick=\"turn_Read('".$avalue['No']."','isread')\"><!--已读-->
                                  </div>";
        		}
        		$innerhtml.= " <div class='clear'></div>
                               </div>
        				      <div class='clear'></div>
        				       <div id='r_below".$avalue['No']."' class='r_below'><!--发布人和时间-->
                                        <div id='r_shijian".$avalue['No']."' class='r_shijian'><!--7:50-->".$avalue['CreateTime']."
                                        </div>
                                        <div id='r_nichen".$avalue['No']."' class='r_nichen'><!--Somon-->".$avalue['Hostweibo']."
                                        </div>
                                        <div class='clear'></div>
                                  </div>
                                  <div class='clear'></div>
                             </div>";
        	}
        }else{
        	$innerhtml = "<div id='no_data' align='center' style='color:#585858;font-size:14px;'>亲，没有路况信息了</div>";
        }
    }else{
    	$innerhtml = "<div id='no_data' align='center' style='color:#585858;font-size:14px;'>抱歉，加载失败</div>";
    }
    //file_put_contents("d:\\phptest.txt",$innerhtml."######",FILE_APPEND);
    echo $innerhtml;
}else if($action=="queryWeather"){
        $Location = $_GET['city'];
        if(empty($Location)){
        	echo json_encode("failure:Location is null");
        }else{
        	    $innerhtml = "";
        	    $SerialNo="123456";
        	    //$RadioID="0024";
        	    $Location = iconv("GB2312","UTF-8",$Location);
                $info = $weibo_obj->queryWeatherInfo($SerialNo,$RadioID,$Location);
                $xmlstring = $clint->QueryWeather($info);
                $infoarrays = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
                $infoarray = $infoarrays['QueryWeatherOut'];
                if($infoarray['OK'] == '00'){
                	$weatherinfos = $infoarray['WeatherInfo'];
                	$weatherinfo_s = json_decode($weatherinfos,true);
                	if($weatherinfo_s['reason'] == 'Success'){
                		$weatherinfo = $weatherinfo_s['result'];
                		//sk today future
                		$innerhtml .= $weatherinfo['today']['city']."&nbsp;&nbsp;&nbsp;".$weatherinfo['today']['weather']."&nbsp;&nbsp;&nbsp;".$weatherinfo['sk']['temp']."℃<br>湿度".$weatherinfo['sk']['humidity']."&nbsp;&nbsp;&nbsp;".$weatherinfo['sk']['wind_direction'].$weatherinfo['sk']['wind_strength'];
                	}
                	$AirInfos = $infoarray['AirInfo'];
                	$AirInfo = json_decode($AirInfos,true);
                	if($AirInfo['reason'] == 'Success'){
                		$innerhtml .= "<br>空气".$AirInfo['result']['Quality']."&nbsp;&nbsp;&nbsp;PM2.5&nbsp;".substr($AirInfo['result']['PM25'],0,strpos($AirInfo['result']['PM25'],"μg/m³")); //μg/m³
                	}
                	echo $innerhtml;
                }else{
                	echo json_encode("failure:no weather");
                }
        }
}else if($action=="mapMarkShow"){
	
	$lngX = $_GET['lng'];
	$latY = $_GET['lat'];
	
	//路况查询有时间限制，3600秒内的路况可查
    $SerialNo="123456";
    //$RadioID="0024";
    $Type="2";
    $Situation="";
    $Key="No";
    $Value="2";
    $Page="1";
    $PageCount="100";
    //$info_1 = $weibo_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,"","",$Key,$Value,$Page,$PageCount);
    $info_1 = $weibo_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,$lngX,$latY,$Key,$Value,$Page,$PageCount);
    $xmlstring = $clint->RoadInfoQuery($info_1);
    $roadinfo = $weibo_obj->xmlToArr(simplexml_load_string($xmlstring),true); 
    if($roadinfo['QueryOut']['InfoList']['info']){
    	$roadmarkinfo = $roadinfo['QueryOut']['InfoList']; 
    	$roadmarkinfo['coun'] = count($roadinfo['QueryOut']['InfoList']['info']);
    	echo json_encode($roadmarkinfo);
    }else{
    	echo "get roadMarkinfo failure";
    }
}else if($action=="getColumnList"){
	$ctype = $_GET['ctype'];
	if($ctype=='0'){
		$columns = $client->post("/rest/json/?method=get.program_by_compere1",array("guid"=>$group_guid,"UserName"=>$_SESSION['adminstatus']['admin_hostername'],"api_key"=>$api_key));
	}elseif($ctype=='1'){
		$columns = $client->post("/rest/json/?method=user.gettopic_list_compere",array("group_guid"=>$group_guid,"limit"=>"0","offset"=>"0","topic_grade"=>"2","api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
	}elseif($ctype=='2'){
		$columns = $client->post("/rest/json/?method=get.program_by_radio",array("guid"=>$group_guid,"freqid"=>"","api_key"=>$api_key));
	}else{
		$columns = 0;
	}
	//print_r($columns['result']);
	if($columns['status'] != "-1"){
		$innerhtml = "";
		foreach($columns['result'] as $key => $value){
			if($ctype=='0'){
				$columnName = $value['ProgramName'];
			}elseif($ctype=='1'){
				$columnName = $value['topic_name'];
			}elseif($ctype=='2'){
				$columnName = $value;
			}
			$innerhtml .= "<tr><td id='col".$key."' height='22px' align='left' valign='middle' style='border:1px solid #C0C0C0;border-top:none;' onmouseover=\"this.style.color='#808080'\" onmouseout=\"this.style.color='#A9A9A9'\" onclick=\"getColumnWeibo('".$columnName."')\">&nbsp;&nbsp;".$columnName."&nbsp;&nbsp;</td></tr>";
		}
		echo $innerhtml;
	}else{
		echo $innerhtml .= "<tr><td id='col_no' height='22px' align='left' valign='middle' style='border:1px solid #C0C0C0;border-top:none;'>亲，找不到栏目啦！</td></tr>";
	}
}else if($action=="doColumnSearch"){
	$colname = $weibo_obj->unescape($_GET['coln']);
	$columns = $client->post("/rest/json/?method=get.program_by_key",array("key"=>$colname,"guid"=>$group_guid,"api_key"=>$api_key));
	if($columns['status'] != "-1"){
		$innerhtml = "";
		foreach($columns['result'] as $key => $value){
			$innerhtml .= "<tr><td id='col".$key."' height='22px' align='left' valign='middle' style='border:1px solid #C0C0C0;border-top:none;' onmouseover=\"this.style.color='#808080'\" onmouseout=\"this.style.color='#A9A9A9'\" onclick=\"getColumnWeibo('".$value."')\">&nbsp;&nbsp;".$value."&nbsp;&nbsp;</td></tr>";
		}
		echo $innerhtml;
	}else{
		echo $innerhtml .= "<tr><td id='col_no' height='22px' align='left' valign='middle' style='border:1px solid #C0C0C0;border-top:none;'>亲，找不到栏目啦！</td></tr>";
	}
}else if($action=="getTopicTips"){
	$t_type = $_GET['type'];
	if($t_type=="1"){
		$columns = $client->post("/rest/json/?method=hot.topic_compere",array("topic_grade"=>"0", "group_guid"=>$group_guid, "begin_time"=>"", "end_time"=>"", "limit"=>"10", "offset"=>"0", "api_key"=>$api_key, "auth_token"=>$gettoken["result"]));
	}elseif($t_type=="2"){
		$t_kwd = $_GET['kwd'];
		$columns = $client->post("/rest/json/?method=get.topic_by_key",array("key"=>$t_kwd, "guid"=>$group_guid, "api_key"=>$api_key));
	}
	//print_r($columns['result'][0]);
	if($columns['result'] != null){
		$innerhtml = "";
		foreach($columns['result'] as $key => $value){
			$innerhtml .= "<tr><td id='topic".$key."' height='22px' align='left' valign='middle' onmouseover=\"this.style.color='#69a155';this.style.backgroundColor='#eeeeee';\" onmouseout=\"this.style.color='#c0c0c0';this.style.backgroundColor='#ffffff';\" onclick=\"fullTopic('".$value['topic_name']."')\">&nbsp;&nbsp;".$value['topic_name']."&nbsp;&nbsp;</td></tr>";
		}
		echo $innerhtml;
	}
}elseif ($action=="getNewRoad"){	
	//获取最新路况zhb 2014.10.27
	    $MaxNo =$_REQUEST['maxno'];
	    $MaxIsMark='0';
        //$MaxIsMark = $_REQUEST['maxismark'];
        if($MaxNo!=""){       	    
        	
        $SerialNo="123456";
        $WeiboID=$_SESSION['adminstatus']['admin_hostername'];
	    $info_1 = $weibo_obj->queryNewRoadCount($SerialNo,$RadioID,$WeiboID,$MaxNo,$MaxIsMark);
        $xmlstring = $clint->queryNewRoadCount ($info_1);
        $newRoad = $weibo_obj->queryNewRoadRequest($xmlstring);
       
        if ($newRoad['OK']=='00') {
        	if ($newRoad['NoCount']!=0) {       		
        		echo  json_encode($newRoad);//最新路况数
        	}else {
        		echo json_encode('fail');//说明没有新路况        		
        	}
        }else {
        	echo json_encode("fail");//获取新路况失败
        }              
        }
        else 
        {echo json_encode("fail");}
}elseif ($action=="getNewColumnWeibo"){	//新发栏目微博zhb 2014.10.30
	
		$Maxwire_guid=$_REQUEST['maxColumnWeibono'];	
		
		 $wires = $client->post("/rest/json/?method=topic.wire_unread_count",array("topic_name"=>$_SESSION['ProgramName'],"group_guid"=>$group_guid,"wire_guid"=>$Maxwire_guid,"api_key"=>$api_key));  
		
			if ($wires["status"] == 0)
			 {
		 	   echo json_encode($wires["result"]);
		     }
		     else {
		 	echo json_encode("fail");//无数据
		       }

}elseif ($action=="getNewAtHosterWeibo"){//新发@主持人的微博zhb 2014.10.30
//	$group_guid="18324";
	$Maxwire_guid=$_REQUEST['maxAtHosterWeibono'];	
	$wires = $client->post("/rest/json/?method=wire.mentions_unread_count",array("username"=>$_SESSION['adminstatus']['admin_name'],"group_guid"=>$group_guid,"wire_guid"=>$Maxwire_guid,"api_key"=>$api_key));  
        if($wires["status"] == 0){
        	echo json_encode($wires["result"]);
        }else {
        	echo json_encode("fail");
        }
}  else if ($action=="topicList"){
//--------------------------------------------- lichun 添加 topic Start 2014.11.05 --3/4----------------------------------
// 	$group_original= $client ->post("/rest/json/?method=group.get_groups",array("context"=>"public_original","limit"=>"1","offset"=>"0","username"=>$_SESSION['adminstatus']['admin_name'],"api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
// 	$group_guid = $group_original['result'][0]['guid'];
	$topic = $client ->post("/rest/json/?method=topic.getlist",array("group_guid"=>$group_guid,"topic_grade" =>1,"limit" =>10, "offset" =>0,"api_key"=>$api_key));
//  print_r($topic);
	if ($topic['status']== 0){
//		file_put_contents("d:\\zhuchiren.txt","3--------:",FILE_APPEND);
		if ($topic['result']['success']!= -1){
// 			file_put_contents("d:\\zhuchiren.txt","4--------:",FILE_APPEND);
			$topics = $weibo_obj->transElggTopicgetList( $topic['result'] );
//  		print_r($topics);			
// 			file_put_contents("d:\\zhuchiren.txt","5--------:",FILE_APPEND);
 			echo json_encode($topics);
		}
	} else {
// 		file_put_contents("d:\\zhuchiren.txt","2--------:",FILE_APPEND);
		echo json_encode(null);	
	}	
	
}
//--------------------------------------------- lichun 添加 topic End 2014.11.05 ------3/4------------------------------



?>
