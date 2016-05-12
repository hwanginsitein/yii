<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'添加联系用户', 'url'=>array('create')),
	array('label'=>'修改联系用户', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除联系用户', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理联系用户', 'url'=>array('admin')),
);
?>

<h1>View联系用户 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'debt_money',
		'ID_number',
		'phone1',
		'phone1_status',
		'phone2',
		'phone2_status',
		'phone3',
		'region',
		'address',
		'account_number',
		'status',
		'sendLetter',
		'sent_date',
		'receiveLetter',
		'ifrepay',
		'repay_date',
		'repay_money',
		'attitude',
		'objection_reason',
		'ifvalid',
		'otherComments',
		'proceed',
	),
)); ?>
