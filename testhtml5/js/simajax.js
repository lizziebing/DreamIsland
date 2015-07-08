var xmlHttp;
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	{
		//firefox,opera8.0+,safari
		xmlHttp=new XMLHttpRequest();
		
	}
	catch(e)
	{//internet explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
function stateChange()
{
	if(xmlHttp.readyState==4||xmlHttp.readyState=="complete")
	{
		document.getElementById("texthint").innerHTML=xmlHttp.responseText;
	}
}
function showUser(str)
{
	xmlHttp=GetXmlHttpObject();
	if(xmlHttp==null)
	{
		alter("Browser does not support Http request");
		return;
	}
	var url="getUser.php";
	url=url+"?q="+str;
	url=url+"&sid="+Math.random();//添加一个随机数，以防服务器使用缓存的文件
	xmlHttp.onreadystatechange=stateChange;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}