<?php
/* @var $this LawyerLetterController */
/* @var $model LawyerLetter */

$this->breadcrumbs=array(
	'Lawyer Letters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage LawyerLetter', 'url'=>array('admin')),
);
?>

<h1>Create LawyerLetter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>