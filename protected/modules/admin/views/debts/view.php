<?php
/* @var $this DebtsController */
/* @var $model Debts */

$this->breadcrumbs=array(
	'Debts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Debts', 'url'=>array('index')),
	array('label'=>'Create Debts', 'url'=>array('create')),
	array('label'=>'Update Debts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Debts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Debts', 'url'=>array('admin')),
);
?>

<h1>View Debts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'debt_number',
		'docsId',
		'clientele',
		'debtor',
		'ID_number',
		'telephone',
		'account_number',
		'debt_money',
		'overdue_time',
		'ifpay',
		'status',
	),
)); ?>
