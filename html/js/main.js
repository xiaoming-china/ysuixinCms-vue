$(document).ready(function() {
	var document_height = $(window).height();
	$('.main-content .left-nav,.zTreeDemoBackground').css({"height":document_height});//将左侧导航设为浏览器高度
	$('#iframe-main').css({"height":document_height - 58});//将主内容区设为浏览器高度加上头部距离
	//滚动条美化
	// $("iframe,html").niceScroll({
	// 	cursorcolor: "#006699", // 改变滚动条颜色，使用16进制颜色值
	// });

	
	//页头nav
	$('.nav-list>ul>li').click(function(){
		$(this).addClass('on').siblings().removeClass('on');
	});
	//左侧导航点击事件
	$('.parent-nav-item>span').click(function(event) {
		var text = $(this).find('s').text();
		var selected = $(this).attr('is-selected');
		if(selected == 'true'){
			$(this).attr("is-selected", 'false');
			$(this).next('.sub-nav-item').css({"display":'none'});
			$(this).find('s').removeClass('icon-minus').addClass('icon-plus');
		}else{
			$(this).attr("is-selected", 'true');
			$(this).next('.sub-nav-item').css({"display":'block'});
			$(this).find('s').removeClass('icon-plus').addClass('icon-minus');
		}
	});
	//左侧菜单点击事件
	$('.sub-nav-item>a').click(function(event) {
		 event.preventDefault();
		 var href = $(this).attr('href');
		 $('#iframe-main').attr('src',href);
	});
	//全选 or 取消全选
	$('.J_check_all').click(function(event) {
		if(this.checked){ 
			$(".J_check_all").attr('checked', true);
	        $("input[name='checkname']").attr('checked', true);
	    }else{
	    	$(".J_check_all").attr('checked', false);
	        $("input[name='checkname']").attr('checked', false);
	    } 
	});





});
//ajax提交
function ajax_submit(form){
	$(form).ajaxSubmit({
	  dataType:"json",
      success:function(data){
      	alert(data);
   //        if( data.code = 200 ){

			// setTimeout(function () {
			// 	d.close().remove();
			// }, 2000);
          	
   //        }else{

   //        }
      }
    }); 
}
//清除页面错误提示 $('.p-error-info')
function clear_error(){
	var obj = $('.p-error-info');
	if(obj.text() != ''){
		setTimeout(function () {
			obj.text('');
		}, 1500);
	}

}
