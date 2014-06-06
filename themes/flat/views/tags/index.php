<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/base.js",CClientScript::POS_END);
$this->renderPartial( '../site/_topNav', array('cate_id' => -2 ) ); 
?>
<div class="hang"></div>
<div class="container">  
    <div class="row">
        <div class="col-sm-3 col-xs-12">
            <ul class="list-unstyled list-group">
                <li class="list-group-item text-center bg-gold">文章标签</li>
                <li class="list-group-item">
                    <div class="row">
                        <?php if( !empty( $tags ) ){ foreach( $tags as $val ): ?>
                            <span class="label col-tag bg-gold"><a class="text-brown" href="<?php echo Yii::app()->createUrl( '/tags/index', array( 'id' => $val['id'], 'name' => $val['tagname'] ) ); ?>"><?php echo CHtml::encode( $val['tagname'] ); ?></a></span>
                        <?php endforeach; } ?>
                    </div>
                </li>
            </ul>
            
            <ul class="list-unstyled list-group">
                <li class="list-group-item text-center bg-gold">最新博文</li>
                 <?php if( !empty( $hotPosts ) ){ foreach( $hotPosts as $val ): ?>
                    <a class="list-group-item text-center" href="<?php echo Yii::app()->createUrl( '/posts/view', array( 'id' => $val['id'] ) ); ?>" ><small class="text-brown"><?php echo CHtml::encode( $val['title'] ); ?></small></a>
                 <?php endforeach; } ?>
            </ul>
        </div>
        <div class="col-sm-9 col-xs-12">
            <?php $this->renderPartial( '_list', array( 'posts' => $posts, 'pages' => $postsCount ) );?>
            <?php if( !$noPage ){?>
            <div class="col-md-12 col-xs-12">
                <button onclick="ajaxTagPager( 'prev' )" class="btn bg-gold text-brown">上一页</button>
                <button onclick="ajaxTagPager( 'next' )" class="btn bg-gold text-brown">下一页</button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<p id="tag" style="display: none;" ><?php echo $tag_id; ?></p>
<div class="hang clearfix"></div>
