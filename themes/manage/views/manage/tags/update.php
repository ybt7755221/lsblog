<?php
/* @var $this TagsController */
/* @var $model Tags */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Tags', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Update Tags <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>