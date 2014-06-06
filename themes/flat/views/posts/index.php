<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/base.js",CClientScript::POS_END);
$this->renderPartial( '../site/_topNav', array('cate_id' => $cate_id ) ); 
?>
<div class="bg-white" id="content" style="padding:0px;">
    <div class="container">
        <div class="row">
            <p class="col-sm-4 col-xs-12 text-center"> 
                <img src="<?php echo Yii::app()->baseUrl.CHtml::encode( $cateInfo['cate_image'] ); ?>" alt="<?php echo CHtml::encode( $cateInfo['cate_name'] ); ?>" style="width:360px; height:240px;" class="img-responsive" alt="Responsive image" />
            </p>
            <article class="col-sm-8 col-xs-12 .text-con-cate">
                <h2 id="cateName" class="text-center text-brown"><?php echo CHtml::encode( $cateInfo['cate_name'] ); ?></h2>
                <p class="text-center text-brown" ><?php echo CHtml::encode( $cateInfo['description'] ); ?></p>
            </article>
        </div> 
    </div>
</div>
<div class="hang"></div>
<div class="container">  
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <?php $this->renderPartial( '_list', array( 'posts' => $posts, 'pages' => $postsCount, 'cate_name' => $cateInfo['cate_name'] ) );?>
            <?php if( $noPage ){?>
            <div class="col-md-12 col-xs-12 text-center">
            <?php if( isset( $is_tag ) ){ ?>
                <button onclick="ajaxTagPager( 'prev', <?php echo $is_tag; ?> )" class="btn bg-gold text-brown">上一页</button>
                <button onclick="ajaxTagPager( 'next', <?php echo $is_tag; ?> )" class="btn bg-gold text-brown">下一页</button>
            <?php }else { ?>
                <button onclick="ajaxPager( 'prev' )" class="btn bg-gold text-brown">上一页</button>
                <button onclick="ajaxPager( 'next' )" class="btn bg-gold text-brown">下一页</button>
            <?php } ?>
            </div>
            <?php } ?>
        </div>
        <div class="col-sm-4 col-xs-12">
           <?php $this->renderPartial( '_rightMenu', array('rightMenu' => $rightMenu ) ); ?>
        </div>
    </div>
</div>
<p id="category" style="display: none;" ><?php echo $cate_id; ?></p>
<div class="hang clearfix"></div>
