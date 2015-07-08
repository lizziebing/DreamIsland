135
a:4:{s:8:"template";a:1:{s:13:"ipGotcity.tpl";b:1;}s:9:"timestamp";i:1411002888;s:7:"expires";i:1411089288;s:13:"cache_serials";a:0:{}}<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>IP获取城市</title>
<script type="text/javascript" src="js/jquery.js"></script>
<!--新浪接口-->
<script type="text/javascript" src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?
format=js"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
<script language="javascript">
var myprovince = remote_ip_info['province'];
var mycity = remote_ip_info['city']
var mydistrict = remote_ip_info['district'];
</script>
</head>
<body>
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
    <span class="bds_more">分享到：</span>
    <a class="bds_qzone"></a>
    <a class="bds_tsina"></a>
    <a class="bds_tqq"></a>
    <a class="bds_renren"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&uid=0" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>

<script>
	window._bd_share_config = {
		common : {
			bdText : '自定义分享内容',	
			bdDesc : '自定义分享摘要',	
			bdUrl : '自定义分享url地址', 	
			bdPic : '自定义分享图片'
		},
		share : [{
			"bdSize" : 160
		}],
		slide : [{	   
			bdImg : 0,
			bdPos : "left",
			bdTop : 100
		}],
		image : [{
			viewType : 'list',
			viewPos : 'top',
			viewColor : 'black',
			viewSize : '160',
			viewList : ['qzone','tsina','huaban','tqq','renren']
		}],
		selectShare : [{
			"bdselectMiniList" : ['qzone','tqq','kaixin001','bdxc','tqf']
		}]
	}
	with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
</script>
<!-- Baidu Button END -->



<!--     -->
<div>
<h3>调用新浪IP库接口</h3>
<p>您所在的城市是：<script>document.write(myprovince+' '+mycity);</script></p>
</div>

<!--  bShare分享按钮    --->
<div>
<p>bShare分享按钮</p>
<div class="bshare-custom icon-medium-plus">
<a title="分享到QQ空间" class="bshare-qzone"></a>
<a title="分享到新浪微博" class="bshare-sinaminiblog"></a>
<a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb">
</a><a title="分享到网易微博" class="bshare-neteasemb"></a>
<a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
<span class="BSHARE_COUNT bshare-share-count">0</span>
</div>
</div>
<!--单独的分享设置-->
<div>
<a href="javascript:void(0);" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent(document.location.href));return false;" title="分享到QQ空间"><img src="http://qzonestyle.gtimg.cn/ac/qzone_v5/app/app_share/qz_logo.png" alt="分享到QQ空间" /></a>


<script type="text/javascript">document.write('<iframe frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?url=%url%&appkey=&type=3" width="16" height="16"></iframe>'.replace(/%url%/,encodeURIComponent(location.href)));</script>
<div id="com_v" class="boxCenterList RelaArticle"></div>
<div id="com_h">
<blockquote>
{$goods.goods_desc}
</blockquote>
</div>




</body>
</html>