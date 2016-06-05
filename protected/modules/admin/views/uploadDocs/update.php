<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */

$this->breadcrumbs = array(
    'Upload Docs' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => '上传缴费文档', 'url' => array('create')),
    array('label' => '查看该缴费数据', 'url' => array('view', 'id' => $model->id)),
    array('label' => '管理缴费数据', 'url' => array('admin')),
);
?>

<h1>上传更新 <?=$model->area;?> 备注：<?=$model->comments;?> </h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>