$(document).ready(function() {
	var document_height = $(window).height();
	$('.main-content .left-nav,.zTreeDemoBackground').css({"height":document_height});//将左侧导航设为浏览器高度
	$('#iframe-main').css({"height":document_height - 58});//将主内容区设为浏览器高度加上头部距离
	//滚动条美化
	$("iframe,html").niceScroll({
		cursorcolor: "#006699", // 改变滚动条颜色，使用16进制颜色值
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
//loding 加载动画
var loader = {
    ball: {
        show: function () {
            if ($('.loading')[0]) {
                return
            }
            var modalContainer = document.body;
            $(modalContainer).append(
                '<div class="loading ivu-spin ivu-spin-fix ivu-spin-show-text">'+
                    '<div class="ivu-spin-main">'+
                        '<span class="ivu-spin-dot"></span>' +
                        '<div class="ivu-spin-text">' +
                            '<div class="loader">' +
                                '<svg viewBox="25 25 50 50" class="circular">' +
                                    '<circle cx="50" cy="50" r="17" fill="none" stroke-width="2" stroke-miterlimit="10" class="path"></circle>' +
                                '</svg>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>'
            );
        },
	    hide: function () {
	        $('.loading').remove();
	    }
    }
};
function $ajax(url, postData, type, succCallback, errorCallback,loading){
    var type = type || "post";
    if(loading != undefined && loading == false){
        var loading = false;
    }else{
        var loading = true;
    }
    $.ajax({
        type: type,
        url: url,
        data: postData,
        dataType: "json",
        beforeSend: function(){ 
            if(loading){
                loader.ball.show();//开始loading 
            }
        },
        complete: function(xhr, textStatus) {
            if(loading){
               loader.ball.hide(); //结束loading
            }
        	if(xhr.status != 200){
        		var vueInstance = new Vue({el: '#app'});// 挂载vue实例到DOM节点
        		vueInstance.$Message.error("请求失败,服务器错误");
        		return;
        	}
   			//301：永久重定向/转移
			// 302:临时重定向/转移
			// 304：本次获取的内容是读取的缓存
			// 400：客户端->服务器的参数错误
			// 401：无权限访问
			// 404：访问地址不存在
			// 500：未知的服务器错误
			// 501：服务器超负荷
        },
        success: function(res,textStatus,xhr){
            if(res.status == 1){
                if(succCallback){
                    succCallback(res);
                }                       
            }else{
                if(errorCallback){
                    errorCallback(res);
                }
            }                   
        }
    });
    //退出
    $('#logout').click(function(){
        $ajax(
            '/admin/public/logout',
             '', 
             'post',
              function(res){
                localStorage.clear()
                location.href = '/admin/public/login';
              }, 
              function(res){
                console.log('服务器错误');
              }
        );
    })
}

