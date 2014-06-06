<?php
$this->renderPartial( '../site/_topNav', array('cate_id' => '-1' ) ); 
?>
<div class="bs-gold-header" id="content">
    <div class="container">
        <div class="row">
            <p class="col-sm-4 col-xs-12 text-center"> 
                <img src="<?php echo Yii::app()->baseUrl.CHtml::encode( $ablum['cover'] ); ?>" alt="<?php echo CHtml::encode( $ablum['ablum_name'] ); ?>" style="max-width:360px; max-height:300px;" class="img-responsive" alt="Responsive image" />
            </p>
            <article class="col-sm-8 col-xs-12 .text-con-cate">
                <h2 id="cateName" class="text-center">相册名称 : <?php echo CHtml::encode( $ablum['ablum_name'] ); ?></h2>
                <p><?php echo CHtml::encode( $ablum['information'] ); ?></p>
                <p>发布时间 : <?php echo date( 'Y-m-d H:i:s' ,$ablum['ctime'] ); ?></p>
            </article>
        </div> 
    </div>
</div>
<div class="container">
    <div class="row">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php for ( $i = 0; $i < $imageCount; $i++ ) {?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="active"></li>
            <?php } ?>
          </ol>
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner text-center">
            <?php foreach( $images as $idx => $val ){?>
            <div class="item <?php if( $idx == 0 ) { echo 'active';} ?> text-center">
              <img class="img-responsive" src="<?php echo Yii::app()->baseUrl.$val['path'] ?>" alt="<?php echo CHtml::encode( $ablum['ablum_name'] ); ?>" style="margin: 0 auto; max-width:800px;" />
              <div class="carousel-caption">
                <?php echo CHtml::encode( $val['backup'] ); ?>
              </div>
            </div>
            <?php }?>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
        </div>
    </div>
</div>
<?php if ( !empty( $images ) ){  ?>
<script>
    $('.carousel').carousel({
        interval: 2000
    })
</script>
<?php } ?>