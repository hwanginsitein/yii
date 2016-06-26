<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dun-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<label for="Dun_uid" class="required">催缴人员用户名 <span class="required">*</span></label>
		<input name="Dun[username]" id="Dun_username" type="text">
		<?php if($errorMsg['username']){echo "<div style='color:red'>".$errorMsg['username']."</div>";}?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'docId'); ?>
		<?php echo $form->textField($model,'docId'); ?>
		<?php echo $form->error($model,'docId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cdate'); ?>
		<?php echo $form->textField($model,'cdate'); ?>
		<?php echo $form->error($model,'cdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $('#Dun_cdate').datepicker({
        showButtonPanel: true
    });
</script>