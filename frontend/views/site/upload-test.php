<?php
  use yii\widgets\ActiveForm;
  use yii\helpers\Url;
  use yii\helpers\Html; 
?>

<script type="text/javascript" src="kindeditor/kindeditor-all-min.js"></script>
<link href="kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
<input type="text" name="image" id="url" /> 
<button class="upload">Submit</button>

<script>
  KindEditor.ready(function(K) {
    var editor = K.editor({
      allowFileManager : false,
      uploadJson:"<?php echo Url::toRoute(['tools/upload']); ?>",
      // fileManagerJson : "{:U('Upload/fileManagerJson')}"
    });
    K(".upload").click(function() {
      editor.loadPlugin('image', function() {
        editor.plugin.imageDialog({
          imageUrl : K("#url").val(),
          clickFn : function(url, title, width, height, border, align) {
            K("#url").val(url);
            editor.hideDialog();
          }
        });
      });
    });
  });
</script>




