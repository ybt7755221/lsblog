<?php
/* @var $this LinksController */
/* @var $model Links */

$this->breadcrumbs=array(
	'Links'=>array('index'),
	'Manage',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Create Links', 'url'=>array('create'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Manage Links</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'links-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'pager'=>array(  
            'class'=>'myPager',  
            'header'=>'',  
            'prevPageLabel'=>'上一页',  
            'nextPageLabel'=>'下一页',  
            //'cssFile'=>'',  
    ),
	'columns'=>array(
		'id',
		'url',
		'lname',
		'mage',
		'description',
		'visible',
		/*
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
