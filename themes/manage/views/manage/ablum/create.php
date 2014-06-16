<?php
/* @var $this AblumController */
/* @var $model Ablum */

$this->breadcrumbs=array(
	'Ablums'=>array('index'),
	'Create',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Album', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Create Ablum</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>