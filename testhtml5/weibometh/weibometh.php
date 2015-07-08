<?php

namespace weibometh;
require("function.php");
class weibometh {
	function getElggWeiboNum($wireList){
		$number = 0;
		foreach($wireList as $single){
			$number++;
		}
	
		return $number;
	}
	//only homepage,previous,next
	function getPageUrlString2($page, $tail, $min, $max, $opcontent, $query_c="1"){
		global $constant;
		// ��ҳt��
		if($page == 1){
			$page_string .= $constant["pubpage"]["HomePage"].'|'.$constant["pubpage"]["Previous"].'|';
		}else if($page == 2){
			$page_string.= '<a href=admin.php?'.$opcontent.'&action=init&page=1>'.$constant["pubpage"]["HomePage"].'</a>|<a href=admin.php?'.$opcontent.'&action=init&page=1>'.$constant["pubpage"]["Previous"].'</a>|';
		}
		else{
			$page_string.= '<a href=admin.php?'.$opcontent.'&action=init&page=1>'.$constant["pubpage"]["HomePage"].'</a>|<a href="javascript:history.back(-1);" style="cursor:pointer;">'.$constant["pubpage"]["Previous"].'</a>|';
		}
		if($tail){
			$page_string .= $constant["pubpage"]["Next"];
		}else{
			$page_string .= '<a href=admin.php?'.$opcontent.'&action=more&page='.($page+1).'&min='.$min.'>'.$constant["pubpage"]["Next"].'</a>';
		}
		return $page_string;
	}
	function transElggData($wireList,$compere,$time = 0 ){
		// file_put_contents("/home/zsc.txt", $compere."ssss\n",FILE_APPEND);
		global $userdb;
		$index = 0;
		if($time == 1){
			$number = 15;
		}else if($time == 2){
			$number = 30;
		}else if ($time==3){
			$number=45;//zhb27 hotweibo
		}else if ($time==4){
			$number=60;//zhb27 hotweibo
		}else if ($time==5){
			$number=75;//zhb27 hotweibo
		}else if ($time==6){
			$number=90;//zhb27 hotweibo
		}
		else{
			$number = 0;
		}
		foreach($wireList as $single){
			$weiboInfo[$index]["ID"]          = $single['guid'];
			$weiboInfo[$index]["Sender"]      = $single['owner']['name'];
			$weiboInfo[$index]["Username"]      = $single['owner']['username'];
			$weiboInfo[$index]["AvatarUrl"]   = $single['owner']['avatar_url'];
			$weiboInfo[$index]["Time"]        = tranTime($single['time_created']);
			$weiboInfo[$index]["timeTime"]        = date("H:i",$single['time_created']);
			$weiboInfo[$index]["DayTime"]        = date("Y.m.d",$single['time_created']);
			$weiboInfo[$index]["shareContent"] = $single['description'];  //新添加了这一条语句 2014.09.19
			$str = $this->thewire_filter($single['description']);
			//    $str_img="<img src=\"http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/58/pig.gif\" height=\"22\" width=\"22\" />";
			//  $str=str_replace("[zhutou]",$str_img,$str);
			$str=replaceEmotions($str);
			 
			//file_put_contents("/home/zsc.txt","\nclass:".$str,FILE_APPEND);
			$weiboInfo[$index]["Content"]     = $str;
			//$weiboInfo[$index]["ContentLong"]     = $single['description'];
			$weiboInfo[$index]["ContentLong"]   = str_replace('"','>!<',$single['description']);
			$weiboInfo[$index]["ContentLong"]   = str_replace('\'','>?<',$weiboInfo[$index]["ContentLong"]);
			$weiboInfo[$index]["ContentLong"] = preg_replace("/\s+/", "  ", $weiboInfo[$index]["ContentLong"]);
			if($single['owner']['mentions'])
				$weiboInfo[$index]['Mentions'] = $single['owner']['mentions'];
			$weiboInfo[$index]["Audio"]       = $single['audio'];
			$audioLen = floor($single['audiolen']/1000);
			if($audioLen == 0 ){
				$weiboInfo[$index]["AudioLen"] = $audioLen + 1;
			}else{
				$weiboInfo[$index]["AudioLen"] = $audioLen;
			}
			if(strpos($single['pic'],"image")){
				$weiboInfo[$index]["Pic"]         = str_replace(".jpg","small.jpg",$single['pic']);
				$weiboInfo[$index]["PicLarge"]         = str_replace(".jpg","medium.jpg",$single['pic']);
			}
			if(strpos($single['pic'],"thumbnail")){
				$weiboInfo[$index]["Pic"]         = $single['pic'];
				$weiboInfo[$index]["PicLarge"]         = str_replace("thumbnail","bmiddle",$single['pic']);
			}
			//--------------------------------------------- lichun 添加pics show Start 2014.11.06 ---4------5parent---------------------------
			if ($single['pics']){
				$single['pics'] = trim($single['pics']);
				//                 	$weiboInfo[$index]["Pics"] = $single['pics'];
				//                 	$weiboInfo[$index]["PicsLarge"] = explode(';', $single['pics'],-1);
				//                 	$single['pics'] = substr($single['pics'],0,strlen($single['pics'])-1);
				if(strpos($single['pics'],"image")){
					$weiboInfo[$index]["Picstrs"]         = str_replace(".jpg","small.jpg",$single['pics']);
					$weiboInfo[$index]["PicLargestrs"]         = str_replace(".jpg","medium.jpg",$single['pics']);
				}
				if(strpos($single['pics'],"thumbnail")){
					$weiboInfo[$index]["Picstrs"]         = $single['pics'];
					$weiboInfo[$index]["PicLargestrs"]         = str_replace("thumbnail","bmiddle",$single['pics']);
				}
				$weiboInfo[$index]["Pics"]         = explode(';', $weiboInfo[$index]["Picstrs"],-1);
				$weiboInfo[$index]["PicLarges"]         = explode(";",$weiboInfo[$index]["PicLargestrs"],-1);
			}
			//--------------------------------------------- lichun 添加pics show End 2014.11.06 ----4--------5parent------------------------
	
	
			if ($single['attentionsum'])
				$weiboInfo[$index]["attentionsum"]=$single['attentionsum'];//微博热度
			else
				$weiboInfo[$index]["attentionsum"]='1';
	
			if($single['topstatus'])
				$weiboInfo[$index]["TopStatus"] = $single['topstatus'];
			if($single['toptype'])
				$weiboInfo[$index]["TopType"] = $single['toptype'];
			$weiboInfo[$index]["ReplyCount"]  = $single['replycount'];
			$weiboInfo[$index]["notice"]  = $single['parent']['notice'];
			$weiboInfo[$index]["retweetedUsername"]  = $single['parent']['owner']['name'];
			$count = strpos($single['parent']['description'],":");
			$str = $this->thewire_filter(substr($single['parent']['description'],$count+1));
			$weiboInfo[$index]["retweetedContentLong"] = substr($single['parent']['description'],$count+1);
			$weiboInfo[$index]["retweetedContentLong"]   = str_replace('"','>!<',$weiboInfo[$index]["retweetedContentLong"]);
			$weiboInfo[$index]["retweetedContentLong"]   = str_replace('\'',">?<",$weiboInfo[$index]["retweetedContentLong"]);
			$weiboInfo[$index]["retweetedContentLong"] = preg_replace("/\s+/", " ", $weiboInfo[$index]["retweetedContentLong"]);
			$weiboInfo[$index]["retweetedContent"]   = replaceEmotions($str);
			$weiboInfo[$index]["shareretweetedContent"] = substr($single['parent']['description'],$count+1);//新添加了这一条语句 2014.09.19
			$weiboInfo[$index]["retweetedAudio"]       = $single['parent']['audio'];
			//$weiboInfo[$index]["retweetedAudioLen"]    = floor($single['parent']['audiolen']/1000 +1);
			$audioParentLen = floor($single['parent']['audiolen']/1000);
			if($audioParentLen == 0 ){
				$weiboInfo[$index]["retweetedAudioLen"] = $audioPatentLen + 1;
			}else{
				$weiboInfo[$index]["retweetedAudioLen"] = $audioParentLen;
			}
// 			$weiboInfo[$index]["IsTag"] = 0;
// 			$weiboInfo[$index]["IsRead"] = 0;
// 			$sql = "select ID from tagweibo where weiboID = ".$single['guid']." and username = '$compere';";
// 			$res = $userdb->Execute($sql);
// 			if(!$res->EOF){
// 				$weiboInfo[$index]["IsTag"] = 1;
// 			}
// 			$sql = "select ID from tagread where weiboID = ".$single['guid']." and username = '$compere';";
// 			$res = $userdb->Execute($sql);
// 			if(!$res->EOF){
// 				$weiboInfo[$index]["IsRead"] = 1;
// 			}
			if(strpos($single['parent']['pic'],"image")){
				$weiboInfo[$index]["retweetedPic"]         = str_replace(".jpg","small.jpg",$single['parent']['pic']);
				$weiboInfo[$index]["retweetedPicLarge"]         = str_replace(".jpg","medium.jpg",$single['parent']['pic']);
			}
			if(strpos($single['parent']['pic'],"thumbnail")){
				$weiboInfo[$index]["retweetedPic"]         = $single['parent']['pic'];
				$weiboInfo[$index]["retweetedPicLarge"]         = str_replace("thumbnail","bmiddle",$single['parent']['pic']);
			}
			//--------------------------------------------- lichun 添加pics show Start 2014.11.06 ---5--------------------------
			if ($single['parent']['pics']){
				//$single['pics'] = trim($single['parent']['pics']);
				//                 	$weiboInfo[$index]["Pics"] = $single['pics'];
				//                 	$weiboInfo[$index]["PicsLarge"] = explode(';', $single['pics'],-1);
				//                 	$single['pics'] = substr($single['pics'],0,strlen($single['pics'])-1);
				if(strpos($single['parent']['pics'],"image")){
					$weiboInfo[$index]["retweetedPicstrs"]         = str_replace(".jpg","small.jpg",$single['parent']['pics']);
					$weiboInfo[$index]["retweetedPicLargestrs"]         = str_replace(".jpg","medium.jpg",$single['parent']['pics']);
				}
				if(strpos($single['parent']['pics'],"thumbnail")){
					$weiboInfo[$index]["retweetedPicstrs"]         = $single['parent']['pics'];
					$weiboInfo[$index]["retweetedPicLargestrs"]         = str_replace("thumbnail","bmiddle",$single['parent']['pics']);
				}
				$weiboInfo[$index]["retweetedPics"]      = explode(';', $weiboInfo[$index]["retweetedPicstrs"],-1);
				$weiboInfo[$index]["retweetedPicLarges"] = explode(";",$weiboInfo[$index]["retweetedPicLargestrs"],-1);
			}
			//--------------------------------------------- lichun 添加pics show End 2014.11.06 ---5------------------------
	
	
			$weiboInfo[$index]["retweetedTime"]      = tranTime($single['parent']['time_created']);
	
			$weiboInfo[$index]["retweetedCommentCount"]= $single['parent']['commentcount'];
			if($weiboInfo[$index]["retweetedCommentCount"] == null){
				$weiboInfo[$index]["retweetedCommentCount"] = 0;
			}
			$weiboInfo[$index]["retweetedReplyCount"]= $single['parent']['replycount'];
			if($weiboInfo[$index]["retweetedReplyCount"] == null){
				$weiboInfo[$index]["retweetedReplyCount"] = 0;
			}
			if($weiboInfo[$index]["Replycount"] == null){
				$weiboInfo[$index]["ReplyCount"] = 0;
			}
			$weiboInfo[$index]["CommentCount"]= $single['commentcount'];
			if($weiboInfo[$index]["CommentCount"]==null){
				$weiboInfo[$index]["CommentCount"] = 0;
			}
			//$weiboInfo[$index]["IsTag"]       =$res->fields[10];
			//$weiboInfo[$index]["IsRead"]      =$res->fields[11];
			//$weiboInfo[$index]["MediaType"]   =$res->fields[12];
			//$weiboInfo[$index]["Type"]        =$res->fields[13];
			$weiboInfo[$index]["num"]         = $number;
	
			$index++;
			$number++;
		}
		return $weiboInfo;
	}
	function thewire_filter($text) {
		//$text = ' ' . $text;
	
		// email addresses
		$text = preg_replace(
				'/(^|[^\w])([\w\-\.]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})/i',
				'$1<a href="javascript:void(0)">$2@$3</a>',
				$text);
	
		// links
		//        $text = parse_url($text);
	
		// usernames
		$text = preg_replace(
				//            '/(^|[^\w])@([\p{L}\p{Nd}._]+)/u',
				'/@([\p{L}\p{Nd}._]+)/u',
				'<span style="color:#25690c">@$1</span>',
				$text);
	
		// hashtags
		$text = preg_replace(
				'/#(\w*[^\s!-\/:-@]+\w*)#/',
				'<span style="color:#25690c">#$1#</span>',
				//    '$1<a href="javascript:void(0)">#$2#</a>',
				$text);
	
		//        $text = trim($text);
	
		return $text;
	}
	
}

?>