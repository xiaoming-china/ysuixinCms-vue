<?php
  use yii\helpers\Url;
?>
<style type="text/css">
	#J_imageView<?= $id; ?> li{list-style-type:none;width: 200px;height: auto;overflow:hidden;float:left;margin-right:15px;margin-bottom:30px;}
	#J_imageView<?= $id; ?> li img{width:200px;height:200px;border: 1px solid #ccc;border-radius: 6px;}
	#J_imageView<?= $id; ?> li input{border-radius: 5px;}
	#J_imageView<?= $id; ?> li input.desc{margin-top: 10px;margin-right: 6px;width: 135px;}
	#J_imageView<?= $id; ?> li input.sort{width:15px;margin-top: 10px;margin-right:6px;text-align: center;}
	#J_imageView<?= $id; ?> li a i{position:relative;margin-top: 8px;}
</style>
<input class="button button-small" type="button" id="J_selectImage<?=$id ?>" value="批量上传图片" />
<div id="J_imageView<?= $id; ?>" style="margin:10px 0;height: auto;overflow: hidden;">
<?php if(count($value) > 0 && isset($value)): ?>
	<?php foreach($value as $k => $vo): ?>
		<li class="li<?= $k; ?>">
			<img src="<?= $vo['thumb']; ?>">
			<input type="hidden" name="<?=$inputName; ?>[url][]" value="<?= $vo['url']; ?>" />
			<input type="text" name="<?=$inputName; ?>[sort][]" value="<?= $vo['sort']; ?>" class="sort" />
			<input type="text" name="<?=$inputName; ?>[desc][]" value="<?= $vo['desc']; ?>" class="desc" placeholder="描述">
			<input type="text" name="<?=$inputName; ?>[cover][]" value="<?= $vo['cover']; ?>" class="desc" placeholder="封面">
			<a href="javascript:removeImg('.li<?= $k; ?>','<?= $vo['thumb']; ?>')">
			  <i class="icon icon-trash" del-url="<?=$vo['thumb']; ?>">del</i>
			</a>
		</li>
	<?php endforeach; ?>
<?php endif; ?>
</div>

<script>
	var k=0;
	KindEditor.ready(function(K) {
		var editor = K.editor({
			imageSizeLimit : '1MB', //批量上传图片单张最大容量
    		imageUploadLimit : 10, //批量上传图片同时上传最多个数
			uploadJson:"<?= Url::toRoute(['upload/upload']); ?>",
			allowFileManager : true
		});
		K('#J_selectImage<?= $id; ?>').click(function() {
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(urlList) {
						var div = K('#J_imageView<?= $id; ?>');
						var tmp = '';
						K.each(urlList, function(i, data) {
							k = k+1;
							tmp = '<li class="li'+k+'"><img src="' + data.url + '"><input type="hidden" name="<?=$inputName; ?>[url][]" value="'+data.url+'" /><input type="text" name="<?=$inputName; ?>[sort][]" value="0" class="sort" /><input type="text" name="<?=$inputName; ?>[desc][]" class="desc" placeholder="描述"><a href="javascript:removeImg(\'.li'+k+'\',\''+data.url+'\')"><i class="icon icon-trash" del-url="'+data.url+'">del</i></a></li>';
							div.append(tmp);
						});
						editor.hideDialog();
					}
				});
			});
		});
	});

	function removeImg(k,imgUrl){
		$.post("<?= Url::toRoute(['upload/del-pic']); ?>",{imgUrl:imgUrl},function(rs){
			if(rs.error == 0){
				$(k).remove();
			}else{
				alert(rs.message);
			}
		},'json');	
	}
</script>