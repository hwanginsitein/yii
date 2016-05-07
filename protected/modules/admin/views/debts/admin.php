<?php
/* @var $this DebtsController */
/* @var $model Debts */

$this->breadcrumbs=array(
	'Debts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Debts', 'url'=>array('index')),
	array('label'=>'Create Debts', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#debts-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Debts</h1>

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
	'id'=>'debts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'debt_number',
                array(
                    'header'=>'文档名','name'=>'docsId','value'=>'UploadDocs::model()->findbypk($data->docsId)->upload_name'
                ),
		'clientele',
		'debtor',
		'ID_number',
		/*
		'telephone',
		'account_number',
		'debt_money',
		'overdue_time',
		'all',
		'ifpay',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
