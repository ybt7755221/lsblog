<div id="listview">
    <?php if( !empty( $posts ) ) { foreach( $posts as $idx => $data ): ?>
        <?php if ( $idx == 0 ):?>
            <input type="hidden" id="firstId" value="<?php echo $data['id']; ?>" readonly="readonly" />
        <?php endif; ?>
        <?php if ( $idx == $pages-1 ):?>
            <input type="hidden" id="lastId" value="<?php echo $data['id']; ?>" readonly="readonly" />
        <?php endif; ?>
                <div class="row well bg-white" style="padding:10px 20px; margin-bottom:1px;" >
                    <h2 class="text-center"><a class="text-lan" href="<?php echo Yii::app()->createUrl( '/posts/view', array( 'id' => $data['id'], 'name' => $data['title'] ) );?>"><?php echo CHtml::encode( $data['title'] ); ?></a></h2>
                        <p class="line bg-silvery"></p>
                        <p class="row post-info">
                            <span class="col-lg-6 col-xs-6 col-md-6 col-sm-6 text-left text-grayh"><?php echo $data['author']; ?></span>
                            <span class="col-lg-6 col-xs-6 col-md-6 col-sm-6 text-right text-grayh"><?php echo date('m-d-Y', $data['create_time']); ?></span>
                        </p>
                        <p class="line bg-silvery"></p>
                        <div class="post-content">
                            <?php echo CHtml::encode($data['excerpt']); ?>
                            <p class="line"></p><br />
                            <a class="read_more" href="<?php echo Yii::app()->createUrl( '/posts/view', array( 'id' => $data['id'], 'name' => $data['title'] ) );?>">Read more</a>
                        </div>
                        <p class="line bg-silvery"></p>
                        <p class="post-tag text-grayh">
                            <?php $tags = Tags::model()->showName( $data['tag_id'], 1 ); 
                                  foreach( $tags as $val ):?>
                            <a href="<?php echo Yii::app()->createAbsoluteUrl( '/tags/index', array( 'id' => $val['id'], 'tag' => $val['tagname'] ) ); ?>" ><?php echo CHtml::encode($val['tagname'])?></a>
                            <?php endforeach;?>
                        </p>
                </div>
    <?php endforeach; }else{ echo '<p class="col-sm-12 col-xs-12 text-borwn text-center bg-gold" > 没有数据 </p>'; } ?>
</div>
<div class="clear hang"></div>