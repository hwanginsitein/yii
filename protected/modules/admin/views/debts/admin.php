<?php
/* @var $this DebtsController */
/* @var $model Debts */

$this->breadcrumbs=array(
	'Debts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'欠债数据管理', 'url'=>array('index')),
	array('label'=>'新建欠债数据', 'url'=>array('create')),
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

<h1>欠债数据管理</h1>

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
            'viewButtonOptions'=>array('title'=>'查看'),  
            'updateButtonOptions'=>array('title'=>'修改'),
        	'deleteButtonOptions'=>array('title'=>'删除'),
		),
	),
)); ?>
