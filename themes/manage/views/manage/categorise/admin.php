<?php
/* @var $this CategoriseController */
/* @var $model Categorise */

$this->breadcrumbs=array(
	'Categorises'=>array('index'),
	'Manage',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Create Category', 'url'=>array('create'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Manage Categorises</h1>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categorise-grid',
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
		'cate_name',
		'cate_english',
		'description',
		'cate_image',	
                array(
                    'name' => 'type',
                    'value' => 'Categorise::model()->getType( "$data->type" )',
                ),
                array(
                    'name' => 'visible',
                    'value' => 'Categorise::model()->getVisible( "$data->visible" )',
                ),
                        /*
                        'cate_order',
                        'visible',
                        'path',
                        */
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',
                ),
	),
)); ?>
