<?php
/* @var $this AblumController */
/* @var $data Ablum */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuid')); ?>:</b>
	<?php echo CHtml::encode($data->cuid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ablum_name')); ?>:</b>
	<?php echo CHtml::encode($data->ablum_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover')); ?>:</b>
	<?php echo CHtml::encode($data->cover); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passwd')); ?>:</b>
	<?php echo CHtml::encode($data->passwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('information')); ?>:</b>
	<?php echo CHtml::encode($data->information); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ctime')); ?>:</b>
	<?php echo CHtml::encode($data->ctime); ?>
	<br />

	*/ ?>

</div>