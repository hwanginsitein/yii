<?php
/* @var $this ContactUsersController */
/* @var $model ContactUsers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<!--
	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>12,'maxlength'=>12)); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->label($model,'debt_money'); ?>
		<?php echo $form->textField($model,'debt_money'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'ID_number'); ?>
		<?php echo $form->textField($model,'ID_number',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone1'); ?>
		<?php echo $form->textField($model,'phone1',array('size'=>30,'maxlength'=>30)); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->label($model,'phone1_status'); ?>
		<?php echo $form->textField($model,'phone1_status'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'phone2'); ?>
		<?php echo $form->textField($model,'phone2',array('size'=>30,'maxlength'=>30)); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->label($model,'phone2_status'); ?>
		<?php echo $form->textField($model,'phone2_status'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->label($model,'phone3'); ?>
		<?php echo $form->textField($model,'phone3',array('size'=>30,'maxlength'=>30)); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->label($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sendLetter'); ?>
		<?php echo $form->textField($model,'sendLetter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sent_date'); ?>
		<?php echo $form->textField($model,'sent_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiveLetter'); ?>
		<?php echo $form->textField($model,'receiveLetter'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ifrepay'); ?>
		<?php echo $form->textField($model,'ifrepay'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'repay_date'); ?>
		<?php echo $form->textField($model,'repay_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'repay_money'); ?>
		<?php echo $form->textField($model,'repay_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attitude'); ?>
		<?php echo $form->textField($model,'attitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'objection_reason'); ?>
		<?php echo $form->textField($model,'objection_reason',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ifvalid'); ?>
		<?php echo $form->textField($model,'ifvalid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'otherComments'); ?>
		<?php echo $form->textField($model,'otherComments',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proceed'); ?>
		<?php echo $form->textArea($model,'proceed',array('rows'=>6, 'cols'=>50)); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->