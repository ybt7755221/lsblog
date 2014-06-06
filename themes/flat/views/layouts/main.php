<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
	<meta name='keywords' content='<?php echo KEYBORAD; ?>' />
	<meta name='description' content='<?php echo DESCRIPTION; ?>'/>
	<meta name='copyright' content="lsBlog_V2" />
	<meta name='author' content='<?php echo AUTHOR; ?>' />
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/base.css" rel="stylesheet" media="screen" />
    <title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
</head>
<body>

<!--header-->
<?php echo $content; ?>
<div class="clear"></div>
<!--footer-->
<footer class="well footer text-center bg-gold" style="margin:0;">
    <?php echo CHtml::encode( Yii::app()->name ); ?> 版权所有 © 2012-2014　<?php echo CHtml::encode( WEB_BAK ); ?>
</footer>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery-1.8.3.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.min.js"></script>
</body>
</html>
