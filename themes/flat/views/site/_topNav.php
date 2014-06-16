<header>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="text-white">导航</span>
          </button>
          <a class="navbar-brand text-white" href="<?php echo Yii::app()->homeUrl; ?>"><?php echo CHtml::encode( Yii::app()->name ); ?></a>
        </div>
        <div class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <?php $this->widget('zii.widgets.CMenu',array(
            			'items'=> Categorise::model()->getItems( $cate_id ),
                        'htmlOptions' => array('class' => 'nav navbar-nav'),
                )); ?>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
</div>
</header>
<?php if(isset($this->breadcrumbs)):?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
    )); ?><!-- breadcrumbs -->
<?php endif?>