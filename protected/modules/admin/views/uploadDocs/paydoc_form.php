<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'upload-docs-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('ENCTYPE' => "multipart/form-data"),
    ));
    ?>
    <div class="row">
        欠费区域：<input type="text" value="" name="UploadDocs[area]">
    </div>
    <div class="row">
        委 托 人：<input type="text" value="" name="UploadDocs[clientele]">
    </div>
    <div class="row">
        <input type="file" value="缴费文档" name="UploadDocs[pay]">
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? '上传' : '上传'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->