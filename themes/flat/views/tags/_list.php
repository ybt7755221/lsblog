<div id="listview">
    <?php if( !empty( $posts ) ) { foreach( $posts as $idx => $data ): ?>
        <?php if ( $idx == 0 ):?>
            <input type="hidden" id="firstId" value="<?php echo $data['id']; ?>" readonly="readonly" />
        <?php endif; ?>
        <?php if ( $idx == $pages-1 ):?>
            <input type="hidden" id="lastId" value="<?php echo $data['id']; ?>" readonly="readonly" />
        <?php endif; ?>
        <div class="panel panel-default">
            <div class="panel-heading text-center bg-white  panel-small">
            <h4 style="margin: 0;"><strong class="text-brown font-Middle"><?php echo CHtml::encode( $data['title'] ); ?></strong></h4>
            <p class="row artile-tag">
            <span class="col-sm-6 col-xs-6 artile-tag text-left text-brown">文章隶属于 <strong><?php echo CHtml::encode( $data['cate_name'] ); ?></strong></span>
            <span class="col-sm-6 col-xs-6 artile-tag text-right text-brown"><?php echo date( 'Y-m-d H:i:s', $data['create_time'] ) ?> 发布</span>
            </p>
            </div>
            <div class="clearfix"></div>
            <div class="panel-body bg-gold text-con font-Nomal">
                <p><?php echo CHtml::encode( $data['excerpt'] ); ?></p>
            </div>
            <div class="panel-footer bg-white panel-small">
                <div class="row">
                    <p class="col-sm-7 col-xs-7 text-left"><small class="font-Small" ><?php echo Tags::model()->showName( $data['tag_id'] ); ?></small></p>
                    <p class="col-sm-5 col-xs-5 text-right"><small class="font-Small" >
                        <a href="<?php echo Yii::app()->createUrl( '/posts/view', array( 'id' => $data['id'] ) );?>" >查看全文</a> 
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; }else{ echo '<p class="col-sm-12 col-xs-12 text-borwn text-center bg-gold" > 没有数据 </p>'; } ?>
</div>