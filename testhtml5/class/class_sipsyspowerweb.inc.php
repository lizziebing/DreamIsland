<?php
class sipsyspowerweb extends sipsysforms{
        var $ip;
        var $debug=0;
        function isvoid($str,$mode=false) {
                $str=trim($str);
                if (strlen($str)==0) return true;
                else if (($mode==true) && ($str=="0")) return true;
                else return false;
        }
        function sipsyspowerweb(){
                //$_SERVER['HTTP_X_FORWARDED_FOR']读取客户端的真实IP
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && eregi("^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$",$_SERVER['HTTP_X_FORWARDED_FOR'])) {
                   $this->ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                }
                else {
                   $this->ip=$_SERVER["REMOTE_ADDR"];
                }
                return true;
        }
        function htmlspecialchars_uni($text){
                $text=preg_replace('/&(?!#[0-9]+;)/si','&amp;',$text);
                return str_replace(array('<','>','"'),array('&lt;','&gt;','&quot;'),$text);
        }
function loadlimit($loadlimit=5){
        $servertoobusy=0;
        global $constant;
        $path='/proc/loadavg';
        if(file_exists($path)) {
                $filesize=filesize($path);
                $filenum=fopen($path,'r');
                $filestuff=@fread($filenum,6);
                fclose($filenum);
        }else { $filestuff='';}
        $loadavg=explode(' ',$filestuff);
        if (trim($loadavg[0])>$loadlimit) {
                $servertoobusy=1;
                $this->error($constant["sipsyspowerweb"][0]);
        }
}
function mymatch($admin='',$name=''){
        if ($admin!="") {
                $usernames=explode(" ",$admin);
                if(in_array($name,$usernames)){ return true;}
        }
        return false;
}
function checkipban($banip=''){
        $banip=trim($banip);
        $ipaddress=$this->ip;
        $addresses=explode(' ',preg_replace("/[[:space:]]+/"," ",$banip) );
        foreach ($addresses AS $val){
                if (strpos(' '.$ipaddress,' '.trim($val))!==false){ $this->error($constant["sipsyspowerweb"][1].$ipaddress.$constant["sipsyspowerweb"][2]);}
        }
}
function getip(){
        return $this->ip;
}
function getarea($ip=""){
        global $constant;
        include_once(SIPSYS_DIR.'/inc/area.inc.php');
        return $from;
}
function getbrowseinfo(){
        global $constant;
        include_once(SIPSYS_DIR.'/inc/browseinfo.inc.php');
        return $browseinfo;
}
function systeminfo(){
        include_once(SIPSYS_DIR.'/inc/systeminfo.inc.php');
        return $os;
}
function getrowbg () {
        global $bgcounter;
        if ($bgcounter++%2==0) { return "firstalt";}
        else { return "secondalt";}
}
function textconvert($d,$h=1,$mode="str") {
        global $db;
        $d=trim($d);
        if($mode=="int"){
                return intval($d);
        }
        if($h==1){
                $d=$this->htmlspecialchars_uni($d);
        }
        if(get_magic_quotes_gpc()) { return $d;}
        else{ return addslashes($d);}
        return $d;
}
function get_input($d,$h=1,$mode="str"){
        $d=$_POST["$d"];$d=trim($d);
        if($mode=="int"){ return intval($d);}
        if($h==1){ $d=$this->htmlspecialchars_uni($d);}
        if(get_magic_quotes_gpc()) { return $d;}
        else{ return addslashes($d);}
        return $d;
}
function msubstr($str,$start,$len) {
        $strlen=$start+$len;
        for($i=0;$i<$strlen;$i++){
                if(ord(substr($str,$i,1))>0xa0){
                        $tmpstr.=substr($str,$i,2);
                        $i++;
                }else{ $tmpstr.=substr($str,$i,1);}
        }
        return $tmpstr;
}
function FixQuotes ($what="") {
   $what=ereg_replace("'","''",$what);
   while (eregi("\\\\'",$what)) {
      $what=ereg_replace("\\\\'","'",$what);
   }
   return $what;
}
function checkNumber($number,$sep=".",$mode=true) {
   $rc =false;
   $num=trim($number);
   if (!$this->isvoid($sep)){
      $num_sep=substr_count($num,$sep);
      if ($num_sep < 2) {
         if ($mode==true) $simple="/[^0-9;\-;\\$sep]/";
         else $simple="/[^0-9;\\$sep]/";
         if (!preg_match($simple,$num)) {
            $pos=strpos($num,'-');
            if ($pos===false) $rc=true;
            else if ($pos==0) $rc=true;
         }
      }
      else if (($mode==true) && (!preg_match('/[^0-9;\-]/',$num)))
         $rc=true;
      else if (!preg_match('/[^0-9]/',$num)) $rc=true;
   }else{
      if (($mode==true) && (!preg_match('/[^0-9;\-]/',$num))) $rc=true;
      else if (!preg_match('/[^0-9]/',$num)) $rc=true;
   }
   return $rc;
}
function checkReference(){
   global $allowedreferer;
   $userref=parse_url($_SERVER["HTTP_REFERER"]);
   $userref=$userref[host];
   $refarr=explode(' ',$allowedreferer);
   if(strlen($allowedreferer)>4 && !in_array($userref,$refarr)){ return false;}
    return true;
}
function Rm_Dir($dir) {
   $current_dir=opendir($dir);
   while($entryname=readdir($current_dir)){
      if(is_dir("$dir/$entryname") and ($entryname !="." and $entryname!="..")){
         $this->Rm_Dir($dir.'/'.$entryname);
      }elseif($entryname !="." and $entryname!=".."){
         unlink($dir.'/'.$entryname);
         if ($this->debug) {
            echo $dir.'/'.$entryname."<br>";
            flush();
         }
      }
   }
   closedir($current_dir);
}
function DBCacheFlush(){
   global $ADODB_CACHE_DIR;
   $this->Rm_Dir($ADODB_CACHE_DIR);
}
function BJstr($first,$second){
if(!$first || !$second) return false;	
if(strcmp($first,$second)==0) return true;
else  return false;	
}
}
