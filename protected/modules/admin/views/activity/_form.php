<?php
/* @var $this ActivityController */
/* @var $model Activity */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'activity-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<script id="editor1" type="text/plain" style="width:700px;height:400px;" name="Activity[content]"></script>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->