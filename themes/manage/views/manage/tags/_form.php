<?php
/* @var $this TagsController */
/* @var $model Tags */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tags-form',
	'enableAjaxValidation'=>false,
)); ?>

    <div class="info text-danger">
        <?php echo $form->errorSummary($model); ?>
    </div>
<div class="row"> 
	<div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'tagname',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'tagname',array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'tagname'); ?>
	</div>

	<div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'tag_order',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'tag_order',array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'tag_order'); ?>
	</div>
</div><br />
    <div class="input-group">
		<?php echo $form->label($model,'description',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textArea($model,'description',array('class' => 'form-control', 'rows' => '3' )); ?>
		<?php echo $form->error($model,'description'); ?>
	</div><br />

	<div class="text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->