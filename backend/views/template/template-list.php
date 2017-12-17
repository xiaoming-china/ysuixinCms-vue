<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-模板设置</title>
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
			<a href="#">站点设置 > </a>
			<a href="#">站点模板管理  </a>
		</div>

		<div class="template-list">
			<div class="template-info">
				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
				<p class="title">默认模板(当前模板)</p>
				<p class="is-select on"></p>
			</div>
			<div class="template-info">
				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
				<p class="title">默认模板</p>
				<p class="is-select"></p>
			</div>
			<div class="template-info">
				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
				<p class="title">默认模板</p>
				<p class="is-select"></p>
			</div>
			<div class="template-info">
				<p class="cover"><img src="/public/admin/img/preview.jpg" alt=""></p>
				<p class="title">默认模板</p>
				<p class="is-select"></p>
			</div>
		</div>	
	</div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/layer/2.3/layer.js"></script>
<script src="/public/admin/js/jquery.validate.min.js"></script>
<script src="/public/admin/js/jQuery.Form.js"></script>
<script src="/public/admin/js/main.js"></script>
<script>
	$('.template-info').click(function(event) {
		var that = $(this);
		var index = top.layer.confirm('确定使用此模板吗？', {
		  title:'提示',
		  btn: ['确定','取消']
		}, function(){
			top.layer.close(index);
			top.layer.msg('使用成功', {
		      time: 1500,
		    },function(){
		    	$('.is-select').removeClass('on');
				that.find('.is-select').addClass('on');
			});
		}, function(){});
	});
</script>






	
</body>
</html>