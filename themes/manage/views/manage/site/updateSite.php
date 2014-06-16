<?php
/* @var $this AblumController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Update Site',
);

$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Home', 'url'=>array( '/manage/Site/index' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
	array( 'label'=>'Update theme', 'url'=>array( 'Theme' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);

?>
<div class="container">
    <h2>Update Site</h2>
    <form class="form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl( '/manage/site/updateSite' ); ?>" >
        <?php foreach( $sites as $val ): ?>
        <div class="input-group">
                <span class="input-group-addon"><?php echo CHtml::encode($val['name']); ?></span>
            <?php if ( $val['html'] == 'select' ): ?>
                <select class="form-control" name="<?php echo $val['id']; ?>">
                    <?php echo Site::model()->getAllStatus(); ?>
                </select>
            <?php else: ?>
                <input class="form-control" type="<?php echo $val['html']; ?>" name="<?php echo $val['id']; ?>" value="<?php echo CHtml::encode( $val['value'] ) ?>" />
            <?php endif;?>
        </div>
        <br />
        <?php endforeach; ?>
        <div class="text-center">
            <input class="btn btn-lg btn-primary" type="submit" value="保存" />
        </div>
    </form>
</div>