<?php 
//----------------------------------------  路况信息录入 -----------------------------------------------
session_start();
// require_once("global.php");
// use Rest\Client;
// require 'autoload.php';
// useclass("weiboinfo");
// $weibo_obj = new weiboinfo();
//$clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');

require 'roadmeth.php';
$rm_obj=new roadmeth();

$clint=new SoapClient('http://42.121.125.50/bsys/webservice/webserver.wsdl');
$api_key = "09079d4a0ddbe174d3905c1d46bce757804e9189";
$RadioID="0024";
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

// //将radioID写入SESSION，以便客户整个访问会话期间均能通过SESSION使用该值
// if (isset($_REQUEST['radioID'])) {
// 	$_SESSION['radioID']=$_REQUEST['radioID'];
// }
// //else {
// //	$_SESSION['radioID']="0024";//放到云端后去掉
// //}
// //print_r($_SESSION['radioID']);
// if (isset($_REQUEST['freqid'])) {
// 	$_SESSION['freqid']=$_REQUEST['freqid'];
// 	//	print_r($_SESSION['freqid']);
// }
// $_SESSION['adminstatus']['admin_hostername']="zhb.163.com";
// $_SESSION['adminstatus']['hosterpassword']="123456";
// $_SESSION['radioID']="0024";
// $client = new Client('http://42.121.34.216/elgg/services/api/');
// //$gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_name'],"password"=>$_SESSION['adminstatus']['password']));
// $gettoken= $client->post('/rest/json/?method=auth.gettoken',array("username"=>$_SESSION['adminstatus']['admin_hostername'],"password"=>$_SESSION['adminstatus']['hosterpassword']));
// if($gettoken["result"] != null){
    if($action == "init"){
    	//接口预留 Start
        //$wires = $client->post("/rest/json/?method=wire.get_posts",array("context"=>"focus","limit"=>$pageSize,"offset"=>"0","username"=>$_SESSION['adminstatus']['admin_name'],"status"=>"compere","sinceID"=>"-1","api_key"=>$api_key,"auth_token"=>$gettoken["result"]));
        //接口预留 End
    	//路况查询有时间限制，3600秒内的路况可查
        $SerialNo="123456";
//         $RadioID=$_SESSION['radioID'];
        
        $Type="2";
        $Situation="";
        $Key="No";
        $Value="2";
        $Page="1";
        $PageCount="15";
        $info_1 = $rm_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,"","",$Key,$Value,$Page,$PageCount);
        $xmlstring = $clint->RoadInfoQuery($info_1);
        //echo $xmlstring;
        $roadinfo = $rm_obj->readXML($xmlstring);
        if($roadinfo['OK']=='00'){
        	if($roadinfo['InfoList']){
        		$nodata = 'notnull';
        		$roadinfolist = $roadinfo['InfoList'];
        		$index=0;
        		foreach($roadinfolist as $single){
        			if ($single['ImgUrl']!='0' && $single['ImgUrl']!=''){
					//if(strpos($single['ImgUrl'],"image")){
					//		$roadinfolist[$index]["ImgUrl"] = str_replace(".jpg","small.jpg",$single['ImgUrl']);
					//   	$roadinfolist[$index]["ImgUrlLarge"]  = str_replace(".jpg","medium.jpg",$single['ImgUrl']);
					//}
        				$roadinfolist[$index]['ImgUrlarray']         = explode(';', $single['ImgUrl'],-1);
        				//$weiboInfo[$index]["ImgUrlLarge"]         = explode(";",$single['ImgUrl'],-1);
        			}
        			$index++;
        		}
        		$tpl->assign("commonroadList", $roadinfolist);
        		$maxno = $roadinfo['MaxNo'];
        		$maxismark = $roadinfo['MaxIsMark'];
        		$tpl->assign("maxno", $maxno);
        		$tpl->assign("maxismark", $maxismark);
        	}else{
        		$nodata = 'isnull';
        	}
        }else{
        	$nodata = 'isnull';
        }
        
        $maxismark_count=1;
        $tpl->assign("maxismark_count", $maxismark_count);
        $tpl->assign("nodata", $nodata);
        $tpl->display("info/roadInfoList.tpl");
            
    }else if($action == "mapMarkShow"){
    	
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
    	$info_1 = $rm_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,$lngX,$latY,$Key,$Value,$Page,$PageCount);
    	$xmlstring = $clint->RoadInfoQuery($info_1);
    	$roadinfo = $rm_obj->xmlToArr(simplexml_load_string($xmlstring),true);
    	if($roadinfo['QueryOut']['InfoList']['info']){
    		$roadmarkinfo = $roadinfo['QueryOut']['InfoList'];
    		$roadmarkinfo['coun'] = count($roadinfo['QueryOut']['InfoList']['info']);
    		echo json_encode($roadmarkinfo);
    	}else{
    		echo "get roadMarkinfo failure";
    	}
    	
    }elseif ($action =="addCommonRoad"){
    	//twice
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
                $info = $rm_obj->Modifyroadinfo($SerialNo,$RadioID,$WeiboID,$No,$Name,$Op);
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
    $info_1 = $rm_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,"","",$Key,$Value,$Page,$PageCount);
    $xmlstring = $clint->RoadInfoQuery($info_1);
    $roadinfo = $rm_obj->readXML($xmlstring);
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
    $info_1 = $rm_obj->queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,"","",$Key,$Value,$Page,$PageCount);
    $xmlstring = $clint->RoadInfoQuery($info_1);
    //file_put_contents("d:\\phptest.txt",$xmlstring.'$$$$$$$',FILE_APPEND);
    $roadinfo = $rm_obj->readXML($xmlstring);
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
                $info = $rm_obj->getroadcount($SerialNo,$RadioID,$WeiboID,$MaxNo,$MaxIsMark);
                $response= $clint->getRoadCount($info);
                //echo json_encode($MaxNo." - ".$MaxIsMark." - ".$response);
                $result = $rm_obj->roadcountReadXML($response);
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
}
// }
//$tpl->assign("userInfo",$profile['result']);
//$tpl->assign("weiboList",$weiboList);
//$tpl->assign("isExistData", $nowiresmsg);
//$tpl->assign("page", $page);
//$tpl->assign("min", $minID);
//$tpl->assign("max", $maxID);
//$tpl->assign("hasNext", $hasNext);
//$tpl->assign("a", $a);




?>
