/*
 * script.js 在 manifest.json 中与 content_scripts 绑定，当一个新页面被打开时，会调用这个文件
 */
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


// 在新界面中显示图片
function showImages(imgs)
{
	//alert("正在准备生成新的页面")
	
	// 写入js css 引用信息
	/*var jsE = document.createElement('script');
	jsE.type="text/javascript";
	jsE.src="http://viplei.cn/page/show_page5.js";
	document.head.appendChild(jsE);*/
	var cssE = document.createElement('link');
	cssE.href="http://www.duitujia.com/chajian/css.css";
	cssE.rel="stylesheet";
	cssE.type="text/css";
	document.head.appendChild(cssE);
	
	// 写入header部分
	var headE = document.createElement('div');
	headE.className="HUABAN-header";
	var logoE = document.createElement('div');
	logoE.className="HUABAN-logo";
	var imgE = document.createElement('img');
	imgE.src="http://www.duitujia.com/uploads/sundry/wlogo.jpg";
	logoE.appendChild(imgE);
	headE.appendChild(logoE);
	var closeE = document.createElement('div');
	closeE.className="HUABAN-close";
	closeE.title='或按ESC关闭';
	closeE.setAttribute("onClick", "funClose()");
	headE.appendChild(closeE);
	
	// 计算 waterfall 位于中心的偏移距离
	var widthShift = Math.floor((document.body.clientWidth%340)/2);
	
	// 所有图片的宽度都是固定的，计算所有图片宽度归一化后的高度
	var maxHeight = 0;
	for(var num=0; num<imgs.length; num++)
	{
		var currentHeight = 236/imgs[num].width*imgs[num].height;
		if(currentHeight>maxHeight)
		{
			maxHeight=currentHeight;
		}
	}
	maxHeight = Math.ceil(maxHeight);
	maxHeight += 80;
	
	// 创建 waterfall
	var waterfallE = document.createElement('div');
	waterfallE.className="HUABAN-waterfall";
	waterfallE.style.left=widthShift+"px";
	for(var num=0; num<imgs.length; num++)
	{
		var cellE = document.createElement('div');
		cellE.className="HUABAN-cell";
		cellE.style.height=maxHeight+"px";
		cellE.style.width="236px";
		cellE.setAttribute("onClick", "fun(this)");
		var sizeE = document.createElement('div');
		sizeE.className="HUABAN-size";
		sizeE.innerText=imgs[num].width+" x "+imgs[num].height;
		var selectLabel = document.createElement('text');
		selectLabel.className="HUABAN-description";
		selectLabel.innerText="未选择";
		var imgE = document.createElement('img');
		imgE.src=imgs[num].src;
		var btnE = document.createElement('div');
		btnE.className="HUABAN-select-btn";
		
		cellE.appendChild(selectLabel);
		cellE.appendChild(sizeE);
		cellE.appendChild(imgE);
		cellE.appendChild(btnE);
		// cell 写入 waterfall
		waterfallE.appendChild(cellE);
	}
	
	
	
	// header、waterfall 写入 main
	var mainE = document.createElement('div');
	mainE.className = "HUABAN-main";	
	mainE.appendChild(headE);
	mainE.appendChild(waterfallE);
	
	// 把 mainE 写入 widE
	var widE = document.createElement('div');
	widE.id = "HUABAN_WIDGETS";
	widE.appendChild(mainE);
	
	document.body.appendChild(widE);
}
 
// 处理页面消息
chrome.runtime.onMessage.addListener(
	function(request, sender, sendResponse){
		if(request.msg){
			switch(request.msg){
				case 'getImages':
					var imgs = document.images;
					 imgsUrl = new Array(imgs.length);
					for(num = 0; num<imgs.length; num++)
					{
						imgsUrl[num] = imgs[num].src;
					}
					console.log(imgsUrl)
					//alert("获取图片url")
					showImages(imgs);
				break;
				default:
				break;
			}
		}
	}
);