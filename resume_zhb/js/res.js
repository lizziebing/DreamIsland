$(function(){ 
	//开启引用日历
    $("#rightTime").append(rightTime);
    startclock();
    });
function turn(index){
	var obj=$("#xingbiao"+index);
	if(obj.attr('title')==0)
	{
		//取消选中状态
		obj.removeClass("xingbiao_b").addClass("xingbiao");
		obj.attr('title',1);
	}
	else
	{
		//选中
		obj.removeClass("xingbiao").addClass("xingbiao_b");
		obj.attr('title',0);
	}	
}