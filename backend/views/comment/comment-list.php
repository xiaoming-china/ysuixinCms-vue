<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="/public/admin/css/basic.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/public/admin/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="main-content" style="margin: 10px 0px 0px 20px;">
		<div class="bread-nav">
			<a href="#">首页 > </a>
			<a href="#">内容 > </a>
			<a href="#">评论管理  </a>
		</div>
		
		<div class="basic-item-seach">
			<form action="">
				<label for="">
					时间：
					<input type="text" name="start_time" placeholder="开始时间" class="search-start_time"> -
					<input type="text" name="end_time" placeholder="结束时间" class="search-end_time">
				</label>
				<label for="">
					关键字：
					<input type="text" name="title" placeholder="内容 / 作者" class="search-title">
				</label>
				<label for="">
					状态：
				  <select name="status" class="search-status">
				  	<option value="">全部</option>
					<option value="1">通过</option>
					<option value="2">未通过</option>
				  </select>
			    </label>
			    <button class="a-basic-btn">搜索</button>
			</form>
		</div>
		<div class="basic-item">
			<table style="width:100%;">
				<colgroup>
			        <col width="16">
			        <col width="160">
			        <col width="">
			        <col width="">
			        <col width="">
			        <col width="">
		        </colgroup>
		        <thead>
		          <tr>
		            <td><label><input type="checkbox" class="J_check_all"></label></td>
		            <td>ID</td>
		            <td>作者</td>
		            <td>内容</td>
		            <td>回复内容</td>
		            <td>状态</td>
		            <td align="center"><span>评论时间</span></td>
		            <td align="center">操作</td>
		          </tr>
		        </thead>
		        <tbody>
		        	<tr class="comment-list1">
			            <td><input type="checkbox" name="checkname" ></td>
			            <td>20</td>
			            <td>作者</td>
			            <td>描内容内容内容内容内容述</td>
			            <td class="status1">回复回复回复回复回复</td>
			            <td>√</td>
			            <td align="center">2017-9-20 11：03</td>
			            <td align="center">
			            	<a href="javascript:look_comment(1);">查看</a> |
			            	<a href="javascript:del_comment(1);">删除</a>     
			            </td>
          			</tr>
		        	<tr class="comment-list2">
			            <td><input type="checkbox" name="checkname" ></td>
			            <td>20</td>
			            <td>作者</td>
			            <td>描内容内容内容内容内容述</td>
			            <td class="status1">回复回复回复回复回复</td>
			            <td>✘</td>
			            <td align="center">2017-9-20 11：03</td>
			            <td align="center">
			            	<a href="javascript:look_comment(2);">查看</a> |
			            	<a href="javascript:del_comment(2);">删除</a>     
			            </td>
          			</tr>
          		</tbody>
              </table>
                <div class="item-page">
                	<span>共12页 / 第1页</span>
              		<a href="#">首页</a>
              		<a href="#" class="current">1</a>
              		<a href="#">2</a>
              		<a href="#">3</a>
              		<a href="#">尾页</a>
                </div>
		</div>
	</div>


		<!--查看评论model-->
	<div class="comment-model" style="display:none;">
		<div style="margin:0 auto;width:80%;" class="model">
			<form action="?" method="post" class="form validate" id="J_Form">
				<div class="form-group">
				    <label>作者</label>
				    <input type="text" class="form-control form-control-text" name="model_name" disabled>
				</div>
				<div class="form-group">
				    <label>评论内容</label>
				    <textarea rows="6" class="form-control" name="comment_desc" disabled></textarea>
				</div>
				<div class="form-group">
				    <label><i class="requird"></i>回复内容</label>
				    <textarea rows="6" class="form-control" placeholder="请输入回复" name="reply_desc"></textarea>
				</div>
				<div class="form-group">
				    <label for="name">状态</label>
				    <input type="radio" name="status" value = "1" checked> 通过
				    <input type="radio" name="status" value = "2"> 未通过
				</div>
				 <div class="error-info"></div>
			</form>
		</div>

	</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/layer/2.3/layer.js"></script>
<script src="/public/admin/js/jquery.validate.min.js"></script>
<script src="/public/admin/js/jQuery.Form.js"></script>
<script src="/public/admin/js/main.js"></script>
<script>
	//删除评论
	//n,id
	function del_comment(n){
		var index = top.layer.confirm('确定删除此评论？', {
		  btn: ['确定','取消']
		}, function(){
			top.layer.close(index);
			top.layer.msg('删除成功', {
		      time: 1500,
		    },function(){
		    	$('.comment-list' + n).remove();
			});
		}, function(){});
	}
	//查看评论
	function look_comment(m,n){
		top.layer.open({
		  type: 1,
		  title:'查看评论',
		  area: ['500px', 'auto'],
		  content: $('.comment-model').html(),
		  btn:['确定','取消'],
		  success:function(){
		  	valid();
		  },
		  yes:function(){
		  	$(window.parent.document).find(".layui-layer-content>.model>#J_Form").submit();
		  }
		});
	}
	//回复评论表单验证
	function valid(){
		$(window.parent.document).find(".layui-layer-content>.model>#J_Form").validate({
			focusCleanup:true,
			focusInvalid:false,
	        rules: {
	            reply_desc:{
	            	required:true,
	            	maxlength:80
	            }
	        },
	        messages: {
	            reply_desc: {
	              required:"回复内容长度为1~80个字符",
	              maxlength:'回复内容长度必须为1~80个字符'
	            }
	        },
	        errorLabelContainer: $(window.parent.document).find(".layui-layer-content>.model").find('.error-info'),
			submitHandler: function(form){
	            ajax_submit(form);
	        },
	    });
	}
</script>






	
</body>
</html>