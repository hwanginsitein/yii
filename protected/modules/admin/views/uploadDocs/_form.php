<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'upload-docs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('ENCTYPE' => "multipart/form-data"),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'upload_name'); ?>
		<?php echo $form->textField($model,'upload_name'); ?>
		<?php echo $form->error($model,'upload_name'); ?>
	</div>
	<div class="row">
            <label for="UploadDocs_starttime_endtime" class="required">欠费起止时间 <span class="required">*</span></label>
                <?php echo $form->textField($model,'starttime'); ?>至<?php echo $form->textField($model,'endtime'); ?>
		<?php echo $form->error($model,'endtime'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->dropDownList($model,'area',array(
                    "新干县"=>"新干县","安福县"=>"安福县","峡江县"=>"峡江县","永丰县"=>"永丰县","吉水县"=>"吉水县","吉州区"=>"吉州区","青原区"=>"青原区",
                    "吉安县"=>"吉安县","永新县"=>"永新县","泰和县"=>"泰和县","井冈山市"=>"井冈山市","遂川县"=>"遂川县","万安县"=>"万安县"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'area'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textField($model,'comments'); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'detail'); ?>
		<?php echo $form->fileField($model,'detail'); ?>
		<?php echo $form->error($model,'detail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->