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
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'clientele'); ?>
		<?php echo $form->textField($model,'clientele'); ?>
		<?php echo $form->error($model,'clientele'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array("话费"=>"话费",'宽带费'=>"宽带费"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'label'); ?>
		<?php echo $form->dropDownList($model,'label',array(
                    "地址详细"=>"地址详细",
                    "地址不详细"=>"地址不详细",
                    "已寄送律师函"=>"已寄送律师函",
                    "没有寄送律师函"=>"没有寄送律师函",
                    "联系号码和欠费号码相同"=>"联系号码和欠费号码相同",
                    "联系号码和欠费号码不同"=>"联系号码和欠费号码不同"),array("multiple"=>"multiple",'size'=>6)
                    ); ?>
		<?php echo $form->error($model,'label'); ?>
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
        <div class="row" id="upload_detail">
		<?php echo $form->labelEx($model,'detail'); ?>
		<?php echo $form->fileField($model,'detail'); ?>
		<?php echo $form->error($model,'detail'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '上传' : '修改'); ?>
	</div>
	<div class="row buttons">
		<a href="/example.xls" target="_blank">上传格式文本范例</a>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        function getFileName_ext(o){
            var pos=o.lastIndexOf("\\");
            return o.substring(pos+1);  
        }
        function getFileName(o){
            o = getFileName_ext(o);
            var pos=o.lastIndexOf(".");
            return o.substring(0,pos);  
        }
        $('#UploadDocs_time').datepicker({
            showButtonPanel: true
        });
        $('#UploadDocs_starttime').datepicker({
            showButtonPanel: true
        });
        $('#UploadDocs_endtime').datepicker({
            showButtonPanel: true
        });
        $("#UploadDocs_detail").on('change',function(){
            var upload_name = getFileName($(this).val());
            $.ajax({
		type: 'POST',
		url: "/admin/uploadDocs/checkUploadName",
		data: {upload_name:upload_name},
                //async:false,
		success: function(data){
                    if(data==1){
                        layer.confirm('已经上传过同名的文件，是否上传？', {
                            btn: ['确定','取消'] //按钮
                        }, function(){
                            layer.closeAll('dialog');
                        }, function(){
                            document.getElementById('UploadDocs_detail').value="";
                        });
                    }
		},
                error:function(response){
                    console.log(response.responseText);
                }
            });
        })
    });
</script>