<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array('label'=>'List Posts', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' )),
);
?>

<h1>Update Posts <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>