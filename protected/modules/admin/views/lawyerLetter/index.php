<?php
/* @var $this LawyerLetterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lawyer Letters',
);

$this->menu=array(
	array('label'=>'Create LawyerLetter', 'url'=>array('create')),
	array('label'=>'Manage LawyerLetter', 'url'=>array('admin')),
);
?>

<h1>Lawyer Letters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
