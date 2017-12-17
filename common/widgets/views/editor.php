<?php
  use yii\helpers\Url;
?>
<textarea name="<?= $inputName; ?>" id="contents<?= $id;?>" data-rules="{required:true}"><?= $defaultValue; ?></textarea>
<script>
  KindEditor.ready(function(K) {
    var editor = K.create("#contents<?= $id;?>", {
      allowFileManager : false,
      allowImageUpload : true,
      uploadJson:"<?php echo Url::toRoute(['upload/upload']); ?>",
      fileManagerJson : "{:U('Upload/fileManagerJson')}",
      afterBlur: function () { this.sync(); },
      allowPreviewEmoticons : false,
      width:810,
      height:310,
      // items : [
      //   'source','|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
      //   'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
      //   'insertunorderedlist', '|', 'emoticons', 'image', 'link', 'preview', 'fullscreen']
    });
  });
</script>