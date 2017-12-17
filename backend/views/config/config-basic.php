<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
  use common\widgets\UploadOneWidget;
  use common\widgets\UploadManyWidget;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>管理后台-基本参数设置</title>
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
			<a href="" class="on">基本配置</a>
			<a href="<?=Url::toRoute(['/config/config-enclosure']); ?>">附件配置</a>
			<!-- <a href="">高级配置</a> -->
		</div>
		<div calss="clear"></div>
		<div class="basic-item">
			<form action="?" method="post" class="form validate" id="J_Form">
				<table class="add-table">
					<tbody>
			        	<tr>
			              <th width="200">
			              	站点名称
							<p>最多30个字符；</p>
			              </th>
			              <td><input type="text" class="input" name="site_name"></td>
			            </tr>
			            <tr>
			              <th width="200">
			              	站点url
							<p>站点首页地址</p>
			              </th>
			              <td>
			              	<input type="text" class="input" name="site_url">
			              </td>
			            </tr>
			            <tr>
			              <th width="200">
			              	站点关键字
							<p>提高SEO;多个请用,隔开;最多50个字符</p>
			              </th>
			              <td><input type="text" class="input" name="site_keywords"></td>
			            </tr>
			            <tr>
			              <th width="200">
			              	站点描述
							<p>最多50个字符；</p>
			              </th>
			              <td>
			              	<textarea class="input" name="site_desc" style="height:100px;width:400px;"></textarea>
			              </td>
			            </tr>
			            <tr>
			              <th width="200">
			              	站点logo
							<p>建议尺寸150 * 50 px；</p>
			              </th>
			              <td>
						<?= UploadOneWidget::widget(['id'=>1,'inputName'=>'site_logo','defaultValue'=>'/public/admin/img/product3.png']);?>
			              </td>
			            </tr>
			            <tr>
			              <th width="200">
			              	站点联系人
			              	<p>最多10个字符；</p>
			              </th>
			              <td><input type="text" class="input" name="site_contents"></td>
			            </tr>
			            <tr>
			              <th width="200">
			              	联系人邮箱
			              </th>
			              <td><input type="text" class="input" name="site_contents_email"></td>
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
	            site_name:{
	            	maxlength:30
	            },
	            site_url:{
	            	url:true,
	            },
	            site_keywords:{
	            	maxlength:50
	            },
	            site_desc:{
	            	maxlength:50
	            },
	            site_contents:{
	            	maxlength:10
	            },
	            site_contents_email:{
	            	email:true
	            }
	        },
	        messages: {
	            site_name:{
	            	maxlength:'站点名称最多10个字符'
	            },
	            site_url:{
	            	url:'字段url格式不正确'
	            },
	            site_keywords:{
	            	maxlength:'站点关键字最多50个字符'
	            },
	            site_desc:{
	            	maxlength:'站点描述最多50个字符'
	            },
	            site_contents:{
	            	maxlength:'联系人最多10个字符'
	            },
	            site_contents_email:{
	            	email:'联系人邮箱url格式不正确'
	            }
	        },
	        //errorLabelContainer: $('.error-info'),
			errorPlacement: function(error, element) {
			},
			invalidHandler:function(form,validator){
				$.each(validator.invalid, function(k,v) {
					$('.p-error-info').text(v);
				    clear_info();
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