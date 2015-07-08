<?php 
class adminmgr{
	var $db='';
	var $language;
	function adminmgr(){
		$this->table_admin='admin';
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
	function update_token($table,$username,$token){
		global $userdb;
		$update="update ".$table." set AccessToken='".$token."' where Name='".$username."'";
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
