<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use common\widgets\UploadOneWidget;
  use common\widgets\UploadManyWidget;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-附件设置</title>
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
			<a href="#">站点参数配置  </a>
		</div>
		<div class="a-tab">
			<a href="<?=Url::toRoute(['/config/config-basic']); ?>">基本配置</a>
			<a href="" class="on">附件配置</a>
			<!-- <a href="/config/config-enclosure.html">高级配置</a> -->
		</div>
		<div calss="clear"></div>
		<div class="basic-item">
			<form action="?" method="post" class="form validate" id="J_Form">
				<table class="add-table">
					<tbody>
			        	<tr>
			              <th width="200">
			              	允许上传附件大小
			              </th>
			              <td><input type="text" class="input" name="max_value"> kb</td>
			            </tr>
			            <tr>
			              <th width="200">
			              	允许上传附件类型
							<p>多个用|隔开;</p>
			              </th>
			              <td><input type="text" class="input" name="upload_type"></td>
			            </tr>
			            <tr>
			              <th width="200">
			              	是否开启图片水印
			              </th>
			              <td>
			              	<input type="radio" name="open_watermark" value="1" checked> 开启
							<input type="radio" name="open_watermark" value="2"> 关闭
			              </td>
			            </tr>
						<tr>
			              <th width="200">
			              水印图片
			              </th>
			              <td>
<?= UploadOneWidget::widget(['id'=>1,'inputName'=>'pic_watermark','defaultValue'=>'/public/admin/img/product3.png']);?>
			              </td>
			            </tr>
			            <tr>
			              <th width="200">
			              水印位置
			              </th>
			              <td>
			              	<select name="watermark_locat" class="input">
			              		<option value="1">左上</option>
			              		<option value="2">中上</option>
			              		<option value="3">右上</option>
			              		<option value="4">左中</option>
			              		<option value="5">中心</option>
			              		<option value="6">右中</option>
			              		<option value="7">左下</option>
			              		<option value="8">中下</option>
			              		<option value="9" selected>右下</option>
			              	</select>
			              </td>
			            </tr>
			            <tr>
			              <th width="200">
			              	是否生成缩略图
			              </th>
			              <td>
			              	<input type="radio" name="open_thumbnail" value="1" checked> 开启
							<input type="radio" name="open_thumbnail" value="2"> 关闭
			              </td>
			            </tr>
						<tr>
			              <th width="200">
			              缩略图大小
			              </th>
			              <td>
			              	宽 <input type="text" class="input" name="thumb_width">
			              	高 <input type="text" class="input" name="thumb_height">
			              </td>
			            </tr>
	          		<tbody>
				</table>
				<div class="btn_wrap_pd" style="left:0;">
			        <button type="submit" class="a-basic-btn">确定</button>
			        <div class="p-error-info"></div>
			    </div>
			</form>
		</div>
	</div>

	

	
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/layer/2.3/layer.js"></script>
<script src="/public/admin/js/jquery.validate.min.js"></script>
<script src="/public/admin/js/jQuery.Form.js"></script>
<script src="/public/admin/js/main.js"></script>
<script>
	$(document).ready(function() {
		$("#J_Form").validate({
			focusCleanup:true,
			focusInvalid:true,
			ignore: ".ignore",
	        rules: {
	            max_value:{
	            	digits:true
	            },
	            thumb_width:{
	            	digits:true
	            },
	            open_thumbnail:{
	            	digits:true
	            }
	        },
	        messages: {
	            max_value:{
	            	digits:'允许上传附件大小必须为正整数'
	            },
	            thumb_width:{
	            	digits:'缩略图宽必须为正整数'
	            },
	            open_thumbnail:{
	            	digits:'缩略图高必须为正整数'
	            }
	        },
			errorPlacement: function(error, element) {
			},
			invalidHandler:function(form,validator){
				$.each(validator.invalid, function(k,v) {
					$('.p-error-info').text(v);
				    clear_error();
				    return false;
				});
			},
			submitHandler: function(form){
	            ajax_submit(form);
	        },
	    });
	});


</script>






	
</body>
</html>