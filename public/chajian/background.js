/*
 * background.js 是当浏览器被打开时调用的，只要浏览器不关，这个程序就有效
 */

//alert("background.js 被调用了");

// 获取目标图片的 url
function showValidImages(data) 
{
	//alert("你按下了 采集图片 按钮");
	// 往 content_script 发消息，操作页面元素
	chrome.tabs.query({active:true, currentWindow:true}, function(tabs){
		var tab = tabs[0];
		chrome.tabs.sendMessage(tab.id, {msg:'getImages'}, function(response){});
	});
}




// 主程序
chrome.contextMenus.create({
  title               : '图片采集',
  contexts            : [ 'all' ],
  documentUrlPatterns : [ 'http://*/*', 'https://*/*' ],
  onclick             : showValidImages
});

chrome.browserAction.onClicked.addListener(
	function(tab) {
		//alert("aaa");
		// 往 content_script 发消息，操作页面元素
		chrome.tabs.query({active:true, currentWindow:true}, function(tabs){
			var tab = tabs[0];
			chrome.tabs.sendMessage(tab.id, {msg:'getImages'}, function(response){});
		});
	});
