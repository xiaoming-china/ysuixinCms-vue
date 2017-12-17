<?php
  use yii\helpers\Url;
?>

<input type="text" name="<?= $inputName; ?>" id="url<?= $id;?>" value="<?= $defaultValue; ?>" class="input"/> 
<button type="button" id="upload<?= $id; ?>"class="a-basic-btn">选择文件</button>
<a target="_blank" class="a-basic-btn view-img" title="预览" id="view-img<?= $id; ?>" href="<?= $defaultValue; ?>" style="color: #333;">
  <i class="icon-eye-open"></i>
</a>

<script>
  KindEditor.ready(function(K) {
    var editor = K.editor({
      allowFileManager : false,
      uploadJson:"<?php echo Url::toRoute(['upload/upload']); ?>",
      // fileManagerJson : "{:U('Upload/fileManagerJson')}"
    });
    K("#upload<?= $id; ?>").click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          imageUrl : K("#url<?= $id; ?>").val(),
          clickFn : function(url, title, width, height, border, align) {
            K("#url<?= $id; ?>").val(url);
            K("#view-img<?= $id; ?>").attr('href',url);
            editor.hideDialog();
          }
        });
      });
    });
  });

</script>




