<?php
/* @var $this TagsController */
/* @var $model Tags */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Create',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Tags', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Create Tags</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>