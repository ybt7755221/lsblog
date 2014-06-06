<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array('label'=>'List Posts', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' )),
);
?>

<h1>Create Posts</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>