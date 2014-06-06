<?php
/* @var $this TagsController */
/* @var $model Tags */
/* @var $form CActiveForm */
?>

<div class="row form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="input-group col-md-10 col-xs-12">
		<?php echo $form->label($model,'tagname',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'tagname',array('class' => 'form-control')); ?>
	</div>

	<div class="col-md-2 col-xs-12">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->