
var timerID = null;  
var timerRunning = false;  
function stopclock (){  
    if(timerRunning)  
        clearTimeout(timerID);  
    timerRunning = false;
}  
function startclock () {  
    stopclock();  
    showtime();
}  
function showtime () {  
    var now = new Date();  
    var hours = now.getHours();  
    var minutes = now.getMinutes();  
    var seconds = now.getSeconds();  
    var timeValue = ""+hours;  
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes ; 
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds  ;
    //document.clock.thetime.value = timeValue;  
    document.getElementById('nowtime').innerHTML = timeValue;
    timerID = setTimeout("showtime()",1000);  
    timerRunning = true;
}
function is_leap(year) { 
       return (year%100==0?res=(year%400==0?1:0):res=(year%4==0?1:0));
} //是否为闰年

var nstr=new Date(); //当前Date资讯
var ynow=nstr.getFullYear(); //年份
var mnow=nstr.getMonth(); //月份
var smnow=nstr.getMonth()+1;
var dnow=nstr.getDate(); //今日日期
var n1str=new Date(ynow,mnow,1); //当月第一天Date资讯

var firstday=n1str.getDay(); //当月第一天星期几

var m_days=new Array(31,28+is_leap(ynow),31,30,31,30,31,31,30,31,30,31); //各月份的总天数

var tr_str=Math.ceil((m_days[mnow] + firstday)/7); //表格所需要行数
var rightTime = "";
//打印表格第一行（有星期标志）
rightTime = "<table align='center' width='240px' height='35px' style='font-size:16px;font-family:Microsoft YaHei'><tr><td align='center'width='70px'>"+ynow+"&nbsp;年</td><td width='80px' align='left'>"+smnow+"&nbsp;月</td><td align='right'style='padding-right:9px;letter-spacing:2px'id='nowtime'></td></tr></table>";
rightTime += "<table align='center' width='240px' style='border-spacing:5px;line-height:24px'cellspacing='0' style='font-family:Microsoft YaHei'><tr><td align='center'>日</td><td align='center'>一</td><td align='center'>二</td><td align='center'>三</td><td align='center'>四</td><td align='center'>五</td><td align='center'>六</td></tr>";

for(i=0;i<tr_str;i++) { //表格的行
    document.write("<tr>");
    for(k=0;k<7;k++) { //表格每行的单元格
        idx=i*7+k; //单元格自然序列号
        date_str=idx-firstday+1; //计算日期
        (date_str<=0 || date_str>m_days[mnow]) ? date_str="&nbsp;" : date_str=idx-firstday+1; //过滤无效日期（小于等于零的、大于月总天数的）
        //打印日期：今天底色为红
        if(date_str < dnow){
            rightTime += "<td align='center' style='color:#69a155'>" + date_str + "</td>";
        }else if(date_str == dnow){
            rightTime += "<td align='center' style='color:#25690c;border-width:1px;border-style: solid;border-color:#25690c;'><b>" + date_str + "</b></td>";
        }else{
            rightTime += "<td align='center'>" + date_str + "</td>";
        }
    }
    rightTime += "</tr>"; //表格的行结束
}

rightTime += "</table>"; //表格结束

