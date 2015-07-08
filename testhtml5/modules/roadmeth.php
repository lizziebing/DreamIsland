<?php
namespace roadmeth;
require("function.php");
class roadmeth {
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
}

?>