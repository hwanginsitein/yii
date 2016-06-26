<?php
/* @var $this ContactUsersController */
/* @var $data ContactUsers */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debt_money')); ?>:</b>
	<?php echo CHtml::encode($data->debt_money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_number')); ?>:</b>
	<?php echo CHtml::encode($data->ID_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone1')); ?>:</b>
	<?php echo CHtml::encode($data->phone1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone1_status')); ?>:</b>
	<?php echo CHtml::encode($data->phone1_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone2')); ?>:</b>
	<?php echo CHtml::encode($data->phone2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone2_status')); ?>:</b>
	<?php echo CHtml::encode($data->phone2_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone3')); ?>:</b>
	<?php echo CHtml::encode($data->phone3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_number')); ?>:</b>
	<?php echo CHtml::encode($data->account_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sendLetter')); ?>:</b>
	<?php echo CHtml::encode($data->sendLetter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sent_date')); ?>:</b>
	<?php echo CHtml::encode($data->sent_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiveLetter')); ?>:</b>
	<?php echo CHtml::encode($data->receiveLetter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ifrepay')); ?>:</b>
	<?php echo CHtml::encode($data->ifrepay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('repay_date')); ?>:</b>
	<?php echo CHtml::encode($data->repay_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('repay_money')); ?>:</b>
	<?php echo CHtml::encode($data->repay_money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attitude')); ?>:</b>
	<?php echo CHtml::encode($data->attitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('objection_reason')); ?>:</b>
	<?php echo CHtml::encode($data->objection_reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ifvalid')); ?>:</b>
	<?php echo CHtml::encode($data->ifvalid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('otherComments')); ?>:</b>
	<?php echo CHtml::encode($data->otherComments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proceed')); ?>:</b>
	<?php echo CHtml::encode($data->proceed); ?>
	<br />
</div>