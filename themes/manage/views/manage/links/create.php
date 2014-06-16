<?php
/* @var $this LinksController */
/* @var $model Links */

$this->breadcrumbs=array(
	'Links'=>array('index'),
	'Create',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Links', 'url'=>array('manage'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Create Links</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>