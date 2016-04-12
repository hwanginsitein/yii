<?php
/* @var $this LawyerLetterController */
/* @var $data LawyerLetter */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('letter_name')); ?>:</b>
	<?php echo CHtml::encode($data->letter_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debtor_name')); ?>:</b>
	<?php echo CHtml::encode($data->debtor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debtor_ID')); ?>:</b>
	<?php echo CHtml::encode($data->debtor_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('creditor_name')); ?>:</b>
	<?php echo CHtml::encode($data->creditor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creditor_ID')); ?>:</b>
	<?php echo CHtml::encode($data->creditor_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owe_money')); ?>:</b>
	<?php echo CHtml::encode($data->owe_money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lawyer')); ?>:</b>
	<?php echo CHtml::encode($data->lawyer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client')); ?>:</b>
	<?php echo CHtml::encode($data->client); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressee')); ?>:</b>
	<?php echo CHtml::encode($data->addressee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reply_id')); ?>:</b>
	<?php echo CHtml::encode($data->reply_id); ?>
	<br />

	*/ ?>

</div>