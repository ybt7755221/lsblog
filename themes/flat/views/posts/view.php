<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/base.js",CClientScript::POS_END);
$this->renderPartial( '../site/_topNav', array('cate_id' => $post['cate_id'] ) ); 
?>
<div class="bg-white" id="content" style="padding:0px;">
    <div class="container">
        <div class="row">
            <article class=".text-con-cate">
                <h2 id="cateName" class="text-center text-brown"><?php echo CHtml::encode( $post['title'] );?></h2>
                <p class="text-center text-excerpt text-grayh" ><?php echo CHtml::encode( $post['excerpt'] ); ?></p>
            </article>
            <div class="hang"></div>
            <div class="hang"></div>
        </div> 
    </div>
</div>
<div class="hang"></div>
<div class="container">  
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center bg-white panel-small">
                        <p class="text-left artile-tag text-grayh">author: <?php echo CHtml::encode( $post['nickname'] );?> | <?php echo date( 'Y-m-d H:i:s', $post['create_time'] );?> 发布 | <?php echo $post['comment_count']; ?> comments</p>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body post-content" style="overflow:hidden; padding: 3px;">
                    <?php echo $post['content'];?>
                </div>
                <div class="panel-footer bg-white row panel-small">
                    <p class="col-lg-8 view-bottom" >
                        <?php foreach( $tags as $tag ): ?>
                        <a class="text-grayh" href="<?php echo Yii::app()->createAbsoluteUrl('/tags/index',array('id' => $tag['id'])); ?>" ><?php echo CHtml::encode($tag['tagname']); ?></a>
                        <?php endforeach; ?>
                    </p>
                    <p class="col-lg-4 text-right view-bottom" >
                        <a href="#comment" class="btn bg-lan-shen text-white btn-xs" >Comment</a>
                    </p>
                </div>
            </div>
            <div id="comment" class="well bg-white">
                <h4>Post Comment</h4>
                <form>
                    <input type="hidden" name="post_id" value="<?php echo $post['id'];?>"  readonly="readonly" />
                <div class="input-group">
                    <span class="input-group-addon">your name:</span>
                    <input type="text" name="author" class="form-control" placeholder="your name">
                </div><br />
                <div class="input-group">
                    <span class="input-group-addon">your email:</span>
                    <input type="text" name="author_email" class="form-control" placeholder="your email">
                </div><br />
                <div class="input-group">
                    <span class="input-group-addon">your website: http://</span>
                    <input type="text" name="author_webroot" class="form-control" placeholder="your website">
                </div><br />
                 <div class="input-group">
                    <span class="input-group-addon">Content:</span>
                    <textarea id="comment_content" class="form-control" placeholder="you want to say" ></textarea>
                </div><br />
                <div id="info" ></div><br />
                <div class="text-center">
                    <button type="button" id="postComment" class="btn bg-lan-shen text-white" >submit</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn bg-lan-shen text-white" >reset</button>
                </div>
                <form>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <?php $this->renderPartial( '_rightMenu', array('rightMenu' => $rightMenu ) ); ?>
        </div>
    </div>
</div>



