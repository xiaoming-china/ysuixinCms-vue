//固定元素
$(document).ready(function($) {
	$('.emjoy').click(function(event){
		var length = $('emjoy-box > img').length;
		$('.emjoy-box >img').remove();//清除全部表情
		if(length <= 0){
			var emjoy = '';
			for (var i = 1; i <= 75; i++) {
			 emjoy += '<img class="emjoy-img" src = "/Public/Home/img/emjoy/'+i+'.gif" alt="[emjoy:'+i+']"/>';
			}
		    $('.emjoy-box').append(emjoy).show();
		}
	});
});

//加载更多
$('.load-more').click(function(event) {
  var html = $(this).html();
  var info = $(this).attr('data-info');
  $(this).attr('disabled', true);
  $(this).html(info);
});
$(document).ready(function(){
		//表情
		$('.emjoy').click(function(event){
			var length = $('emjoy-box > img').length;
			$('.emjoy-box >img').remove();//清除全部表情
			if(length <= 0){
				var emjoy = '';
				for (var i = 1; i <= 75; i++) {
				 emjoy += '<img class="emjoy-img" src = "/Public/Home/img/emjoy/'+i+'.gif" alt="[emjoy:'+i+']"/>';
				}
			    $('.emjoy-box').append(emjoy).show();
			}
		});
		//表情点击事件
		$(document).on('click', '.emjoy-box > img', function() {
		  var content  = $('textarea[name="comment_content"]').val();
		  var addEmjoy = $(this).attr('alt');
		  var newVal   = content + addEmjoy;
		  $('textarea[name="comment_content"]').val(newVal);
		  $('.emjoy-box').hide();//隐藏表情
		});
});
//二级导航动画效果
$(document).ready(function() {
	$(window).scroll(function () {
		var height = $('.pin').height();
		var width  = $('.pin').width();
		var top    = $(document).scrollTop();

		if(top > height){
			$('.pin').css({
				position: 'fixed',
				width:width,
			});
			$('.pin').addClass('animated Fading Entrances fadeInDown');
		}else{
			$('.pin').css({
				position: ''
			});
			$('.pin').removeClass('animated Fading Entrances fadeInDown');
		}
	});

	//留言点击
	$('.container').on('click', '.message-box', function(event) {
	    event.preventDefault();
	    if($(this).find('.message-reply-box').is(":hidden")){
	      $('.message-reply-box').hide();
	      $(this).find('.message-reply-box').show();//如果元素为隐藏,则将它显现
	    }else{
	      $('.message-reply-box').hide();
	      $(this).find('.message-reply-box').hide();//如果元素为显现,则将其隐藏
	    }
	});
	//友情链接效果
	$('.container').on('click', '.friends-box', function(event) {
	    if($(this).find('.friends-reply-box').is(":hidden")){
	      $('.friends-reply-box').hide();
	      $(this).find('.friends-reply-box').show();//如果元素为隐藏,则将它显现
	    }else{
	      $('.friends-reply-box').hide();
	      $(this).find('.friends-reply-box').hide();//如果元素为显现,则将其隐藏
	    }
	});
    //分类点击事件
    $(document).on('click', '.type-list', function(event) {
    	event.preventDefault();
    	$('.type-list').removeClass('on');
    	$(this).addClass('on');
    	/* Act on the event */
    });
	//滚动条插件参数
	$("html").niceScroll({cursorcolor:"#18b2a6"});
	//返回顶部
	 $(window).scroll(function(){  
        if ($(window).scrollTop()>100){
        	$('#back-to-top').css({
           	  right: '10px'
            });
           $("#back-to-top").fadeIn();
           $("#back-to-top").addClass('back-to-top-show');

        }else{
            $('#back-to-top').css({
           	  right: '-60px'
            });
           $("#back-to-top").removeClass('back-to-top-show');
        }  
    });
    $("#back-to-top").click(function(){
    if ($('html').scrollTop()) {  
        $('html').animate({ scrollTop: 0 }, 1000);  
        return false;  
    }  
    $('body').animate({ scrollTop: 0 }, 1000);  
         return false;              
    });                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             

});



    

