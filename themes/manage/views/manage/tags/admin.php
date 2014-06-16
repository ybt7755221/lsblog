<?php
$this->breadcrumbs=array(
	'Tags'=>array('index'),
	'Manage',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Create Tags', 'url'=>array('create'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Manage Tags</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tags-grid',
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
		'tagname',
		'description',
		'tag_order',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}', 
		),
	),
)); ?>
