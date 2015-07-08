<?php 
class friendlist{
	var $db='';
	var $language;
	function friendlist(){
		$this->table_friendlist='presence';
        $this->table_record="IMs";
        $this->table_friendinfo = "friendInfo";
	}
	function getTotalnums($table,$query_c="1"){
      	global $userdb;
      	$recordnum=0;
    	$q="select count(*) from ".$table." where ".$query_c;
    	$recordSet=&$userdb->Execute($q);
		if(!$recordSet->EOF)
    		$recordnum=$recordSet->fields[0];
    	//$recordSet->close();
        return $recordnum;
     }
    function getPageCount($num_rows,$page_size){
    	//$num_rows=$this->getTotalnums($table,$query_c);
    	// 记算总共有多少页
    	$page_count_array=array();
        if($num_rows){
            if( $num_rows < $page_size){ $page_count = 1; }               //如果总数据量小于$PageSize，那么只有一页
            if( $num_rows % $page_size ){                                  //取总数据量除以每页数的余数
               $page_count = (int)($num_rows / $page_size) + 1;           //如果有余数，则页数等于总数据量除以每页数的结果取整再加一
            }else{
               $page_count = $num_rows / $page_size;                      //如果没有余数，则页数等于总数据量除以每页数的结果
            }
        }else{
            $page_count = 0;
        }
        return $page_count;
    }
	function getjumppagecount($page_count){
    	//$page_count=$this->getPageCount($table,$page_size,$query_c);
        for ($i = 1; $i <=$page_count; $i++){
           $page_count_array[$i-1] = $i;
        }
    	return $page_count_array;    	
    }
	function getpagestring($num_rows,$page,$page_size,$opcontent,$query_c="1"){
		global $constant;
		$page_count=$this->getPageCount($num_rows,$page_size);

        $page_count_array=$this->getjumppagecount($page_count);
			// 翻页链接
			$page_string = $constant["pubpage"]["Total"].$num_rows.$constant["pubpage"]["records"]."&nbsp;&nbsp;&nbsp;&nbsp;";
			if( $page == 1 ){
			  $page_string .= $constant["pubpage"]["HomePage"].'|'.$constant["pubpage"]["Previous"].'|';
			}else{
			  $page_string.= '<a href=admin.php?'.$opcontent.'&page=1>'.$constant["pubpage"]["HomePage"].'</a>|<a href=admin.php?'.$opcontent.'&page='.($page-1).'>'.$constant["pubpage"]["Previous"].'</a>|';
			}
			if( ($page == $page_count) || ($page_count == 0) ){
			  $page_string .= $constant["pubpage"]["Next"].'|'.$constant["pubpage"]["LastPage"];
			}else{
			  $page_string .= '<a href=admin.php?'.$opcontent.'&page='.($page+1).'>'.$constant["pubpage"]["Next"].'</a>|<a href=admin.php?'.$opcontent.'&page='.$page_count.'>'.$constant["pubpage"]["LastPage"].'</a>';
			}
         return $page_string;
    }
    //刷新钱删除数据库中的所有数据
    function delete_allfriends_info($loginname){
		global $userdb;
        $query = "delete  from friendInfo  where FriendName = '".$loginname."' or UserName = '".$loginname."' and FriendName is NULL;";
        //print_r($query);
		$res = $userdb->Execute($query);
    }
    //刷新后从elgg得到所有好友的相关信息
    function insert_allfriends_info($table, $profile, $loginname, $status){
		global $userdb;
       /* $name = iconv("UTF-8","GB2312",$profile['core']['name']);
        $username = iconv("UTF-8","GB2312",$profile['core']['username']);
        $aboutme = iconv("UTF-8","GB2312",$profile['profile_fields']['description']["value"]);
        $briefdescription = iconv("UTF-8","GB2312",$profile['profile_fields']['briefdescription']["value"]);
        $location = iconv("UTF-8","GB2312",$profile['profile_fields']['location']["value"]);
        $interests = iconv("UTF-8","GB2312",$profile['profile_fields']['interests']["value"]);
        $skills = iconv("UTF-8","GB2312",$profile['profile_fields']['skills']["value"]);
        $phone = iconv("UTF-8","GB2312",$profile['profile_fields']['phone']["value"]);
        $mobile = iconv("UTF-8","GB2312",$profile['profile_fields']['mobile']["value"]);
        $website = iconv("UTF-8","GB2312",$profile['profile_fields']['website']["value"]);
        $avatarurl = iconv("UTF-8","GB2312",$profile["avatar_url"]);*/
        $name = $profile['core']['name'];
        $username = $profile['core']['username'];
        $aboutme = $profile['profile_fields']['description']["value"];
        $briefdescription = $profile['profile_fields']['briefdescription']["value"];
        $location = $profile['profile_fields']['location']["value"];
        $interests = $profile['profile_fields']['interests']["value"];
        $skills = $profile['profile_fields']['skills']["value"];
        $phone = $profile['profile_fields']['phone']["value"];
        $mobile = $profile['profile_fields']['mobile']["value"];
        $website = $profile['profile_fields']['website']["value"];
        $avatarurl = $profile["avatar_url"];
        if($status == 1){
		    $query = "insert into ".$table."(Name,UserName,AboutMe,BriefDescription,Location,Interests,Skills,Telephone,MobilePhone,Website,AvatarUrl,FriendName) values('".$name."','".$username."','".$aboutme."','".$briefdescription."','".$location."','".$interests."','".$skills."','".$phone."','".$mobile."','".$website."','".$avatarurl."','".$loginname."');";
        }
        else{
		    $query = "insert into ".$table."(Name,UserName,AboutMe,BriefDescription,Location,Interests,Skills,Telephone,MobilePhone,Website,AvatarUrl) values('".$name."','".$username."','".$aboutme."','".$briefdescription."','".$location."','".$interests."','".$skills."','".$phone."','".$mobile."','".$website."','".$avatarurl."');";
        }
		//$query = "insert into ".$table."(Name,UserName,AboutMe,BriefDescription,Location,Interests,Skills,Telephone,MobilePhone,Website,AvatarUrl,FriendName) values('".$profile["core"]["name"]."','".$profile["core"]["username"]."','".$profile["profile_fields"]["description"]["value"]."','".$profile["profile_fields"]["briefdescription"]["value"]."','".$profile["profile_fields"]["location"]["value"]."','".$profile["profile_fields"]["interests"]["value"]."','".$profile["profile_fields"]["skills"]["value"]."','".$profile["profile_fields"]["phone"]["value"]."','".$profile["profile_fields"]["mobile"]["value"]."','".$profile["profile_fields"]["website"]["value"]."','".$profile["avatar_url"]."','".$loginname."');";
		$res = $userdb->Execute($query);
    //   print_r($query);
        $query = "delete from presence where username = '".$username."' and Type = 'signature';";
		$res = $userdb->Execute($query);
       // print_r($query);
        $query = "insert into presence(UserName, Type, Content) values('".$username."','signature', '".$briefdescription."');";
		$res = $userdb->Execute($query);
//        print_r($query);
    }
    //得到登入者的信息
    function get_logininfo($loginusername){
		global $userdb;
        $query_name = "select friendInfo.Name, friendInfo.UserName,friendInfo.AvatarUrl,presence.Content from friendInfo, presence where friendInfo.UserName = '".$loginusername."' and friendInfo.UserName = presence.UserName and presence.Type = 'signature';";
		$res_name = $userdb->Execute($query_name);
	    $logininfo["Name"] = $res_name->fields[0];
	 //   $logininfo["Name"] = iconv("GB2312","UTF-8",$res_name->fields[0]);
		$logininfo["UserName"] = $res_name->fields[1];
		$logininfo["AvatarUrl"] = $res_name->fields[2];
		$logininfo["Signature"] = $res_name->fields[3];
	//    $logininfo["Signature"] = iconv("GB2312","UTF-8",$res_name->fields[3]);
        return $logininfo;

    }
    //得到在线好友
    function get_friends_online($table,$loginusername){
		global $userdb;
        //**************************************
		$query = "select presence.* from ".$table." ,friendInfo  where Type = 'status' and Content = 'up' and friendInfo.FriendName = '".$loginusername. "' and friendInfo.UserName = presence.UserName order by ID;";
		$res = $userdb->Execute($query);
        //print_r($query);
		$index = 0;
		$number = 1;
		while(!$res->EOF){
			$friendlist[$index]["ID"] = $res->fields[0];
            $query_name = "select friendInfo.Name, friendInfo.UserName,friendInfo.AvatarUrl,presence.Content from friendInfo, presence where friendInfo.UserName = '".$res->fields[1]."' and friendInfo.UserName = presence.UserName and presence.Type = 'signature';";
            $res_name = $userdb->Execute($query_name);
//			$friendlist[$index]["Name"] = iconv("GB2312","UTF-8",$res_name->fields[0]);
		    $friendlist[$index]["Name"] = $res_name->fields[0];
			$friendlist[$index]["UserName"] = $res_name->fields[1];
			$friendlist[$index]["AvatarUrl"] = $res_name->fields[2];
			$friendlist[$index]["Signature"] = $res_name->fields[3];
	//		$friendlist[$index]["Signature"] = iconv("GB2312","UTF-8",$res_name->fields[3]);
			$friendlist[$index]["num"] = $number;
            $index++;
            $number++;
            $res->MoveNext();
        }
        //****************************************
/*		$query = "select * from ".$table." where Type = 'status' and Content = 'up' order by ID;";
		$res = $userdb->Execute($query);
		$index = 0;
		$number = 1;
		while(!$res->EOF){
			$friendlist[$index]["ID"] = $res->fields[0];
            $query_name = "select friendInfo.Name, friendInfo.UserName,friendInfo.AvatarUrl,presence.Content from friendInfo, presence where friendInfo.UserName = '".$res->fields[1]."' and friendInfo.UserName = presence.UserName and presence.Type = 'signature';";
            $res_name = $userdb->Execute($query_name);
			$friendlist[$index]["Name"] = $res_name->fields[0];
			$friendlist[$index]["UserName"] = $res_name->fields[1];
			$friendlist[$index]["AvatarUrl"] = $res_name->fields[2];
			$friendlist[$index]["Signature"] = $res_name->fields[3];
			$friendlist[$index]["num"] = $number;
            $index++;
            $number++;
            $res->MoveNext();
        }*/
        //print_r($friendlist);
        return $friendlist;
    }
    //得到某个好友的新上线的信息
    function get_presence_change($usernamelist,$loginusername){
		global $userdb;
        $index = 0;
        foreach($usernamelist as $key => $username){
		 //   $query = "select * from presence where UserName = '".$username."' and Type = 'status' order by ID;";
		$query = "select presence.* from ".$table." ,friendInfo  where Type = 'status' and Content = 'up' and friendInfo.FriendName = '".$loginusername. "' and friendInfo.UserName = presence.UserName order by ID;";
           // print_r($query);
		    $res = $userdb->Execute($query);
            if(strcmp($res->fields[3],"up") == 0){
			    $friendlist[$index]["ID"] = $res->fields[0];
                $query_name = "select friendInfo.Name, friendInfo.AvatarUrl,presence.Content from friendInfo, presence where friendInfo.UserName = '".$res->fields[1]."' and friendInfo.UserName = presence.UserName and presence.Type = 'signature';";
                $res_name = $userdb->Execute($query_name);
			    $friendlist[$index]["Name"] = $res_name->fields[0];
			    $friendlist[$index]["AvatarUrl"] = $res_name->fields[1];
			    $friendlist[$index]["Signature"] = $res_name->fields[2];
		        $friendlist[$index]["UserName"] = $username;
            }
            else{
		        $friendlist[$index]["UserName"] = $username;
            }
		        $friendlist[$index]["Content"] = $res->fields[3];
            $index++;
          //  print_r($friendlist);
        }
       // print_r($friendlist);
        return $friendlist;
    }
    //得到所有的好友
    function get_friends_all($loginname){
		global $userdb;
		$query = "select  friendInfo.ID, friendInfo.Name, friendInfo.UserName, friendInfo.AvatarUrl, presence.Content from friendInfo,presence where FriendName = '".$loginname."' and friendInfo.UserName = presence.UserName and presence.Type = 'signature' order by ID;";
		$res = $userdb->Execute($query);
      //  print_r($query);
		$number = 1;
        $index = 0;
		while(!$res->EOF){
            $friendlist[$index]["ID"] = $res->fields[0];
            $friendlist[$index]["Name"] = $res->fields[1];
	//		$friendlist[$index]["Name"] = iconv("GB2312","UTF-8",$res->fields[1]);
			$friendlist[$index]["UserName"] = $res->fields[2];
            $friendlist[$index]["AvatarUrl"] = $res->fields[3];
			$friendlist[$index]["Signature"] = $res->fields[4];
		//	$friendlist[$index]["Signature"] = iconv("GB2312","UTF-8",$res->fields[4]);
			$friendlist[$index]["num"] = $number;
            $index++;
            $number++;
            $res->MoveNext();
        }
        //print_r($friendlist);
        return $friendlist;
    }
    //插入聊天记录并且向payload填写
    function insert_record($table, $sender, $receiver, $createtime,$content, $isread){
		global $userdb;
        $senderpayload = $sender;
        $query = "select UserName from friendInfo where Name = '".$receiver."';"; 
        $res = $userdb->Execute($query);
        $receiverusername = $res->fields[0];
        $contentrecord = pack("CS",1,strlen($content)+1).$content;
       // $contentrecord = pack("CS",1,strlen($content)+1);
        //print_r(unpack("Cmap/Slen",substr($contentrecord,0,3)));
        $time = date('Y-m-d H:i:s',$createtime);
       // print_r(floor($createtime));
		$query = "insert into ".$table."(Sender,Receiver,SendTime,Content,isRead,Status) values('".$sender."','".$receiverusername."','".$time."','".$contentrecord."',".$isread." , 'in');";
		$res = $userdb->Execute($query);
       // print_r(time());
        $binarydata = pack("LCCCS", floor($createtime),0,0x50,1,strlen($content)+1);
       // print_r(strlen($binarydata));
        $tab = "\0";
        while(strlen($sender) < 64){
            $sender=$sender.$tab;
        }
        $payload = $sender.$binarydata.$content;
       // print_r(substr($payload,0,64));
       // print_r(substr($payload,73));
       // print_r(unpack("Ltime/Stype/Cmap/Slen", $binarydata));
        $length = strlen($payload)+1;
		$query = "insert into payloadSent(UserName,Type,Topic,QOS,pubContent,Length) values('".$senderpayload."','pub', '/".$receiverusername."/chat','1', '".$payload."','".$length."');";
		$res = $userdb->Execute($query);

    }
    //得到聊天记录
    function get_record($table, $sender, $receiver){
        global $userdb;
        $query = "select Name from friendInfo where UserName = '".$sender."';"; 
        $res = $userdb->Execute($query);
        $loginname = $res->fields[0];
       // print_r($query);
       // print_r($sendername);
        $query = "select UserName from friendInfo where Name = '".$receiver."';"; 
        $res = $userdb->Execute($query);
        $receivername = $res->fields[0];
        //print_r($query);
        //print_r($res->fields[0]);
        $query = "select * from ".$table." where Receiver ='".$receivername."' and Sender = '".$sender."' and Status = 'in' or Receiver= '".$sender." ' and Sender = '".$receivername."' and Status = 'out';"; 
        $res = $userdb->Execute($query);
		$index = 0;
		$number = 1;
      //  print_r($query);
		while(!$res->EOF){
			$list[$index]["ID"] = $res->fields[0];
            if(strcmp($res->fields[1], $sender)==0){
			    $list[$index]["Sender"] = $loginname;
			    $list[$index]["Receiver"] = $receiver;
            }else{
			    $list[$index]["Sender"] = $receiver;
			    $list[$index]["Receiver"] = $loginname;
            }
			$list[$index]["CreateTime"] = $res->fields[7];
        //print_r(unpack("Cmap/Slen",substr($contentrecord,0,3)));
            $list[$index]["Context"] = (substr($res->fields[4],3));
			$list[$index]["isRead"] = $res->fields[5];
			$list[$index]["num"] = $number;
            $index++;
            $number++;
          //  print_r($list[$index-1]["Context"]);
            $res->MoveNext();
        }
     //   print_r($list);
        return $list;
    }
    //得到时时聊天信息
    function get_chatinfo($table, $sender, $receiver){
        global $userdb;
      //  $send = iconv("UTF-8","GB2312",$sender);
        $query = "select UserName from friendInfo where Name = '".$sender."';"; 
        $res = $userdb->Execute($query);
        $sendername = $res->fields[0];
        $query = "select * from ".$table." where Receiver = '".$receiver."' and Sender = '".$sendername."' and isRead = 0;"; 
        $res = $userdb->Execute($query);
		$index = 0;
		$number = 1;
      //  print_r($query);
		while(!$res->EOF){
			$list[$index]["ID"] = $res->fields[0];
			$list[$index]["Sender"] = $sender;
			$list[$index]["Receiver"] = $receiver;
			$list[$index]["CreateTime"] = $res->fields[3];
           // $list[$index]["Context"] = $res->fields[4];
            $list[$index]["Context"] = (substr($res->fields[4],3));
			$list[$index]["isRead"] = $res->fields[5];
			$list[$index]["num"] = $number;
            $query_update = "update ".$table." set isRead = 1 where ID = ".$res->fields[0].";";
            $res_update = $userdb->Execute($query_update);
            $index++;
            $number++;
            //print_r($list[0]["Context"]);
            $res->MoveNext();
        }
        return $list;
    }
    //得到所有好友的聊天情况
    function get_allchatinfo($loginusername){
        global $userdb;
        $query = "select friendInfo.Name, friendInfo.UserName from IMs, friendInfo where IMs.Receiver = '".$loginusername."' and friendInfo.FriendName = IMs.receiver  and IMs.Sender = friendInfo.UserName and IMs.isRead = 0;"; 
        $res = $userdb->Execute($query);
        $index = 0;
       // print_r($query);
        while(!$res->EOF){
            $list[$index]["SenderName"] = $res->fields[0];
            $list[$index]["SenderUserName"] = $res->fields[1];
            $index++;
            $res->MoveNext();
        }
        return $list;
    }
    //得到好友的签名和头像信息
    function get_signature($table, $username){
        global $userdb;
        $query = "select Content from ".$table." where UserName ='".$username."' and Type = 'signature';"; 
        $res = $userdb->Execute($query);
		$index = 0;
		$number = 1;
        //print_r($query);
		while(!$res->EOF){
			$signature[$index]["Signature"] = $res->fields[0];
            $index++;
            $number++;
            $res->MoveNext();
        }
        return $signature;
    }
    //得到新事件
    function get_event($username){
        global $userdb;
        $query = "select ID,TableName, Content from newEvent where UserName = '".$username."' and isRead = 0;"; 
        $res = $userdb->Execute($query);
		$index = 0;
       // print_r($query);
		while(!$res->EOF){
			$list[$index]["ID"] = $res->fields[0];
			$list[$index]["Table"] = $res->fields[1];
			$list[$index]["Content"] = $res->fields[2];
            if(strcmp($res->fields[1],"IMs")){
                $query_update = "update newEvent set isRead = 1 where ID = ".$res->fields[0].";"; 
                $res_update = $userdb->Execute($query_update);
            }
            $index++;
            $res->MoveNext();
        }
        //print_r($list);
        return $list;
    }
    //对好友增加与删除 做出处理表中content代表新增或删除好友
    function friend_change($username){
        global $userdb;
        $query = "select ID, Type, Content from friendChange where UserName ='".$username."';"; 
        $res = $userdb->Execute($query);
       // print_r($query);
		while(!$res->EOF){
			$ID = $res->fields[0];
			$Type = $res->fields[1];
			$Content = $res->fields[2];
            if($Type =="new"){
                $query_insert = "insert into presence(UserName,Type,Content) values('".$Content."','status','up');"; 
                $res_insert = $userdb->Execute($query_insert);
             //   print_r($query_insert);
            }
            if($Type =="delete"){
                $query_delete = "delete from presence where UserName = '".$Content."';"; 
                $res_delete = $userdb->Execute($query_delete);
              //  print_r($query_delete);
            } 
            $query_delete = "delete from friendChange where ID = ".$ID.";"; 
            $res_delete = $userdb->Execute($query_delete);
            $res->MoveNext();
        }
        //return $list;
    }
	function sselect_admin($table){
		global $userdb;
		$query="select Name,Password,No,memo from ".$table." order by No;";
		$res=$userdb->Execute($query);
		$index=0;
		$i=1;
		while(!$res->EOF){
			$findmeinfo[$index]["Name"]=$res->fields[0];
			$findmeinfo[$index]["Password"]=$res->fields[1];
			$findmeinfo[$index]["no"]=$res->fields[2];
                print_r($query_insert);
            }
            if($type =="delete"){
                $query_delete = "delete from presence where UserName = '".$Content."');"; 
                $res_delete = $userdb->Execute($query_delete);
            } 
            $res->MoveNext();
        //return $list;
    }
	function select_admin($table){
		global $userdb;
		$query="select Name,Password,No,memo from ".$table." order by No;";
		$res=$userdb->Execute($query);
		$index=0;
		$i=1;
		while(!$res->EOF){
			$findmeinfo[$index]["Name"]=$res->fields[0];
			$findmeinfo[$index]["Password"]=$res->fields[1];
			$findmeinfo[$index]["no"]=$res->fields[2];
			$findmeinfo[$index]["memo"]=$res->fields[3];
			$findmeinfo[$index]["num"]=$i;
			if(strlen($findmeinfo[$index]["memo"])>8){
				$findmeinfo[$index]["memo_short"]=substr($findmeinfo[$index]["memo"],0,8)."...";
			}else{
				$findmeinfo[$index]["memo_short"]=$findmeinfo[$index]["memo"];
			}
			$index++;
			$i++;
			$res->MoveNext();
		}
		//$res->close();
		return $findmeinfo;
	}
	function select_admin_page($table,$page,$page_size){
		global $userdb;
		$startnum=($page-1)*$page_size;
		$query="select Name,Password,No,memo from ".$table." order by No limit ".$startnum.",".$page_size.";";
		$res=$userdb->Execute($query);
		$index=0;
		$i=($page-1)*$page_size+1;
		while(!$res->EOF){
			$findmeinfo[$index]["Name"]=$res->fields[0];
			$findmeinfo[$index]["Password"]=$res->fields[1];
			$findmeinfo[$index]["no"]=$res->fields[2];
			$findmeinfo[$index]["memo"]=$res->fields[3];
			$findmeinfo[$index]["num"]=$i;
			if(strlen($findmeinfo[$index]["memo"])>8){
				$findmeinfo[$index]["memo_short"]=substr($findmeinfo[$index]["memo"],0,8)."...";
			}else{
				$findmeinfo[$index]["memo_short"]=$findmeinfo[$index]["memo"];
			}
			$index++;
			$i++;
			$res->MoveNext();
		}
		return $findmeinfo;
	}
	function insert_admin($table,$infoList){
		global $userdb;
		$insert="insert into ".$table."(Name,Password,memo) values('".$infoList["Name"]."','".$infoList["Password"]."','".$infoList["memo"]."');";
		$res=$userdb->Execute($insert);
		//$res->close();
	}
	function selchk_admin($table,$chknum){
		global $userdb;
		$query="select Name,Password,memo from ".$table." where No='".$chknum."';";
		$res=$userdb->Execute($query);
		if(!$res->EOF){
			$findmeinfo["Name"]=$res->fields[0];
			$findmeinfo["Password"]=$res->fields[1];
			$findmeinfo["memo"]=$res->fields[2];
			$findmeinfo["no"]=$chknum;			
		}
		//$res->close();
		return $findmeinfo;
	}
	function update_admin($table,$infoList){
		global $userdb;
		$chknum=$infoList["chknum"];
		$update="update ".$table." set Name='".$infoList["Name"]."',Password='".$infoList["Password"]."',memo='".$infoList["memo"]."' where No='".$chknum."'";
		$res=$userdb->Execute($update);
		//$res->close();
	}
	function delRecord($table,$query_c="1"){
    	global $userdb;
    	$query="delete from ".$table." where ".$query_c;
    	$result=$userdb->Execute($query);
    	//$result->close();
    	return $result?true:false;
    } 
	function exist_Record($table,$query_c="1"){
    	global $userdb;
    	$query="select * from ".$table." where ".$query_c;
    	$result=$userdb->Execute($query);
		$exist_str="";
		if(!$result->EOF){
			$exist_str="exist";
		}else{
			$exist_str="";
		}
    	//$result->close();
    	return $exist_str;
    } 
}
?>
