<?php
$this->menu=array(
    array( 'label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array( 'label'=>'Update Site', 'url'=>array( 'updateSite' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
	array( 'label'=>'Update theme', 'url'=>array( 'Theme' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array( 'label'=>'Flush Site', 'url'=>array( 'flushSite' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array( 'label'=>'Flush Cache', 'url'=>array( 'DelCache' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
);
?>
<div class="row">

    <?php if( !empty($commentNum) ): ?>
    <div class="col-md-12 col-xs-12 panel panel-default bg-gray text-center">
        <a href="<?php echo Yii::app()->createUrl( '/manage/Comments/admin', array( 'Comments[is_show]' => 'FALSE' ) ); ?>" >您有<?php echo CHtml::encode( $commentNum ); ?>条回复需要审核</a>.
    </div>
    <?php endif;?>
    
    <ul class="col-md-12 col-xs-12 list-group list-unstyled">
        <li class="list-group-item bg-block">基本配置</li>
        <?php foreach( $sites as $val ): ?>
        <li class="list-group-item">
            <?php 
                if ( $val['variate'] == 'site_status' )
                    echo '<strong>'.CHtml::encode( $val['name'] ).'&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.Site::model()->getWebStatus($val['value']); 
                else if ( $val['type'] == 2 )
                    echo '<strong>页面模版&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::encode( $val['name'] ).' ( '.CHtml::encode( $val['value'] ).' )';
                else    
                    echo '<strong>'.CHtml::encode( $val['name'] ).'&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::encode( $val['value'] ); 
                
            ?>
        </li>
        <?php endforeach;?>
    </ul>
   <ul class="col-md-12 col-xs-12 list-group list-unstyled">
        <li class="col-md-12 col-xs-12 list-group-item bg-block">详细内容</li>
        <?php foreach( $total as $val ): ?>
        <li class="col-md-6 col-xs-12 list-group-item"><?php echo '<strong>'.CHtml::encode( $val['name'] ).'&nbsp;&nbsp;:</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.CHtml::encode( $val['value'] ); ?></li>
        <?php endforeach;?>
   </ul>
</div>
<div class="height"></div>

