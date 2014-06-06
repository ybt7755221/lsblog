<?php
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl."/js/base.js", CClientScript::POS_END );
$this->breadcrumbs=array(
    'Update Theme',
);

$this->menu=array(
    array('label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
    array('label'=>'Home', 'url'=>array('/manage/Site/index'), 'itemOptions' => array( 'class' => 'list-group-item' )),
	array('label'=>'Update Site', 'url'=>array('updateSite'), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);

?>
<h1>Update Site</h1>
<form class="form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl('/manage/site/theme'); ?>" >
    <div class="row">
        <?php foreach( $sites as $val ): ?>
        <div class="col-sm-6 col-md-4 col-xs-12">
            <div class="thumbnail">
                <img src="<?php echo Yii::app()->baseUrl; ?>/themes/<?php echo $val['value']; ?>/demo.jpg"  data-src="holder.js/300x200" alt="..." />
                <div class="caption">
                    <?php if( $val['is_show'] == 1 ):?>  
                        <h3>
                            <input type="radio" name="theme_id" value="<?php echo $val['id']; ?>" id="theme_<?php echo $val['id']; ?>" checked="checked" />
                            <?php echo CHtml::encode( $val['name'] ); ?>
                        
                    <?php else:?>
                        <h3>
                            <input type="radio" name="theme_id" value="<?php echo $val['id']; ?>" id="theme_<?php echo $val['id']; ?>"  />
                            <?php echo CHtml::encode( $val['name'] ); ?>
                        </h3>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="height"></div>
    <div class="center">
        <input id="button" class="btn btn-lg btn-primary" type="button" name="sub" value="保存模版" />
    </div>
</form>