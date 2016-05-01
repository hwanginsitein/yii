<?php
/* @var $this RepayController */
/* @var $data Repay */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paid_ID')); ?>:</b>
	<?php echo CHtml::encode($data->paid_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payId')); ?>:</b>
	<?php echo CHtml::encode($data->payId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paid_money')); ?>:</b>
	<?php echo CHtml::encode($data->paid_money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('docsId')); ?>:</b>
	<?php echo CHtml::encode($data->docsId); ?>
	<br />


</div>