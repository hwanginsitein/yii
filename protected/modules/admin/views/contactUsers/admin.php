<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'搜索联系用户', 'url'=>array('search')),
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
		'phone2',
		'account_number',
		'office',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
            'viewButtonOptions'=>array('title'=>'查看'),  
            'updateButtonOptions'=>array('title'=>'修改'),
        	'deleteButtonOptions'=>array('title'=>'删除'),
		),
	),
)); ?>
