<?php
/* @var $this RepayController */
/* @var $model Repay */

$this->breadcrumbs=array(
	'Repays'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'缴费列表', 'url'=>array('index')),
	array('label'=>'添加缴费', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#repay-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>缴费管理</h1>

<p>
请用 (<, <=, >, >=, <> or =) 对字段进行数据搜索.
</p>

<?php echo CHtml::link('高级管理','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'repay-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'paid_ID',
		'payId',
		'paid_money',
		'docsId',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
