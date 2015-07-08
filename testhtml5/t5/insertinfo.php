<?PHP
header("Content-Type:text/plain; charset=utf-8");

$data_array = 
    array(
    'SerialNo'=>'123456',
    'RadioID' => '0024',
    'hostweibo' => 'gaoqiao.qq.com',
    'Positionname' => '南五马路22222222',
        'Position' => '11110,2220',
         'Type' => '1',
          'ImgUrl' => 'www.baidu.com',
           'Direction' => '由东向西',
           'Situation' => '01',
        'VoiceUrl' => 'www.baidu.com',
       
        'Memo' => '车祸',
      
    );
//  创建一个XML文档并设置XML版本和编码。。
$dom=new DomDocument('1.0', 'utf-8');
 
//  创建根节点
$InsertIn = $dom->createElement('InsertIn');
$dom->appendchild($InsertIn);
 
//foreach ($data_array as $data) {
//  create_item($dom, $data_array);
//}
foreach ($data_array as $key => $val) {
            //  创建元素
            $$key = $dom->createElement($key);
           $InsertIn->appendchild($$key);
 
            //  创建元素值
            $text = $dom->createTextNode($val);
            $$key->appendchild($text);
 
        }
echo $dom->saveXML();
 
$info=$dom->saveXML();



$clint=new SoapClient('http://192.168.139.32/bsys/webservice/webserver.wsdl');
echo '<xmp>';
echo "提供的方法\n";
print_r($clint->__getFunctions());


try {

$clint->InsertRoadInfo($info);
echo $info;
var_dump($clint->InsertRoadInfo($info));//打印服务器端返回的错误信息
echo "添加成功";
//print_r($clint->__saveInter(array()));
}
catch (SoapFault $f)
{
	echo 'error:'.$f -> faultstring; //打印错误信息
	//var_dump($clint->InsertRoadInfoResponse());打印服务器端返回的错误信息
}

function create_item($dom,  $data_array) {
   // if (is_array($data)) {
        foreach ($data_array as $key => $val) {
            //  创建元素
            $$key = $dom->createElement($key);
           $InsertIn->appendchild($$key);
 
            //  创建元素值
            $text = $dom->createTextNode($val);
            $$key->appendchild($text);
 
        }
  //  }   //  end if
}   //  end function
?> 