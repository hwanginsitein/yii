<?php
/* @var $this RepayController */
/* @var $model Repay */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'repay-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_ID'); ?>
		<?php echo $form->textField($model,'paid_ID'); ?>
		<?php echo $form->error($model,'paid_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payId'); ?>
		<?php echo $form->textField($model,'payId',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'payId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid_money'); ?>
		<?php echo $form->textField($model,'paid_money'); ?>
		<?php echo $form->error($model,'paid_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'docsId'); ?>
		<?php echo $form->textField($model,'docsId'); ?>
		<?php echo $form->error($model,'docsId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->