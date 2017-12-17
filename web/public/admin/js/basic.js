/**
 * [description 全选操作]
 * @Author:xiaoming
 * @DateTime        2017-05-03T09:46:40+0800
 * @param           {[type]}                 ) {             var text [description]
 * @return          {[type]}                   [description]
 */
$('.checkboxAll').click(function() {
  var text = $(this).text();
  alert(text);
  if(text == '全选'){
    $(this).text('取消');
    $(":checkbox").attr('checked',true);
  }else{
    $(this).text('全选');
    $(":checkbox").attr('checked',false);
  }
});
/**
 * [checkAfter 全选后操作]
 * @param  {[type]} dom [description]
 * @return {[type]}     [description]
 */
function checkAfter(url,title){
   var arrs = new Array();
    $("input[name='selectId']:checkbox").each(function(){ 
        if($(this).attr("checked")){
            arrs.push($(this).val());
        }
    });
    if(arrs.length == 0){
        layer.msg('请选择数据！');
        return false;
    }
    basicOperate(url);
   // layer.confirm(title, {
   //   btn: ['确定','取消'],
   //   title:'提示'
   // }, function(){
   //   var selectId = arrs.join(",");
   //    layer.load(1, {
   //      shade: [0.4,'#fff']
   //    });
   //    $.post(url, {id: selectId}, function(data) {
   //      _callBack(data);//回调
   //    },'json');
   // }, function(){});
}
/**
 * [basicOperate 基本ajax操作]
 * @Author:xiaoming
 * @DateTime        2017-05-02T15:46:36+0800
 * @return          {[type]}                 [description]
 */
function basicOperate(url,info=''){
  if(info == ''){
    var title = '<span class="confirm-content">确定此操作？</span>';
  }else{
    var title = '<span class="confirm-content">'+info+'，确定此操作？</span>';
  }
	layer.confirm(title, {
		  title:'提示',
		  btn: ['确定','取消'],
		  skin: 'layui-layer-molv',
		  btnAlign: 'c'
	}, function(){
         $.ajax({
            type: "get",
            async:true,
            url: url,
            timeout:1000,
            dataType: "json",
            success: function(rs){
               if(rs.status == 'success'){
               	 if(rs.url == ''){
               	 	location.reload();
               	 }else{
               	 	location.href= rs.url;
               	 }
               }else{
               	layer.msg(rs.info,{
	            	time:2600
	            });
               }
            },
            beforeSend:function(){
	            layer.load(1, {
				  shade: [0.4,'#000']
				});
            },
            error: function (jqXHR,textStatus,errorThrown) {
	          if (textStatus == 'timeout') {
	            layer.msg('网络错误',{
	            	time:2000
	            });
	            return false;
	          }
	        },
	        complete:function(){
              layer.closeAll('loading');
            },
         });
      }, function(){});
}
//tab切换
$('.tab-li > li').click(function(event) {
  $(this).addClass('active').siblings().removeClass('active');
  var index  = $(this).index();
  // var length = $('.tab-div > form > .tab-pane').length;
  // alert(length);
  $('.tab-div > .tab-pane:eq('+index+')').addClass('show').siblings().removeClass('show');
});
//水印位置选择
$('.watermarkpos-table td').click(function(event) {
  $('.watermarkpos-table td').removeClass('on');
  $(this).addClass('on');
  $("input[name='watermarkpos']").val($(this).attr('value'));//赋值
});

$(function () {
    //日期时间选择器初始化
    $(".datetime").datetimepicker({
        language: "zh-CN",
        autoclose: true,
        todayBtn: true,
        //pickerPosition: "bottom-left",
        format: "yyyy-mm-dd hh:ii"//日期格式，详见 http://bootstrap-datepicker.readthedocs.org/en/release/options.html#format
    });
});
//日期时间选择器设置中文
$.fn.datetimepicker.dates['zh-CN'] = {
  days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
  daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
  daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
  months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
  monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
  today: "今天",
  suffix: [],
  meridiem: ["上午", "下午"]
};
