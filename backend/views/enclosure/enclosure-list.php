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
			<a href="#">附件管理  </a>
		</div>
		
		<div class="basic-item-seach">
			<form action="">
				<label for="">
					时间：
					<input type="text" name="start_time" placeholder="开始时间" class="search-start_time"> -
					<input type="text" name="end_time" placeholder="结束时间" class="search-end_time">
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
		            <td>名称</td>
		            <td>路径</td>
		            <td>类型</td>
		            <td align="center"><span>上传时间</span></td>
		            <td align="center">操作</td>
		          </tr>
		        </thead>
		        <tbody>
		        	<tr class="file-list1">
			            <td><input type="checkbox" name="checkname" ></td>
			            <td>20</td>
			            <td>文章模型</td>
			            <td>描述</td>
			            <td class="status1">.doc</td>
			            <td align="center">2017-9-20 11：03</td>
			            <td align="center">
			            	<a href="#">查看</a> |
			            	<a href="javascript:del_file(1,'/img/test.jpg');">删除</a>     
			            </td>
          			</tr>
          			<tr class="file-list2">
			            <td><input type="checkbox" name="checkname" ></td>
			            <td>20</td>
			            <td>文章模型</td>
			            <td>描述</td>
			            <td class="status2">.rar</td>
			            <td align="center">2017-9-20 11：03</td>
			            <td align="center">
			            	<a href="#">查看</a> |
			            	<a href="javascript:del_file(2,'/img/test.jpg');">删除</a>
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


		<!--添加model-->
	<div class="add-model" style="display:none;">
		<div style="margin:0 auto;width:80%;" class="model">
			<form action="?" method="post" class="form validate" id="J_Form">
				<div class="form-group">
				    <label><i class="requird"></i>名称</label>
				    <input type="text" class="form-control form-control-text" placeholder="请输入名称" name="model_name">
				</div>
				<div class="form-group">
				    <label>描述</label>
				    <textarea rows="6" placeholder="请输入描述(最多50个字符)" class="form-control" name="model_desc"></textarea>
				</div>
				<div class="form-group">
				    <label for="name">状态</label>
				    <input type="radio" name="status" value = "1" checked> 开启
				    <input type="radio" name="status" value = "2"> 禁用
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
	//删除附件
	//n,附件id，m文件路径
	function del_file(n,m){
		var index = top.layer.confirm('确定删除此附件？', {
		  btn: ['确定','取消']
		}, function(){
			top.layer.close(index);
			top.layer.msg('删除成功', {
		      time: 1500,
		    },function(){
		    	$('.file-list' + n).remove();
			});
		}, function(){});
	}
</script>






	
</body>
</html>