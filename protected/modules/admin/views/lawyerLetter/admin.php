<?php
/* @var $this LawyerLetterController */
/* @var $model LawyerLetter */

$this->breadcrumbs=array(
	'Lawyer Letters'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create LawyerLetter', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lawyer-letter-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lawyer Letters</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lawyer-letter-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'letter_name',
		'subject',
		'description',
		'content',
		'debtor_name',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
