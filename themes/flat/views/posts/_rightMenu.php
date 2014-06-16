<ul class="list-group">
    <li class="list-group-item text-white bg-lan-shen">Tags</li>
    <li class="list-group-item">
    <?php foreach( $rightMenu['tags'] as $val ): ?>
    <a href="<?php echo Yii::app()->createUrl('tags/index',array('id' => $val['id'])); ?>" ><span class="label label-default"><?php echo CHtml::encode($val['tagname']); ?></span></a>
    <?php endforeach;; ?>
    </li>
</ul>
<ul class="list-group">
    <li class="list-group-item text-white bg-lan-shen">nearby</li>
    <?php foreach ( $rightMenu['new'] as $val ): ?>
    <a class="text-lan" href="<?php echo Yii::app()->createAbsoluteUrl('posts/view',array('id' => $val['id'],'name' => $val['title'])); ?>" ><li class="list-group-item"><?php echo CHtml::encode($val['title']); ?></li></a>
    <?php endforeach; ?>
</ul>
<ul class="list-group">
    <li class="list-group-item text-white bg-lan-shen">Hot</li>
    <?php foreach ( $rightMenu['hot'] as $val ): ?>
    <a class="text-lan" href="<?php echo Yii::app()->createAbsoluteUrl('posts/view',array('id' => $val['id'],'name' => $val['title'])); ?>" ><li class="list-group-item"><?php echo CHtml::encode($val['title']); ?></li></a>
    <?php endforeach; ?>
</ul>