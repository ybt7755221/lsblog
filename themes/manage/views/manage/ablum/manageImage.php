<?php
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl."/js/base.js", CClientScript::POS_END );
$this->breadcrumbs=array(
	'Ablums'=>array('index'),
	'Image Manage'
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'List Album', 'url'=>array('index'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array( 'label'=>'Update Album', 'url'=>array( 'update', 'id' => $aid ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array( 'label'=>'Add Images', 'url'=>'#imgModal', 'itemOptions' => array( 'data-toggle' => "modal", 'class' => 'list-group-item' ) ),

);
?>

<h1><small>相册《<?php echo CHtml::encode( $ablumName ); ?>》的所有图片</small></h1>
<div class="well row" >
    <div class="col-md-8 col-xs-12">
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
        array(
            'id'=>'uploadFile',
            'config'=>array(
                   'action'=>Yii::app()->createUrl('manage/ablum/uploadImg',array('aid'=>$aid)),
                   'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                   'sizeLimit'=>2*1024*1024,// maximum file size in bytes
                   'minSizeLimit'=>1*1024,
                   'auto'=>true,
                   'multiple' => true,
                   'onComplete'=>"js:function(id, fileName, responseJSON){ }",
                   'messages'=>array(
                                    'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                    'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                    'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                    'emptyError'=>"{file} is empty, please select files again without it.",
                                    'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                   ),
                   'showMessage'=>"js:function(message){ alert(message); }"
            )
        ));
    ?>
    </div>
    <div class="col-md-4 col-xs-12">
    <a class="btn btn-default" onclick="location.reload()" >更新相册</a>
    <a class="btn btn-default" href="<?php echo Yii::app()->createUrl( '/manage/Ablum/DelAllImage', array( 'aid' => $aid, 'name'=>CHtml::encode( $ablumName ) ) ); ?>" >删除所有照片</a>
    </div>
</div>
<div class="row">
<?php foreach( $images as $idx => $value ): ?>
    <div class="col-sm-6 col-md-3 col-xs-6 ">
        <div class="thumbnail">
            <img src="<?php echo Yii::app()->baseUrl.CHtml::encode( $value['path'] ); ?>" width="180px" height="220px" alt="<?php echo CHtml::encode( $ablumName ); ?>" />
            <div class="caption bg-gray">
                <p><input id="backup<?php echo $value['id'] ?>" name="backup" value="<?php echo CHtml::encode( $value['backup'] ); ?>" /></p>
                <p class="text-center" >
                    <a href="javascript:void(0);" onclick="saveBackUp( <?php echo $value['id']; ?> )" class="btn btn-default" role="button">添加备注</a>
                    <a href="<?php echo Yii::app()->createUrl( '/manage/Ablum/DelImage', array( 'aid' => $aid, 'id' => $value['id'], 'name'=>CHtml::encode( $ablumName ) ) ); ?>" class="btn btn-default" role="button">Delete</a>
                </p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>