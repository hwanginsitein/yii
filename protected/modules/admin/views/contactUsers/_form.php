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
<?php
	$id = $_GET['id'];
	$debtor = Debts::model()->findByPk($id);
?>
	<?php echo $form->errorSummary($model); ?>
<div class="span1">
	<div class="row">
		<span class="label1">名字：</span><?php echo $form->textField($model,'name',array('size'=>12,'maxlength'=>12,'disabled'=>'disabled')); ?>
	</div>

	<div class="row">
		<span class="label1">欠费金额：</span><?php echo $form->textField($model,'debt_money',array('disabled'=>'disabled')); ?>
	</div>

	<div class="row">
		<span class="label1">身份证：</span>
		<?=substr_replace($model->ID_number,"********",-12,8)?>
	</div>

	<div class="row">
		<span class="label1">地区：</span><?=$model->region;?>
	</div>

	<div class="row">
		<span class="label1">地址：</span><?php echo $form->textField($model,'address',array('size'=>30,'disabled'=>'disabled')); ?>
	</div>

	<div class="row">
		<span class="label1">缴费编号：</span>
		<?php echo $form->textField($model,'account_number',array('size'=>15,'maxlength'=>15,'disabled'=>'disabled')); ?>
	</div>
	<div class="row">
		<span class="label1">欠费号码：</span>
		<?php
		echo $debtor->telephone;
		?>
	</div>
	<div class="row">
		<span class="label1">停机日期：</span>
		<?=$model->overdue_time;?>
	</div>
	<div class="row">
		<span class="label1">委托人：</span>
		<?=$debtor->clientele;?>
	</div>
	<div class="row">
		<span class="label1">律师函编号：</span>
		<?=$model->letterNumber;?>
	</div>
	<div class="row">
		<span class="label1">营业厅：</span>
		<?=$debtor->office;?>
	</div>
	<div class="row">
		<span class="label1">营业厅经理：</span>
		<?=$debtor->manager;?>
	</div>
	<div class="row">
		<span class="label1">当前状态：</span>
		<?php echo $form->dropDownList($model,'status',array("0"=>"待审核","1"=>"通过"),
                    array('prompt' => '请选择')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
</div>
<!--
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
-->
<div class="span2">
	<table border="0">
		<tr>
			<td><label><font size="4">联系用户</font></label></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<div class="row">
					<label for="ContactUsers_phone1">联系电话</label>
					<input size="20" maxlength="30" name="ContactUsers[phone1]" id="ContactUsers_phone1" type="text" 
					value="<?=$model->phone1?>">
				</div>
				<div class="row">
					<label for="ContactUsers_phone2">新的联系方式</label>
					<input size="20" maxlength="30" name="ContactUsers[phone2]" id="ContactUsers_phone2" type="text" 
					value="<?=$model->phone2?>">
				</div>
			</td>
			<td>
				<div style="margin-top:-10px;">
					<div style="float:left;width:70px;" class="contact size1 phone1_status <?php if($model->phone1_status==1){echo 'selected';}?>" value=1>可以接通</div>
					<div style="float:left" class="notcontact size1 phone1_status <?php if($model->phone1_status==0 && isset($model->phone1_status)){echo 'selected';}?>" value=0>无法接通</div>
				</div>
				<div style="height:10px;"></div>
				<div style="margin-top:40px;">
					<div style="float:left;width:70px;" class="contact size1 phone2_status <?php if($model->phone2_status==1){echo 'selected';}?>" value=1>可以接通</div>
					<div style="float:left" class="notcontact size1 phone2_status <?php if($model->phone2_status==0 && isset($model->phone2_status)){echo 'selected';}?>" value=0>无法接通</div>
				</div>
			</td>
		</tr>
		<tr>
			<td><label><font size="4">用户反馈</font></label></td>
			<td></td>
		</tr>
		<tr>
			<td><label>是否收到律师函：</label></td>
			<td>
				<span class="contact size2 receiveLetter <?php if($model->receiveLetter==1){echo 'selected';}?>" value=1>已收到律师函</span>
				<span class="notcontact size2 receiveLetter <?php if($model->receiveLetter==2 && isset($model->receiveLetter)){echo 'selected';}?>" value=2>地址不详，没有寄送律师函</span>
				<span class="notcontact size2 receiveLetter <?php if($model->receiveLetter==3 && isset($model->receiveLetter)){echo 'selected';}?>" value=3>用户拒收律师函</span>
				<span class="notcontact size2 receiveLetter <?php if($model->receiveLetter==4 && isset($model->receiveLetter)){echo 'selected';}?>" value=4>律师函被退回</span>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td><label>是否愿意缴费：</label></td>
			<td>
				<span class="contact size1 attitude <?php if($model->attitude==1){echo 'selected';}?>" value=1>愿意缴费</span>
				<span class="notcontact size3 attitude <?php if($model->attitude===0 && isset($model->attitude)){echo 'selected';}?>" value=0>不愿意缴费</span>
				<span class="red size1 attitude <?php if($model->attitude=="-1"){echo 'selected';}?>" value="-1">拒不缴费态度恶劣</span>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td><label>用户提出异议，异议理由：</label></td>
			<td>
				<div style="margin-top:10px">
					<span class="objection size1 objection_reason <?php if($model->objection_reason=="手机被盗"){echo 'selected';}?>" value="手机被盗">手机被盗</span>
					<span class="notcontact size2 objection_reason <?php if($model->objection_reason=="欠费没那么多"){echo 'selected';}?>" value="欠费没那么多">欠费没那么多</span>
					<span class="">
						<span>其他理由</span>
						<input size="20" maxlength="255" name="ContactUsers[otherObjection]" id="ContactUsers_otherObjection" 
						type="text" value="<?=$model->otherObjection?>">
					</span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
				<label>异议处理</label>
			</td>
			<td>
				<span class="contact size1 ifvalid <?php if($model->ifvalid==1){echo 'selected';}?>" value=1>成立</span>
				<span class="notcontact size3 ifvalid <?php if($model->ifvalid==0 && isset($model->ifvalid)){echo 'selected';}?>" value=0>不成立</span>
				<span>处理内容：<input type="text" name="ContactUsers[objection_handle]"></span>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
				<span class="contact ifrepay size4 <?php if($model->ifrepay=="1"){echo 'selected';}?>" value=1>已缴费</span>
			</td>
			<td>
				<div style="float:left">
					<div><label for="ContactUsers_repay_money">缴费金额</label></div>
					<div class="">
						<input name="ContactUsers[repay_money]" id="ContactUsers_repay_money" type="text" value="<?=$model->repay_money?>" size="6">
					</div>
				</div>
				<div style="float:left;margin-left:10px;">
					<div><label for="ContactUsers_repay_date">缴费日期</label></div>
					<div>
						<input name="ContactUsers[repay_date]" id="ContactUsers_repay_date" type="text" value="<?=$model->repay_date!='0000-00-00'?$model->repay_date:''?>">
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td><label>其他信息：</label></td>
			<td>
				<div>
					<input name="ContactUsers[otherComments]" id="ContactUsers_otherComments" type="text" value="<?=$model->otherComments?>" size=65>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : '保存，下一个'); ?>
	</div>
<input type="hidden" name="ContactUsers[phone1_status]" id="phone1_status" value="<?=$model->phone1_status?>">
<input type="hidden" name="ContactUsers[phone2_status]" id="phone2_status" value="<?=$model->phone2_status?>">
<input type="hidden" name="ContactUsers[receiveLetter]" id="receiveLetter" value="<?=$model->receiveLetter?>">
<input type="hidden" name="ContactUsers[ifrepay]" id="ifrepay" value="<?=$model->ifrepay?>">
<input type="hidden" name="ContactUsers[ifvalid]" id="ifvalid" value="<?=$model->ifvalid?>">
<input type="hidden" name="ContactUsers[objection_reason]" id="objection_reason" value="<?=$model->objection_reason?>">
<input type="hidden" name="ContactUsers[attitude]" id="attitude" value="<?=$model->attitude?>">
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
    	$(".phone2_status").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".phone2_status").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected');
    			$("#phone2_status").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#phone2_status").val($(this).attr('value'));
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
    	$(".ifvalid").click(function(){
    		var hasclass = $(this).hasClass('selected');
    		$(".ifvalid").removeClass('selected');
    		if(hasclass){
    			$(this).removeClass('selected');
    			$("#ifvalid").val("");
    		}else{
    			$(this).addClass('selected');
    			$("#ifvalid").val($(this).attr('value'));
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
		$('form').submit(function(){
			if($('#ContactUsers_repay_money').val() != '' || $('#ContactUsers_repay_date').val() != ''){
				if($('#ifrepay').val() == ''){
					layer.msg('请点击已缴费');return false;
				}
			}
		})
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