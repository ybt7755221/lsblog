<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Manage',
);
?>
<h1>Manage Comments</h1>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
    'noshow'=>$number,
)); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comments-grid',
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
        'posts.title',
        'author',
        'author_ip',
		'author_webroot',
		'author_email',
        'comment_content',
        array(
            'name' => 'is_show',
            'value' => 'Comments::model()->isShow( $data->is_show )',
        ),
        'comment_date',
		/*
		'comment_date',
		'comment_content',
		'is_show',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}{statusF}{statusT}',
            'buttons' => array(
                'statusF' => array  
    			(  
        			'label'=>'禁止发布',  
                    'imageUrl' => Yii::app()->theme->baseUrl.'/images/F.png',
        			'url'=>'Yii::app()->createUrl( "/manage/Comments/isShow", array( "show" => "FALSE", "comid" => $data->id ) )',  
        			'visible'=>'$data->is_show == "TRUE"',   
    			),
                'statusT' => array  
    			(  
        			'label'=>'通过审核',  
        			'url'=>'Yii::app()->createUrl( "/manage/Comments/isShow", array( "show" => "TRUE", "comid" => $data->id ) )',
                    'imageUrl' => Yii::app()->theme->baseUrl.'/images/T.png', 
        			'visible'=>'$data->is_show == "FALSE"', 
    			),
            ),  
		),
	),
)); ?>
