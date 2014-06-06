<?php
/* @var $this CategoriseController */
/* @var $model Categorise */

$this->breadcrumbs=array(
	'Categorises'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categorise', 'url'=>array('index')),
	array('label'=>'Create Categorise', 'url'=>array('create')),
);
?>

<h1>Update Categorise <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>