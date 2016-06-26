<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */

$this->breadcrumbs = array(
    'Upload Docs' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => '上传欠费文档', 'url' => array('create')),
    array('label' => '上传缴费文档', 'url' => array('createPayDoc')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#upload-docs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>已上传欠费文档</h1>

<p>
    请用 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) 对字段进行数据搜索.
</p>

<?php //echo CHtml::link('高级搜索', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'upload-docs-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'uploader',
        'starttime',
        'endtime',
        'area',
        'comments',
        'type',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}'
        ),
    ),
));
?>
<a href="/admin/uploadDocs/create"><button>上传新文档</button></a>
