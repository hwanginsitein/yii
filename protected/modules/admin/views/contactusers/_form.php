<?php
/* @var $this ContactUsersController */
/* @var $model ContactUsers */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> 表示必填。</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span1">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>12,'maxlength'=>12,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debt_money'); ?>
		<?php echo $form->textField($model,'debt_money',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'debt_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_number'); ?>
		<?php echo $form->textField($model,'ID_number',array('size'=>18,'maxlength'=>18,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'ID_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->dropDownList($model,'region',array(
                    "新干县"=>"新干县","安福县"=>"安福县","峡江县"=>"峡江县","永丰县"=>"永丰县","吉水县"=>"吉水县","吉州区"=>"吉州区","青原区"=>"青原区",
                    "吉安县"=>"吉安县","永新县"=>"永新县","泰和县"=>"泰和县","井冈山市"=>"井冈山市","遂川县"=>"遂川县","万安县"=>"万安县"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_number'); ?>
		<?php echo $form->textField($model,'account_number',array('size'=>15,'maxlength'=>15,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'account_number'); ?>
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
		<?php echo $form->labelEx($model,'ifvalid'); ?>
		<?php echo $form->dropDownList($model,'ifvalid',array("0"=>"不成立","1"=>"成立",'2'=>'待核实'),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'ifvalid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'objection_date'); ?>
		<?php echo $form->textField($model,'objection_date',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'objection_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'otherComments'); ?>
		<?php echo $form->textField($model,'otherComments',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'otherComments'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array("0"=>"待审核","1"=>"通过"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
</div>
<div class="span2">
	<table border="0">
		<tr>
			<td>
				<!--<div>电话联系用户</div>-->
				<div>
					<span class="notcontact size1 phone1_status" value=0>无法接通</span>
					<span class="contact size1 phone1_status" value=1>可以接通</span>
				</div>
			</td>
			<td>
				<div class="row blue">
					<label for="ContactUsers_phone1">第一联系电话</label>
					<input size="20" maxlength="30" name="ContactUsers[phone1]" id="ContactUsers_phone1" type="text" 
					value="<?=$model->phone1?>">
				</div>
				<div class="row blue">
					<label for="ContactUsers_phone2">第二联系电话</label>
					<input size="20" maxlength="30" name="ContactUsers[phone2]" id="ContactUsers_phone2" type="text" 
					value="<?=$model->phone2?>">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<span class="contact size2 receiveLetter" value=1>已收到律师函</span>
				<span class="notcontact size2 receiveLetter" value=0>未收到律师函</span>
			</td>
			<td>
				<div>新的联系方式</div>
				<div><input type="text" name="phone3"></div>
			</td>
		</tr>
		<tr>
			<td>
				<span class="contact size1 attitude" value=1>愿意缴费</span>
				<span class="notcontact size3 attitude" value=0>不愿意缴费</span>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td style="padding-top:14px;">
				<div class="objection size1 height1">用户提出异议</div>
			</td>
			<td>
				<div class="blue size1">异议理由</div>
				<div style="margin-top:10px">
					<span class="objection size1 objection_reason" value="手机被盗">手机被盗</span>
					<span class="notcontact size2 objection_reason" value="欠费没那么多">欠费没那么多</span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="notcontact size1 attitude" value="拒不缴费态度恶劣">拒不缴费态度恶劣</div>
			</td>
			<td>
				<div class="row blue">
					<label for="ContactUsers_otherObjection">其他理由</label>
					<input size="20" maxlength="255" name="ContactUsers[otherObjection]" id="ContactUsers_otherObjection" 
					type="text" value="<?=$model->otherObjection?>">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<span class="contact ifrepay size4" value=1>已缴费</span>
			</td>
			<td>
				<div><label for="ContactUsers_repay_money">缴费金额</label></div>
				<div class="">
					<input name="ContactUsers[repay_money]" id="ContactUsers_repay_money" type="text">
				</div>
				<div><label for="ContactUsers_repay_date">缴费日期</label></div>
				<div class="">
					<input name="ContactUsers[repay_date]" id="ContactUsers_repay_date" type="text" value="">
				</div>
			</td>
		</tr>
	</table>
</div>
    <div class="clear"></div>
	<div class="row">
		<?=$model->proceed;?>
		<!--
		<?php echo $form->labelEx($model,'proceed'); ?>
                <script id="editor1" type="text/plain" style="width:700px;height:400px;" name="ContactUsers[proceed]"></script>
		<?php echo $form->error($model,'proceed'); ?>
		-->
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
<input type="hidden" name="ContactUsers[phone1_status]" id="phone1_status">
<input type="hidden" name="ContactUsers[receiveLetter]" id="receiveLetter">
<input type="hidden" name="ContactUsers[ifrepay]" id="ifrepay">
<input type="hidden" name="ContactUsers[objection_reason]" id="objection_reason">
<input type="hidden" name="ContactUsers[attitude]" id="attitude">
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
    	$(".phone1_status").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".phone1_status").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected');
    			$("#phone1_status").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#phone1_status").val($(this).attr('value'));
    		}
    	})
    	$(".receiveLetter").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".receiveLetter").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected')
    			$("#receiveLetter").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#receiveLetter").val($(this).attr('value'));
    		}
    	})
    	$(".ifrepay").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".ifrepay").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected');
    			$("#ifrepay").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#ifrepay").val($(this).attr('value'));
    		}
    	})
    	$(".objection_reason").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".objection_reason").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected');
    			$("#objection_reason").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#objection_reason").val($(this).attr('value'));
    		}
    	})
    	$(".attitude").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".attitude").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected')
    			$("#attitude").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#attitude").val($(this).attr('value'));
    		}
    	})
        $('#ContactUsers_repay_date').datepicker({
            showButtonPanel: true
        });
        $('#ContactUsers_sent_date').datepicker({
            showButtonPanel: true
        });
        $('#ContactUsers_objection_date').datepicker({
            showButtonPanel: true
        });
        /*
        var ue = UE.getEditor('editor1');
        <?php
            if($model->proceed){
                $model->proceed = str_replace(array("\r\n","\n"),"\\n",$model->proceed);
                $model->proceed = str_replace("\"","'",$model->proceed);
        ?>
            var content = "<?=$model->proceed?>";
            ue.ready(function() {
                ue.setContent(content);
            });
        <?php 
            }
        ?>
        */
    })
</script>