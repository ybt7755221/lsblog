<?php
$this->pageTitle=Yii::app()->name;
$this->renderPartial( '_topNav', array('cate_id' => '' ) );
?>
<div class="user_top">
        <h1><?php echo Yii::app()->user->name; ?></h1>
        <img src="<?php echo $logo; ?>" alt="<?php echo Yii::app()->user->name; ?>" class="img-circle">
        <h2><small><?php echo $information; ?></small></h2>
        <ul class="row list-unstyled">
            <?php foreach ( $master as $key => $val ): ?>
                <li class="col-xs-4 col-md-4 col-lg-4 col-sm-6" ><?php echo Yii::t('site', $key).' : '.  CHtml::encode($val); ?></li>
            <?php endforeach; ?>
        </ul>
</div>
<div class="clear hang"></div>
<div class="container">
    <div class="row">
<?php foreach( $category as $idx => $val ): ?>
    <a href="<?php echo Yii::app()->createAbsoluteUrl( '/posts/index', array( 'id' => $val['id'] ) ); ?>">
    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12" style="margin-bottom: 10px;">
        <div class="row bg-white">
            <div class="col-xs-12 col-md-4 col-lg-4 col-sm-12" style="padding:0px;">
                <img src="<?php echo Yii::app()->baseUrl.$val['cate_image']; ?>" alt="<?php echo CHtml::encode( $val['cate_name'] ); ?>" style="width:360px; height:240px; margin: 0 auto;" class="img-responsive" alt="Responsive image" />
            </div>
            <div class="col-xs-12 col-md-8 col-lg-8 col-sm-12 text-center">
                <h3><?php echo CHtml::encode( $val['cate_name'] ); ?></h3>
                <p><?php echo CHtml::encode( $val['description'] ); ?></p>
            </div>
        </div>
    </div>
    </a>
<?php endforeach; ?>
</div>