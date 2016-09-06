var select_num=0;
function chageStatus(){
				select_num=$('.item-selected').length;
				if(select_num){
					$('.dtj-multi-noti').css('display','block');
					$('.footer').css('display','block');
					$('.dtj-multi-noti').find('b').text(select_num);
				}else{
					$('.dtj-multi-noti').css('display','none');
					$('.footer').css('display','none');
				}
			}
function fun(ele)
{

	if(	ele.getElementsByTagName("text")[0].innerText=="已选择" )
	{
		ele.className='HUABAN-cell item-hover';
					
		ele.getElementsByTagName("text")[0].innerText="未选择";
		ele.getElementsByTagName("div")[1].style.backgroundPosition="0 0";
		chageStatus()
	}
	else
	{
		if(select_num<5){
		
						ele.className='item-selected HUABAN-cell item-hover';						
						ele.getElementsByTagName("div")[1].style.backgroundPosition="0 -40px";
						select_num=$('.item-selected').size();
						chageStatus();
					}else{
					
						var _html=$('.dtj-multi-noti').html();
						$('.dtj-multi-noti').html('<p style="color:red">最多只能选择五张图片或者视频</p>');
						setTimeout(function(){
							$('.dtj-multi-noti').html(_html);
						},1000)

					}
	}

	
}
function funClose()
{
	//alert("您已经按下了关闭按钮");
	var widE = document.getElementById("HUABAN_WIDGETS");
	document.body.removeChild(widE);
	//alert("ok");
}