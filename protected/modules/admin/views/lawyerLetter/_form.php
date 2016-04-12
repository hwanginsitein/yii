<?php
/* @var $this LawyerLetterController */
/* @var $model LawyerLetter */
/* @var $form CActiveForm */
?>

<div class="form">
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lawyer-letter-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'letter_name'); ?>
		<?php echo $form->textField($model,'letter_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'letter_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<script id="editor1" type="text/plain" style="width:700px;height:400px;" name="LawyerLetter[content]"></script>
		<?php echo $form->error($model,'content'); ?>
	</div>
        <?php
            if($model->content){
                $model->content = str_replace(array("\r\n","\n"),"\\n",$model->content);
            }
        ?>
        <script>
            var ue = UE.getEditor('editor1');
            <?php
                if($model->content){
                    $model->content = str_replace(array("\r\n","\n"),"\\n",$model->content);
                    $model->content = str_replace("\"","'",$model->content);
            ?>
                var content = "<?=$model->content?>";
                ue.ready(function() {
                    ue.setContent(content);
                });
            <?php 
                }
            ?>
        </script>

	<div class="row">
		<?php echo $form->labelEx($model,'debtor_name'); ?>
		<?php echo $form->textField($model,'debtor_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'debtor_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debtor_ID'); ?>
		<?php echo $form->textField($model,'debtor_ID',array('size'=>17,'maxlength'=>17)); ?>
		<?php echo $form->error($model,'debtor_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creditor_name'); ?>
		<?php echo $form->textField($model,'creditor_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'creditor_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creditor_ID'); ?>
		<?php echo $form->textField($model,'creditor_ID',array('size'=>17,'maxlength'=>17)); ?>
		<?php echo $form->error($model,'creditor_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owe_money'); ?>
		<?php echo $form->textField($model,'owe_money'); ?>
		<?php echo $form->error($model,'owe_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lawyer'); ?>
		<?php echo $form->textField($model,'lawyer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lawyer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client'); ?>
		<?php echo $form->textField($model,'client',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'client'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'addressee'); ?>
		<?php echo $form->textField($model,'addressee',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'addressee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reply_id'); ?>
		<?php echo $form->textField($model,'reply_id'); ?>
		<?php echo $form->error($model,'reply_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->