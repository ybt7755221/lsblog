<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . "/js/base.js",CClientScript::POS_END); ?>       
        <div class="row">
            <div class="col-sm-3 col-xs-6">
            <?php if( isset( $ablums[0] ) ){ foreach( $ablums[0] as $val ):?>
                <div class="thumbnail bg-gold">
                    <img src="<?php echo Yii::app()->baseUrl.$val['cover'] ?>" data-src="holder.js/220x100%" alt="<?php echo CHtml::encode( $val['ablum_name'] ); ?>" width="220px" />
                    <div class="caption">
                        <h3><small class="text-brown"><?php echo CHtml::encode( $val['ablum_name'] ); ?></small></h3>
                        <p><small class="text-brown"><?php echo CHtml::encode( $val['information'] ); ?></small></p>
                        <p class="text-center"><a href="<?php echo Yii::app()->createUrl( '/ablum/view', array( 'id' => $val['id'], 'name' => $val['ablum_name'] ) ); ?>" class="btn btn-default" role="button">浏览图片</a></p>
                    </div>
                </div><br />
            <?php endforeach;} ?>
            </div>
            <div class="col-sm-3 col-xs-6">
            <?php if( isset( $ablums[1] ) ){ foreach( $ablums[1] as $val ):?>
                <div class="thumbnail bg-gold">
                    <img src="<?php echo $val['cover'] ?>" data-src="holder.js/220x100%" alt="<?php echo CHtml::encode( $val['ablum_name'] ); ?>" width="220px" />
                    <div class="caption">
                        <h3><small class="text-brown"><?php echo CHtml::encode( $val['ablum_name'] ); ?></small></h3>
                        <p><small class="text-brown"><?php echo CHtml::encode( $val['information'] ); ?></small></p>
                        <p class="text-center"><a href="<?php echo Yii::app()->createUrl( '/ablum/view', array( 'id' => $val['id'], 'name' => $val['ablum_name'] ) ); ?>" class="btn btn-default" role="button">浏览图片</a></p>
                    </div>
                </div><br />
            <?php endforeach;} ?>
            </div>
            <div class="col-sm-3 col-xs-6">
            <?php if( isset( $ablums[2] ) ){ foreach( $ablums[2] as $val ):?>
                <div class="thumbnail bg-gold" >
                    <img src="<?php echo $val['cover'] ?>" data-src="holder.js/220x100%" alt="<?php echo CHtml::encode( $val['ablum_name'] ); ?>" width="220px" />
                    <div class="caption">
                        <h3><small class="text-brown"><?php echo CHtml::encode( $val['ablum_name'] ); ?></small></h3>
                        <p><small class="text-brown"><?php echo CHtml::encode( $val['information'] ); ?></small></p>
                        <p class="text-center"><a href="<?php echo Yii::app()->createUrl( '/ablum/view', array( 'id' => $val['id'], 'name' => $val['ablum_name'] ) ); ?>" class="btn btn-default" role="button">浏览图片</a></p>
                    </div>
                </div><br />
            <?php endforeach;} ?>
            </div>
            <div class="col-sm-3 col-xs-6">
            <?php if( isset( $ablums[3] ) ){ foreach( $ablums[3] as $val ):?>
                <div class="thumbnail bg-gold" >
                    <img src="<?php echo $val['cover'] ?>" data-src="holder.js/220x100%" alt="<?php echo CHtml::encode( $val['ablum_name'] ); ?>" width="220px" />
                    <div class="caption">
                        <h3><small class="text-brown"><?php echo CHtml::encode( $val['ablum_name'] ); ?></small></h3>
                        <p><small class="text-brown"><?php echo CHtml::encode( $val['information'] ); ?></small></p>
                        <p class="text-center"><a href="<?php echo Yii::app()->createUrl( '/ablum/view', array( 'id' => $val['id'], 'name' => $val['ablum_name'] ) ); ?>" class="btn btn-default" role="button">浏览图片</a></p>
                    </div>
                </div><br />
            <?php endforeach;} ?>
            </div>
        </div>
        <div id="lastId" class="lastId" style="display:none;" ><?php echo $lastId; ?></div> 