<?php 
require(SIPSYS_DIR."function.php");
class weiboinfo{
	var $db='';
	var $language;
	function weiboinfo(){
		$this->table_weibo='weibo';
		 
//         initEmotionsWeixin();
        
//         initEmotions();
	}

//��ʼ��ͼƬ��Դ��
/*function initEmotions(){
    global $emotions ;
    $filename = "http://42.121.125.50/face_resource/emotions.json";

    $json = json_decode(file_get_contents($filename));//��json�ṹ��$content��json_decode()�������Ϊ����,���ӵڶ������Ϊtrue�������Ϊ����

    foreach($json as $single){
        $phrase = iconv("utf-8","gb2312",$single->phrase);//��ת������ʾʱ����
        $emotions[$phrase]=$phrase;
        file_put_contents("/home/zsc.txt","\nyuyuy:".$emotions[$phrase],FILE_APPEND);
    }
}*/

	function getTotalNums($table, $query_c="1"){
      	global $userdb;
      	$numbers = 0;
    	$sql = "select count(*) from ".$table." where ".$query_c;
    	$recordSet = &$userdb->Execute($sql);
		if(!$recordSet->EOF){
    		$numbers = $recordSet->fields[0];
        }
    	//$recordSet->close();
        return $numbers;
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


    function getPageCounts($rowNums, $pageSize){
    	//$num_rows=$this->getTotalnums($table,$query_c);
    	// �����ܹ��ж���ҳ
    	$page_count_array=array();
        if($rowNums){
            if($rowNums < $pageSize){                                   //��������С��$PageSize����ôֻ��һҳ
                    $pageCounts = 1;
            }
            if($rowNums % $pageSize ){                                  //ȡ���������ÿҳ�������
               $pageCounts = (int)($rowNums / $pageSize) + 1;           //�����������ҳ��������������ÿҳ��Ľ��ȡ���ټ�һ
            }else{
               $pageCounts = $rowNums / $pageSize;                      //���û��������ҳ��������������ÿҳ��Ľ��
            }
        }else{
            $pageCounts = 0;
        }
        return $pageCounts;
    }

	function getJumpPageCount($pageCounts){
    	//$page_count=$this->getPageCounts($table,$page_size,$query_c);
        for ($i = 1; $i <=$pageCounts; $i++){
           $pageCountArray[$i-1] = $i;
        }
    	return $pageCountArray;    	
    }

	function getPageUrlString($page,$tail, $opcontent, $query_c="1"){
		global $constant;
		//$page_count=$this->getPageCounts($num_rows,$page_size);

       // $page_count_array=$this->getJumpPageCount($page_count);
		// ��ҳt��
		//$page_string = $constant["pubpage"]["Total"].$num_rows.$constant["pubpage"]["records"]."&nbsp;&nbsp;&nbsp;&nbsp;";
		if( $page < 4 ){
                $page_string .= $constant["pubpage"]["HomePage"].'|'.$constant["pubpage"]["Previous"].'|';
		}else{
                $page_string.= '<a href=admin.php?'.$opcontent.'&action=init&page=1>'.$constant["pubpage"]["HomePage"].'</a>|<a style="cursor:pointer;"onclick="javascript:history.back(-1);">'.$constant["pubpage"]["Previous"].'</a>|';
        }
		if($tail){
                $page_string .= $constant["pubpage"]["Next"];
        }else{
                $page_string .= '<a href=admin.php?'.$opcontent.'&page='.($page+1).'>'.$constant["pubpage"]["Next"].'</a>';
		}
        return $page_string;
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
    //only homepage,previous,next
	function getPageUrlString_v3($page, $tail, $opcontent, $query_c="1"){
		global $constant;
		//$page_count=$this->getPageCounts($num_rows,$page_size);
        //$page_count_array=$this->getJumpPageCount($page_count);
		// ��ҳt��
		//$page_string = $constant["pubpage"]["Total"].$num_rows.$constant["pubpage"]["records"]."&nbsp;&nbsp;&nbsp;&nbsp;";
		if($page == 1){
                $page_string .= $constant["pubpage"]["HomePage"].'|'.$constant["pubpage"]["Previous"].'|';
		}else{
                $page_string.= '<a href=admin.php?'.$opcontent.'&action=init&page=1>'.$constant["pubpage"]["HomePage"].'</a>|<a href=admin.php?'.$opcontent.'&action=back&page='.($page-1).'>'.$constant["pubpage"]["Previous"].'</a>|';
        }
        if($tail){
                $page_string .= $constant["pubpage"]["Next"];
        }else{
                $page_string .= '<a href=admin.php?'.$opcontent.'&action=more&page='.($page+1).'>'.$constant["pubpage"]["Next"].'</a>';
        }
        return $page_string;
    }

	function get_weibo($table, $sender, $time, $isTag, $isRead, $mediaType, $type){
		global $userdb;
		$query = "select * from ".$table." order by ID;";
		$res = $userdb->Execute($query);
		$index = 0;
		$number = 1;
		while(!$res->EOF){
			$weiboInfo[$index]["ID"]       =$res->fields[0];
			$weiboInfo[$index]["Sender"]   =$res->fields[1];
			$weiboInfo[$index]["Username"] =$res->fields[2];
			$weiboInfo[$index]["Time"]     =$res->fields[3];
			$weiboInfo[$index]["Content"]  =$res->fields[4];
			$weiboInfo[$index]["Audio"]    =$res->fields[5];
			$weiboInfo[$index]["AudioLen"] =$res->fields[6];
			$weiboInfo[$index]["Pic"]      =$res->fields[7];
			$weiboInfo[$index]["IsTag"]    =$res->fields[8];
			$weiboInfo[$index]["IsRead"]   =$res->fields[9];
			$weiboInfo[$index]["MediaType"]=$res->fields[10];
			$weiboInfo[$index]["Type"]     =$res->fields[11];
			$weiboInfo[$index]["num"]      =$number;
			$index++;
			$number++;
			$res->MoveNext();
		}
		//$res->close();
		return $weiboInfo;
	}
	function getOnePage($table, $page, $pageSize,$query_c){
		global $userdb;
		$startNum = ($page-1)*$pageSize;
		$query = "select ID,Sender,Username,AvatarUrl,Time,Content,Audio,AudioLen,Pic,ReplyCount,CommentCount,IsTag,IsRead,MediaType,Type from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
		$res=$userdb->Execute($query);
		$index = 0;
		$number = ($page-1)*$pageSize + 1;
		while(!$res->EOF){
                	$weiboInfo[$index]["ID"]          =$res->fields[0];
                	//$weiboInfo[$index]["Sender"]      =$res->fields[1];
                	//$weiboInfo[$index]["Sender"]      =iconv("UTF-8","GB2312",$res->fields[1]);
                	$weiboInfo[$index]["Sender"]      =$res->fields[1];
                	$weiboInfo[$index]["Username"]    =$res->fields[2];
                	$weiboInfo[$index]["AvatarUrl"]   =$res->fields[3];
                	//$weiboInfo[$index]["Time"]        =iconv("UTF-8","GB2312",tranTime($res->fields[3]));
                	$weiboInfo[$index]["Time"]        =tranTime($res->fields[4]);
                	//$weiboInfo[$index]["Content"]     =$res->fields[4];
                	//$weiboInfo[$index]["Content"]     =iconv("UTF-8","GB2312",$res->fields[4]);
                	$weiboInfo[$index]["Content"]     =$res->fields[5];
	                $weiboInfo[$index]["Audio"]       =$res->fields[6];
        	        $weiboInfo[$index]["AudioLen"]    =$res->fields[7];
               		$weiboInfo[$index]["Pic"]         =$res->fields[8];
            		$weiboInfo[$index]["ReplyCount"]  =$res->fields[9];
                	$weiboInfo[$index]["CommentCount"]=$res->fields[10];
                	$weiboInfo[$index]["IsTag"]       =$res->fields[11];
                	$weiboInfo[$index]["IsRead"]      =$res->fields[12];
                	$weiboInfo[$index]["MediaType"]   =$res->fields[13];
                	$weiboInfo[$index]["Type"]        =$res->fields[14];
                	$weiboInfo[$index]["num"]         =$number;

			$index++;
			$number++;
			$res->MoveNext();
		}
		return $weiboInfo;
	}
	function getWeixinReadID($table, $page, $pageSize, $query_c){
		global $userdb;
            	$startNum = ($page-1)*$pageSize;
             
	    	    $sql = "select msg_id from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
            	$res = $userdb->Execute($sql);
            	$index = 0;
            	$number = ($page-1)*$pageSize + 1;
            	while(!$res->EOF){
                    	$markID[$index]["ID"]  = $res->fields[0];
                    	$markID[$index]["num"] = $number;
                    	$index++;
                    	$number++;
                    	$res->MoveNext();
            	}
            	return $markID;
    	}
	function getWeixinMarkID($table,$page,$pageSize,$query_c){
		global $userdb;
            	$startNum = ($page-1)*$pageSize;
            	//$sql = "select ID from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
             
	    	$sql = "select msg_id from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
            	$res = $userdb->Execute($sql);
            	$index = 0;
            	$number = ($page-1)*$pageSize + 1;
            	while(!$res->EOF){
                    	$markID[$index]["ID"]  = $res->fields[0];
                    	$markID[$index]["num"] = $number;
                    	$index++;
                    	$number++;
                    	$res->MoveNext();
            	}
            	return $markID;
    }
	function getMarkID($table,$page,$pageSize,$query_c){
		global $userdb;
            	$startNum = ($page-1)*$pageSize;
            	//$sql = "select ID from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
             
	    	    $sql = "select weiboID from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
            	$res = $userdb->Execute($sql);
            	$index = 0;
            	$number = ($page-1)*$pageSize + 1;
            	while(!$res->EOF){
                    	$markID[$index]["ID"]  = $res->fields[0];
                    	$markID[$index]["num"] = $number;
                    	$index++;
                    	$number++;
                    	$res->MoveNext();
            	}
            	return $markID;
    	}
	/* Add by languoliang, @2013.03.14 */
	function getMarkedWeibo($table, $page, $pageSize, $weiboIDs){
		global $userdb;
		$index = 0;
		//$number = ($page-1)*$pageSize + 1;
		$number = 0;
		foreach((array)$weiboIDs as $id){
			$query = "select ID,Sender,Username,AvatarUrl,Time,Content,Audio,AudioLen,Pic,ReplyCount,CommentCount,IsTag,IsRead,MediaType,Type from ".$table." where ID='".$id['ID']."';";
			$res=$userdb->Execute($query);
			while(!$res->EOF){
                		$weiboInfo[$index]["ID"]          =$res->fields[0];
                		//$weiboInfo[$index]["Sender"]      =$res->fields[1];
                		//$weiboInfo[$index]["Sender"]      =iconv("UTF-8","GB2312",$res->fields[1]);
                		$weiboInfo[$index]["Sender"]      =$res->fields[1];
                		$weiboInfo[$index]["Username"]      =$res->fields[2];
                		$weiboInfo[$index]["AvatarUrl"]   =$res->fields[3];
                		//$weiboInfo[$index]["Time"]        =iconv("UTF-8","GB2312",tranTime($res->fields[3]));
                		$weiboInfo[$index]["Time"]        =tranTime($res->fields[4]);
                		//$weiboInfo[$index]["Content"]     =$res->fields[4];
                		//$weiboInfo[$index]["Content"]     =iconv("UTF-8","GB2312",$res->fields[4]);
                		$weiboInfo[$index]["Content"]     =$res->fields[5];
	                	$weiboInfo[$index]["Audio"]       =$res->fields[6];
        	        	$weiboInfo[$index]["AudioLen"]    =$res->fields[7];
               			//$weiboInfo[$index]["Pic"]         =$res->fields[8];
                        if(strpos($res->fields[8],"image")){
                            $weiboInfo[$index]["Pic"]         = str_replace(".jpg","small.jpg",$res->fields[8]);
                            $weiboInfo[$index]["PicLarge"]         = str_replace(".jpg","medium.jpg",$res->fields[8]);
                        }
                        if(strpos($res->fields[8],"thumbnail")){
                            $weiboInfo[$index]["Pic"]         = $res->fields[8];
                            $weiboInfo[$index]["PicLarge"]         = str_replace("thumbnail","bmiddle",$res->fields[8]);
                        }
            			$weiboInfo[$index]["ReplyCount"]  =$res->fields[9];
                		$weiboInfo[$index]["CommentCount"]=$res->fields[10];
                		$weiboInfo[$index]["IsTag"]       =$res->fields[11];
                		$weiboInfo[$index]["IsRead"]      =$res->fields[12];
                		$weiboInfo[$index]["MediaType"]   =$res->fields[13];
                		$weiboInfo[$index]["Type"]        =$res->fields[14];
                		$weiboInfo[$index]["num"]         =$number;

				$index++;
				$number++;
				$res->MoveNext();
			}
		}
		return $weiboInfo;
	}
	function getReadID($table, $page, $pageSize, $query_c){
		global $userdb;
            	$startNum = ($page-1)*$pageSize;
             
	    	    $sql = "select weiboID from ".$table." where ".$query_c." order by ID DESC limit ".$startNum.",".$pageSize.";";
            	$res = $userdb->Execute($sql);
            	$index = 0;
            	$number = ($page-1)*$pageSize + 1;
            	while(!$res->EOF){
                    	$markID[$index]["ID"]  = $res->fields[0];
                    	$markID[$index]["num"] = $number;
                    	$index++;
                    	$number++;
                    	$res->MoveNext();
            	}
            	return $markID;
    	}
	/* Add by languoliang, @2013.03.15 */
	function getReadedWeibo($table, $page, $pageSize, $weiboIDs){
		global $userdb;
		$index = 0;
		$number = ($page-1)*$pageSize + 1;
		//$number = 0;
		foreach((array)$weiboIDs as $id){
			$query = "select ID,Sender,Username, AvatarUrl,Time,Content,Audio,AudioLen,Pic,ReplyCount,CommentCount,IsTag,IsRead,MediaType,Type from ".$table." where ID='".$id['ID']."';";
			$res=$userdb->Execute($query);
			while(!$res->EOF){
                		$weiboInfo[$index]["ID"]          =$res->fields[0];
                		//$weiboInfo[$index]["Sender"]      =$res->fields[1];
                		//$weiboInfo[$index]["Sender"]      =iconv("UTF-8","GB2312",$res->fields[1]);
                		$weiboInfo[$index]["Sender"]      =$res->fields[1];
                		$weiboInfo[$index]["Username"]      =$res->fields[2];
                		$weiboInfo[$index]["AvatarUrl"]   =$res->fields[3];
                		//$weiboInfo[$index]["Time"]        =iconv("UTF-8","GB2312",tranTime($res->fields[3]));
                		$weiboInfo[$index]["Time"]        =tranTime($res->fields[4]);
                		//$weiboInfo[$index]["Content"]     =$res->fields[4];
                		//$weiboInfo[$index]["Content"]     =iconv("UTF-8","GB2312",$res->fields[4]);
                		$weiboInfo[$index]["Content"]     =$res->fields[5];
	                	$weiboInfo[$index]["Audio"]       =$res->fields[6];
        	        	$weiboInfo[$index]["AudioLen"]    =$res->fields[7];
               		//	$weiboInfo[$index]["Pic"]         =$res->fields[8];
                        if(strpos($res->fields[8],"image")){
                            $weiboInfo[$index]["Pic"]         = str_replace(".jpg","small.jpg",$res->fields[8]);
                            $weiboInfo[$index]["PicLarge"]         = str_replace(".jpg","medium.jpg",$res->fields[8]);
                        }
                        if(strpos($res->fields[8],"thumbnail")){
                            $weiboInfo[$index]["Pic"]         = $res->fields[8];
                            $weiboInfo[$index]["PicLarge"]         = str_replace("thumbnail","bmiddle",$res->fields[8]);
                        }
            			$weiboInfo[$index]["ReplyCount"]  =$res->fields[9];
                		$weiboInfo[$index]["CommentCount"]=$res->fields[10];
                		$weiboInfo[$index]["IsTag"]       =$res->fields[11];
                		$weiboInfo[$index]["IsRead"]      =$res->fields[12];
                		$weiboInfo[$index]["MediaType"]   =$res->fields[13];
                		$weiboInfo[$index]["Type"]        =$res->fields[14];
                		$weiboInfo[$index]["num"]         =$number;

				$index++;
				$number++;
				$res->MoveNext();
			}
		}
		return $weiboInfo;
	}
    /************************�жϺ��ѻ��߷�˿����ҳ����һҳ******************/
    function elggPage($page){
        switch($page){
            case 1: $backLink = "admin.php?op=baseinfomgr_myWeiboList";
                    break;
            case 2: $backLink = "admin.php?op=baseinfomgr_atList";
                    break;
            case 3: $backLink = "admin.php?op=baseinfomgr_markWeiboList";
                    break;
            case 4: $backLink = "admin.php?op=baseinfomgr_readWeiboList";
                    break;
           // case 5: $backLink = "admin.php?op=baseinfomgr_ownerWeiboList";
                    break;
            case 6: $backLink = "admin.php?op=baseinfomgr_simpleMyWeiboList";
                    break;
            case 7: $backLink = "admin.php?op=baseinfomgr_simpleAtList";
                    break;
            case 8: $backLink = "admin.php?op=baseinfomgr_simpleMarkWeiboList";
                    break;
            case 9: $backLink = "admin.php?op=baseinfomgr_simpleReadWeiboList";
                    break;
            //case 10: $backLink = "admin.php?op=baseinfomgr_simpleOwnerWeiboList";
                    break;
            case 11: $backLink = "admin.php?op=baseinfomgr_columnWeibo";
                    break;
            case 12: $backLink = "admin.php?op=baseinfomgr_simpleColumnWeibo";
                    break;
            case 13: $backLink = "admin.php?op=baseinfomgr_atHosterWeiboList";
                    break;
            case 14: $backLink = "admin.php?op=baseinfomgr_simpleAtHosterWeiboList";
                    break;
            case 15: $backLink = "admin.php?op=baseinfomgr_hotWeibo";
                    break;
            case 16: $backLink = "admin.php?op=baseinfomgr_hotTopic";
                    break;
            case 'hc': $backLink = "admin.php?op=baseinfomgr_hotColumn";
                    break;
            default:break;      
        }
        return $backLink;
    }
    function sinaPage($page){
        switch($page){
            case 1: $backLink = "admin.php?op=baseinfomgr_sinaWeiboList";
                    break;
            case 2: $backLink = "admin.php?op=baseinfomgr_sinaAtList";
                    break;
            case 3: $backLink = "admin.php?op=baseinfomgr_sinaFavoriteList";
                    break;
            case 4: $backLink = "admin.php?op=baseinfomgr_sinaOwnerList";
                    break;
            case 5: $backLink = "admin.php?op=baseinfomgr_simpleSinaWeiboList";
                    break;
            case 6: $backLink = "admin.php?op=baseinfomgr_simpleSinaAtList";
                    break;
            case 7: $backLink = "admin.php?op=baseinfomgr_simpleSinaFavoriteList";
                    break;
            case 8: $backLink = "admin.php?op=baseinfomgr_simpleSinaOwnerList";
                    break;
            default:break;
        
        }
        return $backLink;
    }
    /*****************��ȡѡ����ɫֵ**********************/
    function optionColor($id){
        $color = "";
        switch($id){
            case 0:  
                $color = '#fec994';
                break;
            case 1:  
                $color = '#c0e878';
                break;
            case 2:  
                $color = '#6c82b3';
                break;
            case 3:  
                $color = '#a2ced5';
                break;
            case 4:  
                $color = '#f176d5';
                break;
            case 5:  
                $color = '#f78ba0';
                break;
            case 6:  
                $color = '#ffbe49';
                break;
            case 7:  
                $color = '#8db5fe';
                break;
            case 8:  
                $color = '#fa9558';
                break;
            case 9:  
                $color = '#9ca0fd';
                break;
            case 10:  
                $color = '#e39cfd';
                break;
            case 11:  
                $color = '#9efb9c';
                break;
            case 12:  
                $color = '#f9e7a1';
                break;
            case 13:  
                $color = '#aceffd';
                break;
            case 14:  
                $color = '#fdcaac';
                break;
            default :
                $color = 'red';
                break;

        }
        return $color;
    }
    /**********************utf8�ַ��ȡ***********************/
    function utfSubstr($str,$len)
    {   
        if(strlen($str) <= $len ){
            return $str;
        }
        else{
            for($i=0;$i<$len;$i++)
            {
                    $temp_str=substr($str,0,1);
                    if(ord($temp_str) > 127)
                    {
                            $i+=2;
                            if($i<$len)
                            {
                                    $new_str[]=substr($str,0,3);
                                    $str=substr($str,3);
                            }
                    }
                    else
                    {
                            $new_str[]=substr($str,0,1);
                            $str=substr($str,1);
                    }
            }
            $result = join($new_str);
            return $result."...";
        }
    }
    
	function transWeixinData($wireList,$compere,$time = 0 ){
        global $userdb;
		$index = 0;
        if($time == 1){
            $number = 15;
        }else if($time == 2){
            $number = 30;
        }else{
            $number = 0;
        }
		foreach($wireList as $single){
                $time_a = time() - $single['time'];
                if($time_a >= 86400){
                    $weiboInfo[$index]["Reply"] = 0;
                }else{
                    $weiboInfo[$index]["Reply"] = 1;
                }
                $weiboInfo[$index]["ID"] = $single['msg_id'];
                $weiboInfo[$index]["iid"] = $single['id'];
                $weiboInfo[$index]["Sender"] = $single['owner_name'];
                $weiboInfo[$index]["SenderKey"] = $single['owner_key'];
                //$weiboInfo[$index]["AvatarUrl"]   = "http://42.121.34.216/elgg/mod/profile/icondirect.php?lastcache=1378794249&joindate=1354697202&guid=2067&size=medium";
                $weiboInfo[$index]["AvatarUrl"]   =$single['avatar_url'];
                $weiboInfo[$index]["MsgId"] = $single['msg_id'];
                $weiboInfo[$index]["Time"] = tranTime($single['time']);
                $weiboInfo[$index]["timeTime"] = date("H:i",$single['time']);
                $weiboInfo[$index]["DayTime"] = date("Y.m.d",$single['time']);
                if($single['ocontent']){
                    $weiboInfo[$index]["OContent"] = $single['ocontent'];
                }
                if($single['type'] == 'text'){
                    $str=replaceEmotionsWeixin($single['mcontent']);
                    $weiboInfo[$index]["Content"] = $str;
                 //  $weiboInfo[$index]["Content"] = $single['mcontent'];
                }else if($single['type'] == 'voice'){
                    $weiboInfo[$index]["Audio"]       = $single['mcontent'];
                    $time_len = $single['time_length'];
                    $time_array = explode(":",$time_len);
                    $time_len = $time_array[0]*3600+$time_array[1]*60+$time_array[2]+0.5;
                    $audioLen = floor($time_len);
                    if($audioLen == 0 ){
                        $weiboInfo[$index]["AudioLen"] = $audioLen + 1;  
                    }else{
                        $weiboInfo[$index]["AudioLen"] = $audioLen;  
                    }
                }else if($single['type'] == 'image'){
                    $weiboInfo[$index]["Pic"] = $single['mcontent'];
                }
                $weiboInfo[$index]["IsTag"] = 0;
                $weiboInfo[$index]["IsRead"] = 0;
	    	    $sql = "select id from tagweixin where msg_id = ".$single['msg_id']." and username = '$compere';";
            	$res = $userdb->Execute($sql);
                if(!$res->EOF){
                    //file_put_contents("/home/zsc.txt","$sql\n", FILE_APPEND);
                    $weiboInfo[$index]["IsTag"] = 1;
                }
	    	    $sql = "select id from replayweixin where msg_id = ".$single['msg_id'];
                //file_put_contents("/home/zsc.txt","$sql\n", FILE_APPEND);
            	$res = $userdb->Execute($sql);
                if(!$res->EOF){
                    $weiboInfo[$index]["IsReply"] = 1;
                }
	    	    $sql = "select id from readweixin where msg_id = ".$single['msg_id']." and username = '$compere';";
            	$res = $userdb->Execute($sql);
                if(!$res->EOF){
                    $weiboInfo[$index]["IsRead"] = 1;
                }
                $weiboInfo[$index]["num"] = $number;

			    $index++;
			    $number++;
		}
		return $weiboInfo;
	}

	/* transfer Elgg weibo data to uniform array */
/*	function transElggData($wireList,$compere,$time = 0 ){
       // file_put_contents("/home/zsc.txt", $compere."ssss\n",FILE_APPEND);
        global $userdb;
		$index = 0;
        if($time == 1){
            $number = 15;
        }else if($time == 2){
            $number = 30;
        }else{
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
                $str = $this->thewire_filter($single['description']);
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
                if($single['topstatus'])
                    $weiboInfo[$index]["TopStatus"] = $single['topstatus'];
                $weiboInfo[$index]["ReplyCount"]  = $single['replycount'];
                $weiboInfo[$index]["notice"]  = $single['parent']['notice'];
                $weiboInfo[$index]["retweetedUsername"]  = $single['parent']['owner']['name'];
                $count = strpos($single['parent']['description'],":");
                $str = $this->thewire_filter(substr($single['parent']['description'],$count+1));
                $weiboInfo[$index]["retweetedContentLong"] = substr($single['parent']['description'],$count+1);
                $weiboInfo[$index]["retweetedContentLong"]   = str_replace('"','>!<',$weiboInfo[$index]["retweetedContentLong"]);
                $weiboInfo[$index]["retweetedContentLong"]   = str_replace('\'',">?<",$weiboInfo[$index]["retweetedContentLong"]);
                $weiboInfo[$index]["retweetedContentLong"] = preg_replace("/\s+/", " ", $weiboInfo[$index]["retweetedContentLong"]);
                $weiboInfo[$index]["retweetedContent"]   = $str;
                $weiboInfo[$index]["retweetedAudio"]       = $single['parent']['audio'];
                //$weiboInfo[$index]["retweetedAudioLen"]    = floor($single['parent']['audiolen']/1000 +1);
                $audioParentLen = floor($single['parent']['audiolen']/1000);
                if($audioParentLen == 0 ){
                    $weiboInfo[$index]["retweetedAudioLen"] = $audioPatentLen + 1;  
                }else{
                    $weiboInfo[$index]["retweetedAudioLen"] = $audioParentLen;  
                }
                $weiboInfo[$index]["IsTag"] = 0;
                $weiboInfo[$index]["IsRead"] = 0;
	    	    $sql = "select ID from tagweibo where weiboID = ".$single['guid']." and username = '$compere';";
            	$res = $userdb->Execute($sql);
                if(!$res->EOF){
                    $weiboInfo[$index]["IsTag"] = 1;
                }
	    	    $sql = "select ID from tagread where weiboID = ".$single['guid']." and username = '$compere';";
            	$res = $userdb->Execute($sql);
                if(!$res->EOF){
                    $weiboInfo[$index]["IsRead"] = 1;
                }
                if(strpos($single['parent']['pic'],"image")){
                    $weiboInfo[$index]["retweetedPic"]         = str_replace(".jpg","small.jpg",$single['parent']['pic']);
                    $weiboInfo[$index]["retweetedPicLarge"]         = str_replace(".jpg","medium.jpg",$single['parent']['pic']);
                }
                if(strpos($single['parent']['pic'],"thumbnail")){
                    $weiboInfo[$index]["retweetedPic"]         = $single['parent']['pic'];
                    $weiboInfo[$index]["retweetedPicLarge"]         = str_replace("thumbnail","bmiddle",$single['parent']['pic']);
                }
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
	}*/
//transfer Elgg weibo data to uniform array ,����˹��˱���,�ѱ����ı����ͼƬ
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
//                 $weiboInfo[$index]["IsTag"] = 0;
//                 $weiboInfo[$index]["IsRead"] = 0;
// 	    	    $sql = "select ID from tagweibo where weiboID = ".$single['guid']." and username = '$compere';";
//             	$res = $userdb->Execute($sql);
//                 if(!$res->EOF){
//                     $weiboInfo[$index]["IsTag"] = 1;
//                 }
// 	    	    $sql = "select ID from tagread where weiboID = ".$single['guid']." and username = '$compere';";
//             	$res = $userdb->Execute($sql);
//                 if(!$res->EOF){
//                     $weiboInfo[$index]["IsRead"] = 1;
//                 }
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

	/* transfer Elgg weibo comments data to uniform array */
	function transElggCommentData($wireList){
		$index = 0;
        	$number = 0;
		foreach($wireList as $single){
                	$weiboInfo[$index]["ID"]          = $single['guid'];
                	//$weiboInfo[$index]["Sender"]      = iconv("UTF-8","GB2312",$single['owner']['name']);
                	$weiboInfo[$index]["Sender"]      = $single['owner']['name'];
                	$weiboInfo[$index]["OwnerGuid"]      = $single['owner']['guid'];
                	$weiboInfo[$index]["AvatarUrl"]   = $single['owner']['avatar_url'];
                	//$weiboInfo[$index]["Time"]        = iconv("UTF-8","GB2312",tranTime($single['time_created']));
                	$weiboInfo[$index]["Time"]        = tranTime($single['time_created']);
                	//$weiboInfo[$index]["Content"]     = iconv("UTF-8","GB2312",$single['description']);
                    $str = $this->thewire_filter($single['value']);
                	$weiboInfo[$index]["Content"]     = replaceEmotions($str);
                //	$weiboInfo[$index]["Content"]     = $single['value'];
			$weiboInfo[$index]["originalID"]  = $single['entity_guid'];
                	$weiboInfo[$index]["num"]         = $number;

			$index++;
			$number++;
		}
		return $weiboInfo;
	}
    	function getElggWeiboNum($wireList){
            	$number = 0;
            	foreach($wireList as $single){
                    	$number++;
            	}

            	return $number;
    	}
	/* transfer Sina weibo data to uniform array */
	function transSinaData($wireList, $time = 0){
		$index = 0;
        if($time == 1){
            $number = 15;
        }else if($time == 2){
            $number = 30;
        }else{
            $number = 0;
        }
		foreach($wireList as $single){
                	$weiboInfo[$index]["ID"]          = $single['id'];
                	$weiboInfo[$index]["Sender"]      = $single['user']['screen_name'];//iconv("UTF-8","GBK",$single['user']['screen_name']);
                	$weiboInfo[$index]["AvatarUrl"]   = $single['user']['profile_image_url'];
                	$weiboInfo[$index]["Time"]        = tranTime(strtotime($single['created_at']));
                    $weiboInfo[$index]["timeTime"]        = date("H:i",strtotime($single['created_at']));
                    $weiboInfo[$index]["DayTime"]        = date("Y.m.d",strtotime($single['created_at']));
                    $str = $this->thewire_filter($single['text']);
                    $str=replaceEmotions($str);
                //file_put_contents("/home/zsc.txt","\nclass:".$str,FILE_APPEND);
                   	$weiboInfo[$index]["Content"]     =  $str;
                   //	$weiboInfo[$index]["ContentLong"]     =  $single['text'];
                	$weiboInfo[$index]["ContentLong"]   = str_replace('"','>!<',$single['text']);
                    $weiboInfo[$index]["ContentLong"]   = str_replace('\'','>?<',$weiboInfo[$index]["ContentLong"]);
                    $weiboInfo[$index]["ContentLong"] = preg_replace("/\s+/", " ", $weiboInfo[$index]["ContentLong"]);
			        if(mb_strlen($single['text'],'utf-8') > 30){
				        $weiboInfo[$index]["ContentShort"] = mb_substr($single['text'],0,30,'utf-8')."...";
			        }else{
				        $weiboInfo[$index]["ContentShort"] = $weiboInfo[$index]["Content"];
			        }			
                	$weiboInfo[$index]["Source"]      = strip_tags($single['source']);//iconv("UTF-8","GBK",$single['source']);
			        if($single['favorited']){
				        $weiboInfo[$index]["Favorite"]  = 1;
			        }else{
				        $weiboInfo[$index]["Favorite"]  = 0;
			        }
                	$weiboInfo[$index]["Pic"]         = $single['thumbnail_pic'];
                 //   $weiboInfo[$index]["Pic"]         = $single['status']['thumbnail_pic'];
                    $weiboInfo[$index]["PicLarge"]         = $single['bmiddle_pic'];
                //	$weiboInfo[$index]["middlePic"]   = $single['bmiddle_pic'];
               // 	$weiboInfo[$index]["originalPic"] = $single['original_pic'];
                	$weiboInfo[$index]["ReplyCount"]  = $single['reposts_count'];
                	$weiboInfo[$index]["CommentCount"]= $single['comments_count'];
                	//$weiboInfo[$index]["retweetedUsername"]  = iconv("UTF-8","GBK",$single['retweeted_status']['user']['screen_name']);
                	$weiboInfo[$index]["retweetedUsername"]  = $single['retweeted_status']['user']['screen_name'];
                	//$weiboInfo[$index]["retweetedContent"]   = iconv("UTF-8","GBK",$single['retweeted_status']['text']);
                    $str = $this->thewire_filter($single['retweeted_status']['text']);
                	$weiboInfo[$index]["retweetedContent"]   = replaceEmotions($str);
                	$weiboInfo[$index]["retweetedContentLong"]   = $single['retweeted_status']['text'];
                	$weiboInfo[$index]["retweetedContentLong"]   = str_replace('"','>!<',$single['retweeted_status']['text']);
                	$weiboInfo[$index]["retweetedContentLong"]   = str_replace('"',">?<",$weiboInfo[$index]["retweetedContentLong"]);
                    $weiboInfo[$index]["retweetedContentLong"] = preg_replace("/\s+/", " ", $weiboInfo[$index]["retweetedContentLong"]);

                	$weiboInfo[$index]["retweetedPic"]       = $single['retweeted_status']['thumbnail_pic'];
                    $weiboInfo[$index]["retweetedPicLarge"]       = $single['retweeted_status']['bmiddle_pic'];
                	//$weiboInfo[$index]["retweetedTime"]      = iconv("UTF-8","GB2312",tranTime(strtotime($single['retweeted_status']['created_at'])));
                	$weiboInfo[$index]["retweetedTime"]      = tranTime(strtotime($single['retweeted_status']['created_at']));
                	$weiboInfo[$index]["retweetedSource"]    = strip_tags($single['retweeted_status']['source']);
                	$weiboInfo[$index]["retweetedReplyCount"]  = $single['retweeted_status']['reposts_count'];
                	$weiboInfo[$index]["retweetedCommentCount"]= $single['retweeted_status']['comments_count'];
                	//$weiboInfo[$index]["retweetedSource"]    = iconv("UTF-8","GBK",$single['retweeted_status']['source']);
                	//$weiboInfo[$index]["Type"]        =$res->fields[13];
                	$weiboInfo[$index]["num"]         = $number;

			        $index++;
			        $number++;
		}
		return $weiboInfo;
	}
	/* transfer Sina comment data to uniform array */
	function transSinaCommentData($wireList, $time = 0){
		$index = 0;
        if($time == 1){
            $number = 15;
        }else if($time == 2){
            $number = 30;
        }else{
            $number = 0;
        }
		foreach($wireList as $single){
                $weiboInfo[$index]["ID"]              = $single['id'];
                //$weiboInfo[$index]["Sender"]        = iconv("UTF-8","GBK",$single['user']['screen_name']);
                $weiboInfo[$index]["Sender"]          = $single['user']['screen_name'];
                $weiboInfo[$index]["AvatarUrl"]       = $single['user']['profile_image_url'];
                //$weiboInfo[$index]["Time"]          = iconv("UTF-8","GB2312",tranTime(strtotime($single['created_at'])));
                $weiboInfo[$index]["Time"]            = tranTime(strtotime($single['created_at']));
                //$weiboInfo[$index]["Content"]       = iconv("UTF-8","GB2312",$single['text']);
                //$weiboInfo[$index]["Content"]       = iconv("UTF-8","GBK",$single['text']);
                $str = $this->thewire_filter($single['text']);
                $weiboInfo[$index]["Content"]         = replaceEmotions($str);
                $weiboInfo[$index]["originalID"]      = $single['status']['id'];
                //$weiboInfo[$index]["originalText"]  = $single['status']['text'];
                //$weiboInfo[$index]["originalUserID"]= $single['status']['user']['id'];
                $weiboInfo[$index]["originalUserName"]= $single['status']['user']['screen_name'];
                $weiboInfo[$index]["num"]             = $number;

			    $index++;
			    $number++;
		}
		return $weiboInfo;
	}

	/* transfer Sina favorite weibo data to uniform array */
	function transSinaFavoriteData($wireList,$time = 0){
		$index = 0;
        if($time == 1){
            $number = 15;
        }else if($time == 2){
            $number = 30;
        }else{
            $number = 0;
        }
		foreach($wireList as $single){
                if($single['status']['deleted']){
                    $weiboInfo[$index]['Deleted'] = 1;
                }
                $weiboInfo[$index]["ID"]          = $single['status']['id'];
                $weiboInfo[$index]["Sender"]      = $single['status']['user']['screen_name'];//iconv("UTF-8","GBK",$single['user']['screen_name']);
                $weiboInfo[$index]["AvatarUrl"]   = $single['status']['user']['profile_image_url'];
                $weiboInfo[$index]["Time"]        = tranTime(strtotime($single['status']['created_at']));
                $weiboInfo[$index]["timeTime"]        = date("H:i",strtotime($single['status']['created_at']));
                $weiboInfo[$index]["DayTime"]        = date("Y.m.d",strtotime($single['status']['created_at']));
                $str = $this->thewire_filter($single['status']['text']);
                $weiboInfo[$index]["Content"]     = replaceEmotions($str);
                //$weiboInfo[$index]["ContentLong"]     =  $single['status']['text'];
                $weiboInfo[$index]["ContentLong"]   = str_replace('"','>!<',$single['status']['text']);
                $weiboInfo[$index]["ContentLong"]   = str_replace('\'',">?<",$weiboInfo[$index]["ContentLong"]);
                $weiboInfo[$index]["ContentLong"] = preg_replace("/\s+/", " ", $weiboInfo[$index]["ContentLong"]);
		        if(mb_strlen($single['status']['text'],'utf-8') > 30){
			        $weiboInfo[$index]["ContentShort"] = mb_substr($single['status']['text'],0,30,'utf-8')."...";
		        }else{
			        $weiboInfo[$index]["ContentShort"] = $weiboInfo[$index]["Content"];
	        	}
                $weiboInfo[$index]["Source"]      = strip_tags($single['status']['source']);//iconv("UTF-8","GBK",$single['source']);
		        if($single['status']['favorited']){
			        $weiboInfo[$index]["Favorite"]  = 1;
		        }else{
			        $weiboInfo[$index]["Favorite"]  = 0;
		        }
                $weiboInfo[$index]["Audio"]       = $single['status']['audio'];
                $weiboInfo[$index]["AudioLen"]    = $single['status']['audiolen'];
                $weiboInfo[$index]["Pic"]         = $single['status']['thumbnail_pic'];
                $weiboInfo[$index]["PicLarge"]         = $single['status']['bmiddle_pic'];
                $weiboInfo[$index]["ReplyCount"]  = $single['status']['reposts_count'];
                $weiboInfo[$index]["CommentCount"]= $single['status']['comments_count'];
                //$weiboInfo[$index]["retweetedUsername"]  = iconv("UTF-8","GBK",$single['retweeted_status']['user']['screen_name']);
                $weiboInfo[$index]["retweetedUsername"]  = $single['status']['retweeted_status']['user']['screen_name'];
                //$weiboInfo[$index]["retweetedContent"]   = iconv("UTF-8","GBK",$single['retweeted_status']['text']);
                $str = $this->thewire_filter($single['status']['retweeted_status']['text']);
                $weiboInfo[$index]["retweetedContent"]   =replaceEmotions($str);
                //$weiboInfo[$index]["retweetedContentLong"]   = $single['status']['retweeted_status']['text'];
                $weiboInfo[$index]["retweetedContentLong"]   = str_replace('"','>!<',$single['status']['retweeted_status']['text']);
                $weiboInfo[$index]["retweetedContentLong"]   = str_replace('\'',">?<",$weiboInfo[$index]["retweetedContentLong"]);
                $weiboInfo[$index]["retweetedContentLong"] = preg_replace("/\s+/", " ", $weiboInfo[$index]["retweetedContentLong"]);
                $weiboInfo[$index]["retweetedPic"]       = $single['status']['retweeted_status']['thumbnail_pic'];
                $weiboInfo[$index]["retweetedPicLarge"]       = $single['status']['retweeted_status']['bmiddle_pic'];
                //$weiboInfo[$index]["retweetedTime"]      = iconv("UTF-8","GB2312",tranTime(strtotime($single['retweeted_status']['created_at'])));
                $weiboInfo[$index]["retweetedTime"]      = tranTime(strtotime($single['status']['retweeted_status']['created_at']));
                $weiboInfo[$index]["retweetedSource"]    = strip_tags($single['status']['retweeted_status']['source']);
                $weiboInfo[$index]["retweetedReplyCount"]  = $single['status']['retweeted_status']['reposts_count'];
                $weiboInfo[$index]["retweetedCommentCount"]= $single['status']['retweeted_status']['comments_count'];
                //$weiboInfo[$index]["retweetedSource"]    = iconv("UTF-8","GBK",$single['retweeted_status']['source']);
                //$weiboInfo[$index]["Type"]        =$res->fields[13];
                $weiboInfo[$index]["num"]         = $number;

			    $index++;
			    $number++;
		}
		return $weiboInfo;
	}

	function insert_weibo($table, $infoList, $type){
		global $userdb;
        foreach($infoList as $single){
                $guid = $single['guid'];
                //$sender = iconv("UTF-8","GB2312",$single['owner']['name']);
                $sender = $single['owner']['name'];
                $username = $single['owner']['username'];
                $avatarUrl = $single['owner']['avatar_url'];
                $time = $single['time_created'];
                //$time1 = date('Y-m-d H:i:s',$time);
                //$content = iconv("UTF-8","GB2312",$single['description']);
                $content = $single['description'];
                $audio = $single['audio'];
                $audioLen = $single['audiolen']/1000+1;
                $pic = $single['pic'];
                $replyCount = $single['replycount'];
                $commentCount = $single['commentcount'];
                //$content = $single['description'];
                if($type=="at"){
		            $sql = "insert into ".$table."(ID, Sender, Username, AvatarUrl, Time, Content, Audio, AudioLen, PIC, ReplyCount, CommentCount, Type) values('".$guid."','".$sender."','".$username."','".$avatarUrl."','".$time."','".$content."','".$audio."','".$audioLen."','".$pic."','".$replyCount."','".$commentCount."','1');";
                }else if($type=="all"){
		            $sql = "insert into ".$table."(ID, Sender, Username, AvatarUrl, Time, Content, Audio, AudioLen, PIC, ReplyCount, CommentCount) values('".$guid."','".$sender."','".$username."','".$avatarUrl."','".$time."','".$content."','".$audio."','".$audioLen."','".$pic."','".$replyCount."','".$commentCount."');";
                }
		        $res = $userdb->Execute($sql);
        }
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
	//function update_weibo($table,$infoList,$type){
	function update_weibo($table,$infoList){
		global $userdb;
        foreach($infoList as $single){
            $guid = $single['guid'];
            //$sender = iconv("UTF-8","GB2312",$single['owner']['name']);
            $sender = $single['owner']['name'];
            $username = $single['owner']['username'];
            $avatarUrl = $single['owner']['avatar_url'];
            $replyCount = $single['replycount'];
            $commentCount = $single['commentcount'];
            $update="update ".$table." set Sender='".$sender."', Username='".$username."',AvatarUrl='".$avatarUrl."',ReplyCount='".$replyCount."',CommentCount='".$commentCount."' where ID='".$guid."'";
		    $res=$userdb->Execute($update);
        }
		//$res->close();
	}
    	function markWeixin($id){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_name'];
		        $sql = "select *  from tagweixin where username='".$username."' and msg_id='".$id."';";
            	$res = $userdb->Execute($sql);
                if($res->EOF){
		            $sql = "insert into tagweixin(username,msg_id) values('".$username."','".$id."');";
            	    $res = $userdb->Execute($sql);
                    return "new";
                }
            	return "old";
    	}
    	function unmarkWeixin($id){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_name'];
		        $sql = "delete from tagweixin where username='".$username."' and msg_id='".$id."';";
            	$res = $userdb->Execute($sql);
            	//return $res;
    	}
    	function readWeixin($id){
            	global $userdb;
		       	$username = $_SESSION['adminstatus']['admin_name'];
		        $sql = "select *  from readweixin where username='".$username."' and msg_id='".$id."';";
            	$res = $userdb->Execute($sql);
                if($res->EOF){
		            $sql = "insert into readweixin(username,msg_id) values('".$username."','".$id."');";
            	    $res = $userdb->Execute($sql);
                    return "new";
                }
            	return "old";
    	}
    	function replyWeixin($id){
                //��file_put_contents("/home/zsc.txt","111111\n",FILE_APPEND);
            	global $userdb;
		        $sql = "select id from replayweixin where msg_id='".$id."';";
            	$res = $userdb->Execute($sql);
                //file_put_contents("/home/zsc.txt","$sql\n",FILE_APPEND);
                if($res->EOF){
		            $sql = "insert into replayweixin(msg_id) values('".$id."');";
            	    $res = $userdb->Execute($sql);
                    return "new";
                }
            	return "new";
    	}
    	function unreadWeixin($id){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_name'];
		        $sql = "delete from readweixin where username='".$username."' and msg_id='".$id."';";
            	$res = $userdb->Execute($sql);
            	//return $res;
    	}
    	function markWeibo($table, $guid){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_name'];//与频率账号相关联，导播与主持人都能看到zhb
		        $sql = "select *  from ".$table." where username='".$username."' and weiboID='".$guid."';";
            	$res = $userdb->Execute($sql);
                if($res->EOF){
		            $sql = "insert into ".$table."(username,weiboID) values('".$username."','".$guid."');";
            	    $res = $userdb->Execute($sql);
                    return "new";
                }
            	return "old";
    	}
    	function unmarkWeibo($table, $guid){
            	global $userdb;
		$username = $_SESSION['adminstatus']['admin_name'];
            	//$sql = "update ".$table." set IsTag='".$isTag."' where ID='".$guid."'";
		$sql = "delete from ".$table." where username='".$username."' and weiboID='".$guid."';";
            	$res = $userdb->Execute($sql);
            	//return $res;
    	}
/*
    	function updateRead($table,$guid,$isRead){
            	global $userdb;
            	$sql = "update ".$table." set IsRead='".$isRead."' where ID='".$guid."'";
            	$res = $userdb->Execute($sql);
            	//return $res;
    	}
*/
	/* Add by languoliang, @2013.03.15 */
    	function tagRead($table, $guid){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_name'];
		//delete old read weibo
		        $sql = "select * from  ".$table." where username='".$username."' and weiboID='".$guid."';";
            	$res = $userdb->Execute($sql);
                if($res->EOF){
		//insert new read weibo
		            $sql = "insert into ".$table."(username,weiboID) values('".$username."','".$guid."');";
            	    $res = $userdb->Execute($sql);
                    return "new";
                }
                return "old";
            	//return $res;
    	}
	/* Add by languoliang, @2013.03.15 */
    	function untagRead($table, $guid){
            	global $userdb;
		$username = $_SESSION['adminstatus']['admin_name'];
            	//$sql = "update ".$table." set IsTag='".$isTag."' where ID='".$guid."'";
		$sql = "delete from ".$table." where username='".$username."' and weiboID='".$guid."';";
            	$res = $userdb->Execute($sql);
            	//return $res;
    	}
	function deleteWeibo($table,$guid){
    		global $userdb;
    		$query = "delete from ".$table." where ID=".$guid;
    		$result = $userdb->Execute($query);
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
    
    
//--------------------------------------------- gaomeidi 添加 -----------------------------------------------------
    	function add_CommonRoad($table, $rid, $roadname, $initials, $position){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_hostername'];
		        $sql = "select * from  ".$table." where rid='".$rid."';";
            	$res = $userdb->Execute($sql);
            	$finish = "";
                if($res->EOF){
		            $sql = "insert into ".$table."(rid, roadname, initials, position, sum) values('".$rid."','".$roadname."','".$initials."','".$position."',sum+1);";
            	    $res = $userdb->Execute($sql);
                    $finish = "success";
                }else{
                	$sql="update ".$table." set roadname='".$roadname."', initials='".$initials."',position='".$position."',sum=sum+1   where rid='".$rid."'";
            	    $res = $userdb->Execute($sql);
                    $finish = "success";
                }
                return $finish;
    	}
    	function del_CommonRoad($rid){
            	global $userdb;
            	$str="";
		        $sql = "delete from  `commonroad`  where rid='".$rid."'";
		        $result = $userdb->Execute($sql);
		        if($result){
		        	$str="success";
		        }
		        return $str;
    	}
    	function query_CommonRoad(){ 
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_hostername'];
		        $sql = "select * from  `commonroad`  order by sum  LIMIT 0,44;";
            	$res = $userdb->Execute($sql);
            	$index = 0;
            	$number = 1;
            	while(!$res->EOF){
            		$roadlist[$index]["rid"]       =$res->fields[0];
            		$roadlist[$index]["roadname"]   =$res->fields[1];
            		$roadlist[$index]["initials"] =$res->fields[2];
            		$roadlist[$index]["position"]     =$res->fields[3];
            		$roadlist[$index]["sum"]  =$res->fields[4];
            		$roadlist[$index]["num"]      =$number;
            		$index++;
            		$number++;
            		$res->MoveNext();
            	}
            	//$res->close();
            	return $roadlist;
    	}
    	
    	function quick_Search($quickkwd){
            	global $userdb;
		        $username = $_SESSION['adminstatus']['admin_hostername'];
		        $sql = "select  *  from  `commonroad`  where  roadname  like '%".$quickkwd."%'  or  initials  like '%".$quickkwd."%'  order by sum   LIMIT 0,44;";
            	$res = $userdb->Execute($sql);
            	$index = 0;
            	$number = 1;
            	while(!$res->EOF){
            		$roadlist[$index]["rid"]       =$res->fields[0];
            		$roadlist[$index]["roadname"]   =$res->fields[1];
            		$roadlist[$index]["initials"] =$res->fields[2];
            		$roadlist[$index]["position"]     =$res->fields[3];
            		$roadlist[$index]["sum"]  =$res->fields[4];
            		$roadlist[$index]["num"]      =$number;
            		$index++;
            		$number++;
            		$res->MoveNext();
            	}
            	//$res->close();
            	return $roadlist;
    	}
    	
//--------------------------------------------- gaomeidi 添加 End -----------------------------------------------------
//--------------------------------------------- zhanghanbing 添加 Start 2014.09.10 ------------------------------------
//路况信息 	之获取字符串首字母 zhanghanbing 2014.09.10 ------------------------------------------------------------------

    	 private  $_pinyins = array(
        176161 => 'A',
        176197 => 'B',
        178193 => 'C',
        180238 => 'D',
        182234 => 'E',
        183162 => 'F',
        184193 => 'G',
        185254 => 'H',
        187247 => 'J',
        191166 => 'K',
        192172 => 'L',
        194232 => 'M',
        196195 => 'N',
        197182 => 'O',
        197190 => 'P',
        198218 => 'Q',
        200187 => 'R',
        200246 => 'S',
        203250 => 'T',
        205218 => 'W',
        206244 => 'X',
        209185 => 'Y',
        212209 => 'Z',
    );
     private    $_charset = null;

   
    /**
     * 构造函数, 指定需要的编码 default: utf-8
     * 支持utf-8, gb2312
     *
     * @param unknown_type $charset
     */
    public function __construct( $charset = 'utf-8' )
    {
        $this->_charset    = $charset;
    }
    /**
     * 中文字符串 substr
     *
     * @param string $str
     * @param int    $start
     * @param int    $len
     * @return string
     */
   private  function _msubstr ($str, $start, $len)
    {
        $start  = $start * 2;
        $len    = $len * 2;
        $strlen = strlen($str);
        $result = '';
        for ( $i = 0; $i < $strlen; $i++ ) {
            if ( $i >= $start && $i < ($start + $len) ) {
                if ( ord(substr($str, $i, 1)) > 129 ) $result .= substr($str, $i, 2);
                else $result .= substr($str, $i, 1);
            }
            if ( ord(substr($str, $i, 1)) > 129 ) $i++;
        }
        return $result;
    }
    /**
     * 字符串切分为数组 (汉字或者一个字符为单位)
     *
     * @param string $str
     * @return array
     */
    private  function _cutWord( $str )
    {
        $words = array();
         while ( $str != "" )
         {
            if ( $this->_isAscii($str) ) {/*非中文*/
                $words[] = $str[0];
                $str = substr( $str, strlen($str[0]) );
            }else{
                $word = $this->_msubstr( $str, 0, 1 );
                $words[] = $word;
                $str = substr( $str, strlen($word) );
            }
         }
         return $words;
    }
    /**
     * 判断字符是否是ascii字符
     *
     * @param string $char
     * @return bool
     */
    private  function _isAscii( $char )
    {
        return ( ord( substr($char,0,1) ) < 160 );
    }
    /**
     * 判断字符串前3个字符是否是ascii字符
     *
     * @param string $str
     * @return bool
     */
    private  function _isAsciis( $str )
    {
        $len = strlen($str) >= 3 ? 3: 2;
        $chars = array();
        for( $i = 1; $i < $len -1; $i++ ){
            $chars[] = $this->_isAscii( $str[$i] ) ? 'yes':'no';
        }
        $result = array_count_values( $chars );
        if ( empty($result['no']) ){
            return true;
        }
        return false;
    }
    /**
     * 获取中文字串的拼音首字符
     *
     * @param string $str
     * @return string
     */
    public function getInitials( $str )
    {
        if ( empty($str) ) return '';
      //  if ( $this->_isAscii($str[0]) && $this->_isAsciis( $str )){
      //      return $str;
      //  }
        $result = array();
        if ( $this->_charset == 'utf-8' ){
            $str = iconv( 'utf-8', 'gb2312', $str );
        }
        $words = $this->_cutWord( $str );
        foreach ( $words as $word )
        {
            if ( $this->_isAscii($word) ) {/*非中文*/
                $result[] = $word;
                continue;
            }
            $code = ord( substr($word,0,1) ) * 1000 + ord( substr($word,1,1) );
            /*获取拼音首字母A--Z*/
            if ( ($i = $this->_search($code)) != -1 ){
                $result[] = $this->_pinyins[$i];
            }
        }
        return strtoupper(implode('',$result));
    }
    private  function _getChar( $ascii )
    {
        if ( $ascii >= 48 && $ascii <= 57){
            return chr($ascii);  /*数字*/
        }elseif ( $ascii>=65 && $ascii<=90 ){
            return chr($ascii);   /* A--Z*/
        }elseif ($ascii>=97 && $ascii<=122){
            return chr($ascii-32); /* a--z*/
        }else{
            return '-'; /*其他*/
        }
    }
    /**
     * 查找需要的汉字内码(gb2312) 对应的拼音字符( 二分法 )
     *
     * @param int $code
     * @return int
     */
    private  function _search( $code )
    {
        $data = array_keys($this->_pinyins);
        $lower = 0;
        $upper = sizeof($data)-1;
  $middle = (int) round(($lower + $upper) / 2);
        if ( $code < $data[0] ) return -1;
        for (;;) {
            if ( $lower > $upper ){
                return $data[$lower-1];
            }
            $tmp = (int) round(($lower + $upper) / 2);
            if ( !isset($data[$tmp]) ){
    return $data[$middle];
            }else{ 
    $middle = $tmp;
   }
            if ( $data[$middle] < $code ){
                $lower = (int)$middle + 1;
            }else if ( $data[$middle] == $code ) {
                return $data[$middle];
            }else{
                $upper = (int)$middle - 1;
            }
        }
    }
//--------------------------------------------- zhanghanbing 添加 End 2014.09.10 ------------------------------------
    //路况信息 	之获取字符串首字母 gaomeidi 2014.09.10 ------------------------------------------------------------------
 
    	//将数据写入xml类型的字符串传输信息$info
    	function writeXML($root,$data_array){
    		//创建一个XML文档并设置XML版本和编码
    		$dom=new DomDocument('1.0', 'utf-8');
    		//创建根节点
    		$croot = $dom->createElement($root);
    		$dom->appendchild($croot);
    		foreach ($data_array as $key => $val){
    			//创建元素
    			$$key = $dom->createElement($key);
    			$croot->appendchild($$key);
    			//创建元素值
    			$text = $dom->createTextNode($val);
    			$$key->appendchild($text);
    		}
    		$info=$dom->saveXML();//传输信息
    		return $info;
    	}
    	
        //主调函数 - 路况添加
    	function add_roadinfo($SerialNo,$RadioID,$hostweibo,$Positionname,$Position,$Type,$ImgUrl,$Direction,$Situation,$VoiceUrl,$Memo){
    		$data_array = array('SerialNo'=>$SerialNo,
    		                    'RadioID' => $RadioID,
    		                    'hostweibo' => $hostweibo,
    		                    'Positionname' => $Positionname,
    		                    'Position' => $Position,
    		                    'Type' => $Type,
    		                    'ImgUrl' =>$ImgUrl,
    		                    'Direction' =>$Direction,
    		                    'Situation' =>$Situation,
    		                    'VoiceUrl' => $VoiceUrl,
    		                    'Memo' => $Memo
    		              );
    		$root = "InsertIn";
    		$info = $this->writeXML($root,$data_array) ;//传输信息
    		return $info;
    	}

        //主调函数 - 路况查询
        function queryRoadInfo($SerialNo,$RadioID,$Type,$Situation,$lngX,$latY,$Key,$Value,$Page,$PageCount){
        	$data_array = array('SerialNo'=>$SerialNo,
        	                    'RadioID' => $RadioID,
        	                    'Type' => $Type,
        	                    'Situation' =>$Situation,
        	                    'lngX' => $lngX,
        	                    'latY' => $latY,
        	                    'Key' => $Key,
        	                    'Value'=>$Value,
        	                    'Page'=>$Page,
        	                    'PageCount' =>$PageCount
        	              );
        	$root = "QueryIn";
        	$info = $this->writeXML($root,$data_array) ;//传输信息
        	return $info;
        }
        
        function readXML($xmlstring){
//        	echo $xmlstring;
        	$dom = new DOMDocument();
        	$dom->loadXML($xmlstring);
        	$arry=$this->getArray($dom->documentElement);
        	$arry_y=$this->changeArray($arry);
//        	return $arry;
        	return $arry_y;
        }
        
        function getArray($node){
        	$array = false;
        	if($node->hasChildNodes()){
        		if($node->childNodes->length == 1){
        			$array[$node->firstChild->nodeName] = $this->getArray($node->firstChild);
        		}else{
        			foreach($node->childNodes as $childNode){
        				if($childNode->nodeType != XML_TEXT_NODE){
        					$array[$childNode->nodeName][] = $this->getArray($childNode);
        				}
        			}
        		}
        	}else{
        		return $node->nodeValue;
        	}
        	return $array;
        }
        
        function changeArray($array){
//        	print_r($array);
        	$g_array=array();
        	$g_array['OK']=$array['OK'][0]['#text'];
        	if($array['InfoList'][0]['info']){
        		$array_a=$array['InfoList'][0]['info'];
        		$num=1;
        		$maxismark_time=0;
        		if($array_a[0]){
        			foreach($array_a as $akey=>$avalue){
        				foreach($avalue as $a_key => $a_value){
        					if($a_key=='CreateTime'){
        						$datet=explode(" ",$a_value[0]['#text']);
        						$time=explode(":",$datet[1]);
        						$g_array['InfoList'][$akey][$a_key]=$time[0].":".$time[1];
        					}elseif($a_key=='Ismark'){
        						$g_array['InfoList'][$akey][$a_key]=$a_value[0]['#text'];
        						$ismarktime = intval($g_array['InfoList'][$akey][$a_key]);
        						if($ismarktime>$maxismark_time){
        							$maxismark_time = $ismarktime;
        						}
        					}else{
        						$g_array['InfoList'][$akey][$a_key]=$a_value[0]['#text'];
        					}
        				}
        				$g_array['InfoList'][$akey]['num']=$num;
        				$num++;
        			}
        			$g_array['MaxNo']=$g_array['InfoList'][0]['No'];
        			if($maxismark_time==0){
        				$g_array['MaxIsMark']=time();
        			}else{
        				$g_array['MaxIsMark']=$maxismark_time;
        			}
        		}else{
        			foreach($array_a as $a_key=>$a_value){
        				if($a_key=='CreateTime'){
        						$datet=explode(" ",$a_value[0]['#text']);
        						$time=explode(":",$datet[1]);
        						$g_array['InfoList'][0][$a_key]=$time[0].":".$time[1];
        				}else{
        						$g_array['InfoList'][0][$a_key]=$a_value[0]['#text'];
        				}
        			}
        			$g_array['MaxNo']=$g_array['InfoList'][0]['No'];
        			if($g_array['InfoList'][0]['Ismark']=='0'){
        				$g_array['MaxIsMark']=time();
        			}else{
        				$g_array['MaxIsMark']=$g_array['InfoList'][0]['Ismark'];
        			}
        		}
        	}
        	return $g_array;
        }

        //主调函数 - 修改路况
        function Modifyroadinfo($SerialNo,$RadioID,$WeiboID,$No,$Name,$Op){
        	$data_array = array(
                   'SerialNo'=>$SerialNo,
                   'RadioID' => $RadioID,
                   'WeiboID' => $WeiboID,
                   'No' =>$No,
                   'Name'=>$Name,
                   'Op'=>$Op
                   );
        	$root=  "ModifyIn";
        	$info= $this->writeXML($root,$data_array) ;
        	return $info;
        }

        //主调函数 - 统计最新路况
        function getroadcount($SerialNo,$RadioID,$WeiboID,$MaxNo,$MaxIsMark){
	        $data_array = array(
                   'SerialNo'=>$SerialNo,
                   'RadioID' => $RadioID,
                   'WeiboID' => $WeiboID,
                   'MaxNo' =>$MaxNo,
                   'MaxIsMark' => $MaxIsMark,
                   );
	        $root=  "QueryIn";
	        $info= $this->writeXML($root,$data_array) ;//传给服务器的参数消息
	        return $info;
        }
        
        function roadcountReadXML($response){
	        $dom = new DOMDocument();
	        $dom->loadXML($response);
	        $infos = $dom->getElementsByTagName("QueryOut"); 
	        foreach ($infos as $info){ 
	        	$OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
	        	$MarkCount=$info->getElementsByTagName("MarkCount")->item(0)->nodeValue;//最新标记数
	        	$NoCount=$info->getElementsByTagName("NoCount")->item(0)->nodeValue;//最新路况数
	        	$ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
	        	//print_r("$OK,$MarkCount,$NoCount,$ErrorInfo");
	        }
	        $resarray = array(
                        'OK'=>$OK,
                        'ErrorInfo'=>$ErrorInfo,
                        'NoCount'=>$NoCount,
                        'MarkCount'=>$MarkCount
                        );
	        return $resarray;
        }
        
        
        //------------------------------ 天气查询 ----------------------------------
        function queryWeatherInfo($SerialNo, $RadioID, $Location){
        	$data_array = array(
                   'SerialNo'=>$SerialNo,
                   'RadioID' => $RadioID,
                   'Location' => $Location
                   );
        	$root=  "QueryWeatherIn";
        	$info= $this->writeXML($root,$data_array);
        	return $info;
        }
        
        function readThirdXML($xmlstring){
//        	echo $xmlstring;
        	$dom = new DOMDocument();
        	$dom->loadXML($xmlstring);
        	$arry=$this->getArray($dom->documentElement);
        	return $arry;
        }

        
        
        
        
        
        
     function xmlToArr($xml, $root = true) { 
		  if($xml==null) return "";
		   if (!$xml->children()) { 
              return (string) $xml; 
           } 
           $array = array(); 
           foreach ($xml->children() as $element => $node) { 
              $totalElement = count($xml->{$element}); 
              if (!isset($array[$element])) { 
                 $array[$element] = ""; 
              } 
              // Has attributes 
              if ($attributes = $node->attributes()) { 
                 $data = array( 
                   'attributes' => array(), 
                   'value' => (count($node) > 0) ? $this->xmlToArr($node, false) : (string) $node 
                 ); 
                 foreach ($attributes as $attr => $value) { 
                    $data['attributes'][$attr] = (string) $value; 
                 } 
                 if ($totalElement > 1) { 
                    $array[$element][] = $data; 
                 } else { 
                   $array[$element] = $data; 
                 } 
                 // Just a value 
              } else { 
                if ($totalElement > 1) { 
                  $array[$element][] = $this->xmlToArr($node, false); 
                } else { 
                  $array[$element] = $this->xmlToArr($node, false); 
                } 
             } 
         } 
         if ($root) { 
            return array($xml->getName() => $array); 
         } else { 
           return $array; 
         }
     }
     
    //热门话题、热门栏目-翻页
	function getPageUrlString_hot($page, $tail, $query_c="1"){
		global $constant;
		if($page == 1){
                $page_string .= $constant["pubpage"]["HomePage"].'|'.$constant["pubpage"]["Previous"].'|';
		}else{
                $page_string.= '<a href=javascript:changePageN(1);>'.$constant["pubpage"]["HomePage"].'</a>|<a href=javascript:changePageN('.($page-1).');>'.$constant["pubpage"]["Previous"].'</a>|';
        }
        if($tail){
                $page_string .= $constant["pubpage"]["Next"];
        }else{
                $page_string .= '<a href=javascript:changePageN('.($page+1).');>'.$constant["pubpage"]["Next"].'</a>';
        }
        return $page_string;
    }
    
    //热门话题、热门栏目-数组转换
    function transElggHotTopic($weiboInfo){
		$index = 0;
        $number = 0;
		foreach($weiboInfo as $single){
                	$weiboInfo[$index]["CreateTime"] = tranTime($single['time_created']);
                	$weiboInfo[$index]["ReadCount"] = $this->tranCount($single['read_count']);
                	//------lichun-----hot topic---20141118-----Start--------------------------------
                	$weiboInfo[$index]["InteractCount"] = $this->tranCount($single['interact_count']);
                	$weiboInfo[$index]["Pic"] = $single['pic'];
                	//------lichun-----hot topic---20141118------End-----------------------------------
                	$weiboInfo[$index]["num"]        = $number;
                	$index++;
                	$number++;
		}
		return $weiboInfo;
	}
	
	//热门话题、热门栏目-阅读量转换
	function tranCount($number){
		$number = intval($number);
		if($number>=100000000){
			$number = $number/100000000;
			$text = "亿";
		}elseif($number>=10000000){
			$number = $number/10000000;
			$text = "千万";
		}elseif($number>=1000000){
			$number = $number/1000000;
			$text = "百万";
		}elseif($number>=10000){
			$number = $number/10000;
			$text = "万";
		}else{
			$text = "次";
		}
		if(strpbrk($number, ".")){
			$pointto = intval(strpos($number, "."))+2;
			$number = substr($number, 0, $pointto);
		}
		$number = $number.$text;
		return $number;
	}
	
	//主持人日志添加
	function  insertHostlog($SerialNo,$RadioID,$rstamp,$hostweibo,$op,$memo){
		$data_array = array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'rstamp' => $rstamp,//时间戳
           'hostweibo' =>$hostweibo,//主持人微博账号
           'op' => $op,//操作码
           'memo'=>$memo
           );
		$root = "InsertIn";
		$info = $this->writeXML($root,$data_array) ;//传给服务器的参数消息
		return $info;
	}
	//主持人日志删除
	function deleteHostLog($SerialNo,$RadioID,$rstamp){
		$data_array = array(
           'SerialNo'=>$SerialNo,
           'RadioID' => $RadioID,
           'rstamp' => $rstamp,//时间戳
          );
		$root = "DeleteIn";
		$info = $this->writeXML($root,$data_array) ;//传给服务器的参数消息
		return $info;
	}
	
	//php解码js中escape的中午
	function unescape($str){   
		$ret = '';   
		$len = strlen($str);   
		for ($i = 0; $i < $len; $i++){   
			if ($str[$i] == '%' && $str[$i+1] == 'u'){   
				$val = hexdec(substr($str, $i+2, 4));   
				if ($val < 0x7f) $ret .= chr($val);   
				else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));   
				else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));   
				$i += 5;   
			}   
			else if ($str[$i] == '%'){   
				$ret .= urldecode(substr($str, $i, 3));   
				$i += 2;   
			}   
			else $ret .= $str[$i];   
		}   
		return $ret;   
	} 

    
//--------------------------------------------- gaomeidi 添加 End 2014.09.10 ------------------------------------

	//热门主持人 - zhanghanbing
    function getPageUrlString_hotHoster($page,$con, $tail,  $max, $opcontent, $query_c="1"){
		global $constant;
		// ��ҳt��
		if($page == 1){
                $page_string.= $constant["pubpage"]["HomePage"].'|'.$constant["pubpage"]["Previous"].'|';
                
		}else if($page == 2){
                $page_string.= '<a href=admin.php?'.$opcontent.'&action=getdata&page=1&con='.$con.'>'.$constant["pubpage"]["HomePage"].'</a>|<a href=admin.php?'.$opcontent.'&action=getdata&page=1&con='.$con.'>'.$constant["pubpage"]["Previous"].'</a>|';
        }
        else{
                $page_string.= '<a href=admin.php?'.$opcontent.'&action=getdata&page=1&con='.$con.'>'.$constant["pubpage"]["HomePage"].'</a>|<a href="javascript:history.back(-1);" style="cursor:pointer;">'.$constant["pubpage"]["Previous"].'</a>|';
        }
        if($tail){
                $page_string .= $constant["pubpage"]["Next"];
        }else{
                $page_string .= '<a href=admin.php?'.$opcontent.'&action=getdata&page='.($page+1).'&con='.$con.'>'.$constant["pubpage"]["Next"].'</a>';
        }
        return $page_string;
    }
    //构造查询新路况输入参数zhb 2014.10.27
    function queryNewRoadCount($SerialNo,$RadioID,$WeiboID,$MaxNo,$MaxIsMark)
    {
    	$data_array = array(
    			'SerialNo'=>$SerialNo,
    			'RadioID' => $RadioID,
    			'WeiboID' => $WeiboID,
    			'MaxNo' =>$MaxNo,
    			'MaxIsMark' => $MaxIsMark,
    	);
    	$root=  "QueryIn";
    	$info= $this->writeXML($root,$data_array) ;//传给服务器的参数消息
    	return $info;
    }
    
    function queryNewRoadRequest($response)
    {
    	$dom = new DOMDocument();
    	$dom->loadXML($response);
    	$infos = $dom->getElementsByTagName("QueryOut");
    
    	foreach ($infos as $info){
    		$OK=$info->getElementsByTagName("OK")->item(0)->nodeValue;//返回代码
    		if ($OK=='00') {
    			$MarkCount=$info->getElementsByTagName("MarkCount")->item(0)->nodeValue;//最新标记数
    
    			$NoCount=$info->getElementsByTagName("NoCount")->item(0)->nodeValue;//[最新路况数]
    			$NewMaxNo=$info->getElementsByTagName("NewMaxNo")->item(0)->nodeValue;//最新标记数
    
    			$NewMaxIsmark=$info->getElementsByTagName("NewMaxIsmark")->item(0)->nodeValue;//[最新路况数]
    
    		}
    		else
    			$ErrorInfo=$info->getElementsByTagName("ErrorInfo")->item(0)->nodeValue;//失败信息
    
    	}
    	$resarray=
    	array(
    			'OK'=>$OK,
    			'ErrorInfo'=>$ErrorInfo,
    			'NoCount'=>$NoCount,
    			'MarkCount'=>$MarkCount,
    			'NewMaxNo'=>$NewMaxNo,
    			'NewMaxIsmark'=>$NewMaxIsmark
    	);
    
    	return $resarray;
    }
    //--------------------------------------------- lichun 添加 topic End 2014.11.05 ------4/4------------------------------
    function transElggTopicgetList($topicList){
    	$index = 0;
    	$number = 0;
    	foreach($topicList as $single){
    		$topicInfo[$index]["ID"]          = $single['guid'];
    		//$weiboInfo[$index]["Sender"]      = iconv("UTF-8","GB2312",$single['owner']['name']);
    		$topicInfo[$index]["Topic_name"]      = $single['topic_name'];
    		$topicInfo[$index]["Description"]      = $single['description'];
    		$topicInfo[$index]["Pic"]   = $single['pic'];
    		//$weiboInfo[$index]["Time"]        = iconv("UTF-8","GB2312",tranTime($single['time_created']));
    		$topicInfo[$index]["Time"]        = tranTime($single['time_created']);
    		//$weiboInfo[$index]["Content"]     = iconv("UTF-8","GB2312",$single['description']);
    		// $str = $this->thewire_filter($single['value']);
    		//$weiboInfo[$index]["Content"]     = $str;
    		//	$weiboInfo[$index]["Content"]     = $single['value'];
    		//$weiboInfo[$index]["originalID"]  = $single['entity_guid'];
    		$topicInfo[$index]["num"]         = $number;
    		//file_put_contents("d:\\zhuchiren.txt","666------:".$topicInfo[$index]['ID'],FILE_APPEND);
    
    		$index++;
    		$number++;
    	}
    	return $topicInfo;
    }
    //--------------------------------------------- lichun 添加 topic End 2014.11.05 ------4/4------------------------------
    
	
}
?>
