<?php
class admininfo extends sipsysforms{
        var $db='';
        var $table_admin='admin';
        var $table_adminonline='adminonline';
		var $table_userset="UserSet";
        var $ErrorMsg='';
        var $adminstatus=array();
        var $mytime=0;
        var $table_domain="domain";
        function admininfo($db=0){
                GLOBAL $timestamp;
                $this->setcookie("lastactive",$timestamp);
                if(isset($_COOKIE["admin"]) && isset($_COOKIE["adminhash"]) && $_COOKIE["adminhash"]!="Outed"){
                        $cookieinfo=$this->endecrypt($_COOKIE["adminhash"],$_COOKIE["admin"],"de");
                        $Uarray=explode("|:|",$cookieinfo);
                        $username="$Uarray[0]";
                        $password="$Uarray[1]";
                        $this->checkuser($username,$password,0);
                        return TURE;
                }
                return false;
        }
        function checkuser($username="",$password="",$isencrypt){
                global $timestamp;
                global $constant;
                $this->adminstatus=$_SESSION['adminstatus'];
                if(!isset($_SESSION['adminstatus'])){                	    
                        global $userdb;
                        $sql="SELECT name,password FROM ".$this->table_admin." where name='$username'";
                        $result=$userdb->Execute($sql);  
						//$sql_userset="SELECT UserName,Password FROM ".$this->table_userset." where UserName='$username'";
                        //$result_userset=$userdb->Execute($sql_userset);                                        
                        if($isencrypt){
                        	if($result->fields[1]==substr(md5($password),8,16)) $pwresult=true;
                        	else $pwresult=false;
                        }else{                        	
                        	if($result->fields[1]==$password) $pwresult=true;
                        	else $pwresult=false;
                        }                         
                           if(!$result->EOF &&$pwresult){                             	                   
                                //if($result->fields[1])$this->error($constant["admininfo"][0]);//Ȩ�޴������ѱ���
                                if(strlen($result->fields[0])<2) $this->error($constant["admininfo"][1]);//�û������,�û�����С��2���ַ�
                                $userstatus=array();
                                $userstatus['admin_hostername']=$result->fields[0];
                                $userstatus['hosterpassword']=$result->fields[1];
                                $userstatus['loginstatus']=TRUE;
                                //$userstatus['domain']=$this->getdomain();
                                $_SESSION['adminstatus']=$userstatus;
                                $this->adminstatus=$userstatus;
                                //$this->updateinfo();
                                return true;
							
						}else{                        	
                                return false;
                        }
                }else{
                        $this->adminstatus=$_SESSION['adminstatus'];
                }
                 $result->close();
                 $userdb->Close();
                return false;
        }
        function checkpassword($userid="",$password=""){
                global $userdb;
                $password=substr(md5($password),8,16);
                $sql="SELECT password FROM ".$this->table_admin." WHERE name=$userid";
                $result=$userdb->Execute($sql);
                if($result && !$result->EOF){
                        if($userid==$result->fields[0] && $password==$result->fields[0]){
                                return true;
                        }
                }
                $result->close();
                $userdb->Close();
                return false;
        }
        function getemail(){
                return $this->adminstatus['adminemail'];
        }
        function getloginstatus(){
                return $this->adminstatus['loginstatus'];
        }
        function getname(){
                return $this->adminstatus['admin_name'];
        }
        function getallinfo($name){
                global $userdb;
                $info=array();
                $sql="SELECT * FROM ".$this->table_admin." where name='$name'";
                $result=$userdb->Execute($sql);
                if(!$result->EOF){
                        $info=$result->FetchRow();
                        return $info;
                }
                $result->close();                
                return false;
        }
        function getdomain(){
                global $userdb;               
                $sql="SELECT domain FROM ".$this->table_domain." where admin='1'";
                $result=$userdb->Execute($sql);
                if(!$result->EOF){
                        $info=$result->fields[0];
                        return $info;
                }
                $result->close();                
                return false;
        }
        function updateinfo(){
                global $userdb,$logintimeout,$REMOTE_ADDR,$timestamp;
                if($logintimeout<1) $logintimeout=12;
                if(!isset($_SESSION['islogin'])){
                        $_SESSION['islogin']=1;
                        //updae logintimes
                        $sql="UPDATE ".$this->table_admin." SET logintime=logintime+1 WHERE name='".$this->adminstatus['admin_name']."'";
                        //insert into online login record                       
                        $sql1="insert into ".$this->table_adminonline." (username,lastloginIP,lasttime) values('".$this->adminstatus['admin_name']."', '".$_SERVER["REMOTE_ADDR"]."','".$timestamp."' )";
                        if(!$userdb->Execute($sql)||!$userdb->Execute($sql1)){
                            $this->error($constant["admininfo"][3].$userdb->ErrorMsg()."");  //�û���ݸ��´���
                        }
                        if(!empty($_COOKIE["lastactive"])){
                                $lvisit=$_COOKIE["lastactive"];
                        }else{
                           $lvisit=$timestamp;
                        }
                        $this->setcookie('lastvisit',$lvisit);
                }else{
                    //updae logintimes
                    $sql="UPDATE ".$this->table_adminonline." SET  lastloginIP='".$_SERVER["REMOTE_ADDR"]."',lastime='".$timestamp."' WHERE username='".$this->adminstatus['admin_name']."'";
                    if(!$userdb->Execute($sql)){
                       $this->error($constant["admininfo"][3].$db->ErrorMsg()."");  //�û���ݸ��´���
                    }
                }                               
                return;
        }
        function setcookie($name='',$value="",$cookieday="365") {
                global $cookiepath,$timestamp; //$cookiepath='/'
                if ($cookieday>0) {
                        $expire=$timestamp+86400*$cookieday;
                } else {
                   $expire=0;
                }
                setcookie($name,$value,$expire,$cookiepath);

        }
        function endecrypt ($pwd,$data,$case) {
                if ($case=='de') {
                        $data=urldecode($data);
                }
                $key[]="";
                $box[]="";
                $temp_swap="";
                $pwd_length=0;
                $pwd_length=strlen($pwd);
                for ($i=0;$i < 255;$i++) {
                        $key[$i]=ord(substr($pwd,($i % $pwd_length)+1,1));
                        $box[$i]=$i;
                }
                $x=0;
                for ($i=0;$i < 255;$i++) {
                        $x=($x+$box[$i]+$key[$i]) % 256;
                        $temp_swap=$box[$i];
                        $box[$i]=$box[$x];
                        $box[$x]=$temp_swap;
                }
                $temp="";
                $k="";
                $cipherby="";
                $cipher="";
                $a=0;
                $j=0;
                for ($i=0;$i < strlen($data);$i++) {
                        $a=($a+1) % 256;
                        $j=($j+$box[$a]) % 256;
                        $temp=$box[$a];
                        $box[$a]=$box[$j];
                        $box[$j]=$temp;
                        $k=$box[(($box[$a]+$box[$j]) % 256)];
                        $cipherby=ord(substr($data,$i,1)) ^ $k;
                        $cipher.=chr($cipherby);
                }
                if ($case=='de') {
                        $cipher=urldecode(urlencode($cipher));
                } else {
                        $cipher=urlencode($cipher);
                }
                return $cipher;
        }
        function login($name,$password,$case,$cookieday=0,$lang='cn'){
                session_unset();               
                if($case==1){
                   $password=substr(md5($password),8,16);
                }               
                $check=0;
                $check=$this->checkuser($name,$password,$case);
                if($check){
                	   
                        $cookieinfo="";
                        $cookieinfo=$this->endecrypt($password,"$name|:|$password","en");
                        $this->setcookie("adminuser",$cookieinfo,$cookieday);
                        $this->setcookie("adminhash",$password,$cookieday);
                        return TRUE;
                }                
                return FALSE;
        }
         function setLanguge($lang='cn'){                             
                $_SESSION['cn']=$lang;                
        }
        function logout(){
                global $userdb;
                session_unset();
                //$sql="DELETE FROM  ".$this->table_adminonline." WHERE username='".$this->adminstatus['admin_name']."'";
               // $result=$userdb->Execute($sql);
                $this->setcookie("adminuser",'Outed');
                $this->setcookie("adminhash",'Outed');
                //$result->close();                
                return;
        }

}
