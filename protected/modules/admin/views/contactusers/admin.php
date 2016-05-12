<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'添加联系用户', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contact-users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理联系用户</h1>

<p>
请用 (<, <=, >, >=, <> or =) 对字段进行数据搜索.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contact-users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'debt_money',
		'ID_number',
		'phone1',
		//'phone1_status',
		'phone2',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
