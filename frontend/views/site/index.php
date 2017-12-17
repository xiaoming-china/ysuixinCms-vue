<?php
   use yii\bootstrap\Progress;
   use yii\helpers\Html;
   use yii\helpers\Url;
   use yii\bootstrap\ActiveForm;
   use common\widgets\UploadOneWidget;
   use common\widgets\UploadManyWidget;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?= UploadOneWidget::widget(['id'=>1,'inputName'=>'file','defaultValue'=>'img/gg.jpg']);?>
<?= UploadOneWidget::widget(['id'=>2,'inputName'=>'file','defaultValue'=>'img/gg.jpg']);?>
<div style="margin-bottom: 40px; "></div>


<?=
    UploadManyWidget::widget([
            'id'=>1,
            'inputName'=>'article_img',
            'value'=>[]
    ]);
?>
<?=
    UploadManyWidget::widget([
            'id'=>2,
            'inputName'=>'test_img',
            'value'=>[]
    ]);
?>
