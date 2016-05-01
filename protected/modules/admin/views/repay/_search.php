<?php
/* @var $this RepayController */
/* @var $model Repay */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paid_ID'); ?>
		<?php echo $form->textField($model,'paid_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payId'); ?>
		<?php echo $form->textField($model,'payId',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paid_money'); ?>
		<?php echo $form->textField($model,'paid_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'docsId'); ?>
		<?php echo $form->textField($model,'docsId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->