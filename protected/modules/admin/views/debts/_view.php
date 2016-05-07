<?php
/* @var $this DebtsController */
/* @var $data Debts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debt_number')); ?>:</b>
	<?php echo CHtml::encode($data->debt_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('docsId')); ?>:</b>
	<?php echo CHtml::encode($data->docsId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clientele')); ?>:</b>
	<?php echo CHtml::encode($data->clientele); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debtor')); ?>:</b>
	<?php echo CHtml::encode($data->debtor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_number')); ?>:</b>
	<?php echo CHtml::encode($data->ID_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('account_number')); ?>:</b>
	<?php echo CHtml::encode($data->account_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debt_money')); ?>:</b>
	<?php echo CHtml::encode($data->debt_money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('overdue_time')); ?>:</b>
	<?php echo CHtml::encode($data->overdue_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('all')); ?>:</b>
	<?php echo CHtml::encode($data->all); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ifpay')); ?>:</b>
	<?php echo CHtml::encode($data->ifpay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>