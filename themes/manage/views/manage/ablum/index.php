<?php
/* @var $this AblumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ablums',
);

$this->menu=array(
	array('label'=>'Create Ablum', 'url'=>array('create')),
	array('label'=>'Manage Ablum', 'url'=>array('index')),
);
?>

<h1>Ablums</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
