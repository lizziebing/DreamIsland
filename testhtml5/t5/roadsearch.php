<?php
$list=array("东北","东大","东南大学");
echo json_encode($list);
print_r("测试") ;


/////////////搜索框提示////////////////////
//与数据库建立连接
//$mysqli=new mysqli("localhost","root","123456","test");
//if (mysqli_connect_errno()) {
//	echo '连接失败';
//	echo mysqli_connect_error();
//}
//
////echo '连接mysql成功';
////echo '连接数据库成功';
//
////$link=mysql_connect("localhost","root","123456")or die('连接失败：'.mysql_error());
//
////mysql_connect("localhost","root","root");
////mysql_select_db('test')or die('不能选定数据库test'.mysql_error());
//
///////////////////数据库测试////////////////////
//$mysqli->query("set names utf8");//设置字符集编码
////$result = mysql_query("SELECT roadName FROM roadinfo WHERE roadsearch='DLQ'");
//$result=$mysqli->query("SELECT roadName FROM roadinfo WHERE roadsearch='DLQ'");
//echo '相关路名：';
//echo '<ol>';
//while (list($roadName)=$result->fetch_row()) {
//echo '<li>'.$roadName.'</li>';	
//}
//echo '</ol>';
//$result->close();
//$v=$_POST[value];
////$re=$mysqli->query("select roadName from roadinfo where roadName like '%$v%' order by addtime desc limit 10");
////select title from ".$cfg_dbprefix."archives where title like '%".$keywords."%' order by click desc limit 0,9;
//$re=$mysqli->query("select roadName from roadinfo where roadName like '%$v%' order by click desc limit 0,9");
///*if(mysql_num_rows($re)<=0) exit('0');
//echo '<ul>';
//while($ro=mysql_fetch_array($re)) echo '<li><a href="">'.$ro[title].'</a></li>';
//echo '<li><a href="javascript:;" onclick="$(this).parent().parent().parent().fadeOut(100)">关闭</a& amp; gt;</li>';
//echo '</ul>';
//*/
////////////////////////////////////////////////
//$mNums = mysql_num_rows($re);
//    //echo $mNums;
//    $row=mysql_fetch_array($re);
//    if($mNums<1){
//        echo "no";
//        exit();
//    }else if($mNums==1){
//        echo "[{'keywords':'".iconv_substr($row['roadName'],0,14,"utf8")."'}]";
//    }else{
//        $res="[{'keywords':'".iconv_substr($row['roadName'],0,14,"utf8")."'}";
//        while($row=mysql_fetch_array($res)){
//            $res.=",{'keywords':'".iconv_substr($row['roadName'],0,14,"utf8")."'}";
//        }
//        $res.=']';
//        echo $res;
//    }
//    mysql_free_result($re);
?>