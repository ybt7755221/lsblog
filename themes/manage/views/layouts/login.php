<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
	<meta name='keywords' content='<?php echo CHtml::encode( KEYBORAD ); ?>' />
	<meta name='description' content='<?php echo CHtml::encode( DESCRIPTION ); ?>'/>
	<meta name='copyright' content="lsBlog_v2" />
	<meta name='author' content='<?php echo CHtml::encode( AUTHOR ); ?>' />
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
            </div>
            <div class="collapse navbar-collapse">
                <?php $this->widget('zii.widgets.CMenu',array(
        			'items'=>array(
                        array('label'=>'Home', 'url'=>array('/manage/Site/index'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'User', 'url'=>array('/manage/Users/index/1'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Posts', 'url'=>array('/manage/posts/manage'), 'visible'=>!Yii::app()->user->isGuest),
        				array('label'=>'Comments', 'url'=>array('/manage/Comments/manage'), 'visible'=>!Yii::app()->user->isGuest),
        				array('label'=>'ablum', 'url'=>array('/manage/ablum/manage'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Tags', 'url'=>array('/manage/tags/manage'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'links', 'url'=>array('/manage/links/manage'), 'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'categorise', 'url'=>array('/manage/categorise/manage'), 'visible'=>!Yii::app()->user->isGuest),
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
<div class="clearfix"></div>
</body>
</html>
