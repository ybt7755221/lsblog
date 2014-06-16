<?php
/* @var $this CategoriseController */
/* @var $model Categorise */

$this->breadcrumbs=array(
	'Categorises'=>array('index'),
	'Create',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Category', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Create Category</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>