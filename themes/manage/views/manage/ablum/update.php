<?php
/* @var $this AblumController */
/* @var $model Ablum */

$this->breadcrumbs=array(
	'Ablums'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Album', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Update Ablum <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>