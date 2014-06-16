<?php
/* @var $this AblumController */
/* @var $model Ablum */

$this->breadcrumbs=array(
	'Ablums'=>array('index'),
	'Manage',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Create Album', 'url'=>array('create'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Manage Ablums</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ablum-grid',
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
		'ablum_name',
		'cover',
		'information',
        array(
            'name' => 'status',
            'value' => 'Ablum::model()->getStatus( $data->status )',
        ),
        array(
            'name' => 'ctime',
            'value' => 'date( "Y-m-d H:i:s", $data->ctime )',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}{imageBut}',
            'buttons' => array(
                'imageBut' => array  
    			(  
        			'label'=>'管理照片',  
                    'imageUrl' => Yii::app()->theme->baseUrl.'/images/T.png',
        			'url'=>'Yii::app()->createUrl( "/manage/ablum/manageImg", array( "id" => $data->id, "name" => $data->ablum_name ) )',
    			),
            ),  
		),
	),
)); ?>
