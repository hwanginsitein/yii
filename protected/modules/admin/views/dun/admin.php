<?php
/* @var $this DunController */
/* @var $model Dun */

$this->breadcrumbs=array(
	'Duns'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'创建分配任务', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#dun-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>分配任务</h1>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dun-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'uid',
        array(
            'header'=>'催缴人员','name'=>'uid','value'=>'User::model()->findbypk($data->uid)->username'
        ),
        array(
            'header'=>'真名','name'=>'uid','value'=>'User::model()->findbypk($data->uid)->realname'
        ),
		//'docId',
        array(
            'header'=>'文档名','name'=>'docId','value'=>'UploadDocs::model()->findbypk($data->docId)->upload_name'
        ),
		'cdate',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
