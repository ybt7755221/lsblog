<?php
/* @var $this AblumController */
/* @var $model Ablum */
/* @var $form CActiveForm */
?>

<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="row">
	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'ablum_name',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'ablum_name',array('class'=>'form-control')); ?>
	</div>

	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'information',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'information',array('class'=>'form-control')); ?>
	</div>

	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'status',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'status',Ablum::model()->getStatus(),array('class'=>'form-control')); ?>
	</div>
</div><br />
	<div class="text-center">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->