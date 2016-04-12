<?php
/* @var $this LawyerLetterController */
/* @var $model LawyerLetter */

$this->breadcrumbs=array(
	'Lawyer Letters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create LawyerLetter', 'url'=>array('create')),
	array('label'=>'Update LawyerLetter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LawyerLetter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LawyerLetter', 'url'=>array('admin')),
);
?>

<h1>View LawyerLetter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'letter_name',
		'subject',
		'description',
		'content',
		'debtor_name',
		'debtor_ID',
		'creditor_name',
		'creditor_ID',
		'owe_money',
		'reason',
		'status',
		'lawyer',
		'client',
		'addressee',
		'reply_id',
	),
)); ?>
