<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
	<meta name='keywords' content='<?php echo CHtml::encode( KEYBORAD ); ?>' />
	<meta name='description' content='<?php echo CHtml::encode( DESCRIPTION ); ?>'/>
	<meta name='copyright' content="lsBlog_v2" />
	<meta name='author' content='<?php echo CHtml::encode( AUTHOR ); ?>' />
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8;" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/manage.css" rel="stylesheet" media="screen" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="container" id="page">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Yii::app()->createAbsoluteUrl( '/' ); ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
            </div>
            <div class="collapse navbar-collapse">
                <?php $this->widget('zii.widgets.CMenu',array(
        			'items'=>array(
                        array('label'=>'Home', 'url'=>array( Yii::app()->homeUrl ), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Users', 'url'=>array('/manage/Users/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'categorise', 'url'=>array('/manage/categorise/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Posts', 'url'=>array('/manage/posts/index'), 'visible'=>!Yii::app()->user->isGuest),
        				array('label'=>'Comments', 'url'=>array('/manage/Comments/index'), 'visible'=>!Yii::app()->user->isGuest),
        				array('label'=>'ablum', 'url'=>array('/manage/ablum/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Tags', 'url'=>array('/manage/tags/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'links', 'url'=>array('/manage/links/index'), 'visible'=>!Yii::app()->user->isGuest),
       				),
                    'htmlOptions' => array('class' => 'nav navbar-nav'),
        		)); ?>
                <?php $this->widget('zii.widgets.CMenu',array(
        			'items'=>array(
   				         array('label'=>'Login', 'url'=>array('/manage/default/login'), 'visible'=>Yii::app()->user->isGuest),
       				     array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/manage/default/logout'), 'visible'=>!Yii::app()->user->isGuest)
        			),
                    'htmlOptions' => array('class' => 'nav navbar-nav navbar-right'),
        		)); ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
<?php if( isset( $this->breadcrumbs ) ):?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'htmlOptions' => array( 'class' => 'breadcrumb' ),
    )); ?>
<?php endif?>
<?php echo $content; ?>
</div><!-- page -->
<footer class="footer">
web footer
</footer>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.8.3.min.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
</body>
</html>
