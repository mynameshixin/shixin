function fun(ele)
{
	if(	ele.getElementsByTagName("text")[0].innerText=="已选择" )
	{
		ele.getElementsByTagName("text")[0].innerText="未选择";
		ele.getElementsByTagName("div")[1].style.backgroundPosition="0 0";
	}
	else
	{
		ele.getElementsByTagName("text")[0].innerText="已选择";
		ele.getElementsByTagName("div")[1].style.backgroundPosition="0 -40px";
	}
}
function funClose()
{
	//alert("您已经按下了关闭按钮");
	var widE = document.getElementById("HUABAN_WIDGETS");
	document.body.removeChild(widE);
	//alert("ok");
}