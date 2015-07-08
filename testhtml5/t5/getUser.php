<?php
header("Content-Type:text/html; charset=utf-8");//解决与网页编码的冲突
$q=$_GET["q"];
$con=mysql_connect("localhost","root","123456");
mysql_query("set names utf8");//设置字符集编码
if (!$con) {
	die('could not connect:'.mysql_error());//输出消息并退出当前脚本
}
mysql_select_db("test",$con);
$sql="SELECT * FROM roadinfo WHERE roadsearch='".$q."'";
$result=mysql_query($sql);
echo "<table border='1'>
<tr>
<th>id</th>
<th>roadname</th>
</tr>
";

while ($row=mysql_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$row[roadId]."</td>";
	echo "<td>".$row[roadName]."</td>";
	echo "</tr>";
	echo "</table>";
}
mysql_close($con);
?>