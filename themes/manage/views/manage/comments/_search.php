<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="well form">
<div class="row" >
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?> 
    <?php if( !empty($noshow) ): ?>
    <div class="info col-md-12 col-xs-12 text-center">
        <small class="text-muted" style="font-weight: bold;">您有<?php echo CHtml::encode( $noshow ); ?>条未审核评论</small>
    </div><br />
    <?php endif;?>
    
	<div class="input-group col-md-6 col-xs-6">
		<?php echo $form->label($model,'author',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'author',array('class'=>'form-control')); ?>
	</div>
	<div class="input-group col-md-4 col-xs-6">
		<?php echo $form->label($model,'is_show',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'is_show',Comments::model()->isShow(),array('class'=>'form-control')); ?>
	</div>
    <div class="text-center col-md-2 col-xs-12">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->