<?php
/* @var $this DebtsController */
/* @var $model Debts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'debts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'debt_number'); ?>
		<?php echo $form->textField($model,'debt_number',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'debt_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'docsId'); ?>
		<?php echo $form->textField($model,'docsId'); ?>
		<?php echo $form->error($model,'docsId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clientele'); ?>
		<?php echo $form->textField($model,'clientele',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'clientele'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debtor'); ?>
		<?php echo $form->textField($model,'debtor',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'debtor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_number'); ?>
		<?php echo $form->textField($model,'ID_number',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'ID_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'account_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debt_money'); ?>
		<?php echo $form->textField($model,'debt_money',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'debt_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'overdue_time'); ?>
		<?php echo $form->textField($model,'overdue_time'); ?>
		<?php echo $form->error($model,'overdue_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ifpay'); ?>
		<?php echo $form->textField($model,'ifpay'); ?>
		<?php echo $form->error($model,'ifpay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('#Debts_overdue_time').datepicker({
            showButtonPanel: true
        });
    })
</script>