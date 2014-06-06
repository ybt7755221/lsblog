<?php
/* @var $this CategoriseController */
/* @var $model Categorise */
/* @var $form CActiveForm */
?>

<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="row">
	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'cate_name',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'cate_name',array('class' => 'form-control')); ?>
	</div>

	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'cate_english',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'cate_english',array('class' => 'form-control')); ?>
	</div>

	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'visible',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'visible',Categorise::model()->getVisible(),array('class' => 'form-control')); ?>
	</div>
</div><br />
	<div class="text-center">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->