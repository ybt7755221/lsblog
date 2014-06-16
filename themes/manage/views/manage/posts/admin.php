<?php
/* @var $this PostsController */
/* @var $model Posts */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Create Posts', 'url'=>array('create'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>

<h1>Manage Posts</h1>

<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'posts-grid',
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
		'title',
        array(
            'name' => 'cate_id',
            'value' => '$data->category->cate_name',
        ),
        array(
            'name' => 'status',
            'value' => 'Posts::model()->getStatusName($data->status)'
        ),
        array(
            'name' => 'comment_status',
            'value' => 'Posts::model()->getCommentStatusName($data->comment_status)',
        ),
        'comment_count',
        array(
            'name' => 'create_time',
            'value' =>'date( "Y-m-d H:i:s", $data->create_time)',
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}{statusF}{statusT}',
            'buttons' => array(
                'statusF' => array  
    			(  
        			'label'=>'禁止评论',  
                    'imageUrl' => Yii::app()->theme->baseUrl.'/images/F.png',
        			'url'=>'Yii::app()->createUrl( "/manage/Posts/CommentStatus", array( "cid" => 1, "postid" => $data->id ) )',  
        			'visible'=>'$data->comment_status == 0',   
    			),
                'statusT' => array  
    			(  
        			'label'=>'允许评论',  
        			'url'=>'Yii::app()->createUrl( "/manage/Posts/CommentStatus", array( "cid" => 0, "postid" => $data->id ) )',
                    'imageUrl' => Yii::app()->theme->baseUrl.'/images/T.png', 
        			'visible'=>'$data->comment_status == 1', 
    			),
            ),  
		),
	),
)); ?>
