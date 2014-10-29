<ul class="list-group">
    <li class="list-group-item text-white bg-lan-shen">Tags</li>
    <li class="list-group-item">
	    <div class="row">
		    <?php foreach( $rightMenu['tags'] as $val ): ?>
		     	<span class="label col-tag bg-gold"><a class="text-gray" href="<?php echo Yii::app()->createUrl( '/tags/index', array( 'id' => $val['id'], 'name' => $val['tagname'] ) ); ?>"><?php echo CHtml::encode( $val['tagname'] ); ?></a></span>
		    <?php endforeach;; ?>
	    </div>
    </li>
</ul>
<ul class="list-group">
    <li class="list-group-item text-white bg-lan-shen">最近</li>
    <?php foreach ( $rightMenu['new'] as $val ): ?>
    <a class="text-lan" href="<?php echo Yii::app()->createAbsoluteUrl('posts/view',array('id' => $val['id'],'name' => $val['title'])); ?>" ><li class="list-group-item"><?php echo CHtml::encode($val['title']); ?></li></a>
    <?php endforeach; ?>
</ul>
<ul class="list-group">
    <li class="list-group-item text-white bg-lan-shen">推荐</li>
    <?php foreach ( $rightMenu['hot'] as $val ): ?>
    <a class="text-lan" href="<?php echo Yii::app()->createAbsoluteUrl('posts/view',array('id' => $val['id'],'name' => $val['title'])); ?>" ><li class="list-group-item"><?php echo CHtml::encode($val['title']); ?></li></a>
    <?php endforeach; ?>
</ul>