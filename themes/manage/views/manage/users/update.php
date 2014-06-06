<?php
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl."/js/base.js", CClientScript::POS_END );
$this->breadcrumbs=array(
    'User' => array( '/manage/Users/index' ),
    'Update User',
);

$this->menu=array(
    array('label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array('label'=>'user', 'url'=>array( '/manage/users/userLogo' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array('label'=>'Update Password', 'url'=>'javascript:void(0);', 'itemOptions' => array( 'class' => 'list-group-item', 'data-toggle' => "modal", 'data-target' => "#myModal" ) ),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php $this->renderPartial( '_updatePasswd' ); ?>