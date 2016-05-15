<?php
/* @var $this ContactUsersController */
/* @var $model ContactUsers */
/* @var $form CActiveForm */
?>

<div class="form">
<?php 
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact-users-form',
    'enableAjaxValidation'=>false,
));
?>
    
	<p class="note"><span class="required">*</span> 表示必填。</p>
	<?php echo $form->errorSummary($model); ?>
<div class="span1">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>12,'maxlength'=>12,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debt_money'); ?>
		<?php echo $form->textField($model,'debt_money',array('readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'debt_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_number'); ?>
		<?php echo $form->textField($model,'ID_number',array('size'=>18,'maxlength'=>18,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'ID_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone1'); ?>
		<?php echo $form->textField($model,'phone1',array('size'=>30,'maxlength'=>30,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'phone1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone1_status'); ?>
		<?php echo $form->dropDownList($model,'phone1_status',array(
                    "1"=>"能联系上欠费用户","2"=>"机主不是欠费用户","3"=>"无法联系"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'phone1_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone2'); ?>
		<?php echo $form->textField($model,'phone2',array('size'=>30,'maxlength'=>30,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'phone2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone2_status'); ?>
		<?php echo $form->dropDownList($model,'phone2_status',array(
                    "1"=>"能联系上欠费用户","2"=>"机主不是欠费用户","3"=>"无法联系"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'phone2_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone3'); ?>
		<?php echo $form->textField($model,'phone3',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'phone3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
                <?php echo $form->textField($model,'region'); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number',array('size'=>15,'maxlength'=>15,'readOnly'=>'readOnly')); ?>
		<?php echo $form->error($model,'account_number'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'overdue_time'); ?>
		<?php echo $form->textField($model,'overdue_time'); ?>
		<?php echo $form->error($model,'overdue_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array("0"=>"待审核","1"=>"通过"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
</div>
<div class="span1">

	<div class="row">
		<?php echo $form->labelEx($model,'sendLetter'); ?>
		<?php echo $form->dropDownList($model,'sendLetter',array("0"=>"否","1"=>"是"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'sendLetter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sent_date'); ?>
		<?php echo $form->textField($model,'sent_date'); ?>
		<?php echo $form->error($model,'sent_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receiveLetter'); ?>
		<?php echo $form->dropDownList($model,'receiveLetter',array(
                    "0"=>"否","1"=>"是"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'receiveLetter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ifrepay'); ?>
		<?php echo $form->dropDownList($model,'ifrepay',array(
                    "0"=>"否","1"=>"是"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'ifrepay'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'repay_date'); ?>
		<?php echo $form->textField($model,'repay_date'); ?>
		<?php echo $form->error($model,'repay_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'repay_money'); ?>
		<?php echo $form->textField($model,'repay_money'); ?>
		<?php echo $form->error($model,'repay_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attitude'); ?>
		<?php echo $form->dropDownList($model,'attitude',array("0"=>"不愿意缴费","1"=>"愿意缴费"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'attitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'objection_reason'); ?>
		<?php echo $form->textField($model,'objection_reason',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'objection_reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ifvalid'); ?>
		<?php echo $form->dropDownList($model,'ifvalid',array("0"=>"不成立","1"=>"成立"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'ifvalid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otherComments'); ?>
		<?php echo $form->textField($model,'otherComments',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'otherComments'); ?>
	</div>
</div>
        <div class="clear"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'proceed'); ?>
                <?php $editorId = "editor".time();?>
                <script id="editor<?=$editorId?>" type="text/plain" style="width:700px;height:400px;" name="ContactUsers[proceed]"></script>
		<?php echo $form->error($model,'proceed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $('#ContactUsers_repay_date').datepicker({
        showButtonPanel: true
    });
    $('#ContactUsers_sent_date').datepicker({
        showButtonPanel: true
    });
    var ue = UE.getEditor('editor<?=$editorId?>');
    ue.ready(function() {
    });
</script>