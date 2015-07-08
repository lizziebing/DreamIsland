<?php
//error_reporting(E_ALL);
//端口111
//本地
//创建 TCP/IP socket
/*$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
    echo "socket创建失败原因: " . socket_strerror($socket) . "\n";
} else {
    echo "OK，HE HE.\n";
}*/
function uploadImg($file){
//     $service_port = "4041";
   $service_port = "4040"; 
    $address = '10.200.143.194';
    $fp = fsockopen( $address, $service_port);
    if (!$fp) {
        return 0;
    } else {
        $str = "*********";
        $out = file_get_contents($file);
        if($out){
            fwrite($fp, $out);
            fwrite($fp, $str);
        //　echo "上传成功";
        }
        $url=fgets($fp,1000);
        fclose($fp);
    }
    return $url;
}
function transtoamr($src,$type){
	$temp=pathinfo($src);	
	$name=$temp["basename"];//文件基本名
	$dir=$temp["dirname"];//文件所在的文件夹
	$extension=$temp["extension"];//文件扩展名
	
	
	file_put_contents("/home/zcr.txt",$name."0*******url\n",FILE_APPEND);
	file_put_contents("/home/zcr.txt",$extension."1*******url\n",FILE_APPEND);
	$filename=$src;
	$fn=explode(".".$extension, $name);
	$savepath="{$dir}/phone_{$fn[0]}";//保存路径
	$newfilename=$savepath.'.amr';
if ($type=='wav') {
	
	$cmd="ffmpeg -i ".$filename." -acodec libamr_nb -ab 12.2k -ar 8000 -ac 1 ".$newfilename;
}else if($type=='mp3'){
	
	$cmd="ffmpeg -i ".$filename." -ac 1 -ar 8000 ".$newfilename;
}
file_put_contents("/home/zcr.txt",$cmd."*******cmd\n",FILE_APPEND);
file_put_contents("/home/zcr.txt",$type."*******type\n",FILE_APPEND);
	if ($cmd) {
		exec($cmd,$out,$status);
				if($status=='0')
					{
						file_put_contents("/home/zsc.txt",$savepath."*******savepath\n",FILE_APPEND);
						return $savepath;
					}else{
						file_put_contents("/home/zsc.txt","0*******turnerror\n",FILE_APPEND);
						return '0';
					}
	}
// 	// 	$mp3filename=str_replace('amr','mp3',substr($filename, strrpos($filename, "/")+1));
// 	$mp3filename=$name.'.mp3';
// // 	$newfilename="/var/www/".$mp3filename;
	
// 	if(file_exists($newfilename))
// 	{
		
// 		return urlencode("http://42.121.34.216/$mp3filename");
// 	}else{
// 		$cmd="ffmpeg -i $filename $newfilename";
// 		file_put_contents("/home/zsc1.txt",$cmd."*******cmdurl\n",FILE_APPEND);
// 		exec($cmd,$out,$status);
// 		if($status=='0')
// 		{
// 			file_put_contents("/home/zsc1.txt",urlencode("http://42.121.34.216/$mp3filename")."*******url\n",FILE_APPEND);
// 			return urlencode("http://42.121.34.216/$mp3filename");
// 		}else{
// 			file_put_contents("/home/zsc1.txt","0*******url\n",FILE_APPEND);
// 			return '0';
// 		}
// 	}
}
function judgetype($fileName, $fileExt)
{
	$_fileFormats = Array(
	'amr' => '2321414D52',
	'mp3' => '494433',			
	);
	// 文件格式未知
	if (!isset($_fileFormats[$fileExt]))
	{
		return false;
	}
	$length = strlen($_fileFormats[$fileExt]);
	file_put_contents("/home/zsc.txt","0*******length\n".$length."\n",FILE_APPEND);
	//读取文件头信息
	$file = fopen($filePath, "rb");
	$bin = fread($file, $length);
	file_put_contents("/home/zsc.txt","0*******bin\n".$bin."\n",FILE_APPEND);
	fclose($file);
		
	
	$fileHead = @unpack("H{$length}", $bin);
	file_put_contents("/home/zsc.txt","0*******fileHead[1]\n".$fileHead[1]."\n",FILE_APPEND);
	// 判断文件头
	if (strtolower($_fileFormats[$fileExt]) == $fileHead[1])
	{
		return true;
	}
	return false;

}
?>
