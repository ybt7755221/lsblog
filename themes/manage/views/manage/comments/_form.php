<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="info text-danger">
	   <?php echo $form->errorSummary($model); ?>
    </div><br />
    <div class="row">
	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'author',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'author',array('class'=>'form-control')); ?>
	</div>
    
    <div class="input-group col-md-3 col-xs-12">
		<?php echo $form->label($model,'is_show',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'is_show',Comments::model()->isShow(),array('class'=>'form-control')); ?>
	</div>

	<div class="input-group col-md-5 col-xs-12">
		<span class="input-group-addon" >Http://</span>
		<?php echo $form->textField($model,'author_webroot',array('class'=>'form-control')); ?>
	</div>
    
    </div><br />
    <div class="row">
	<div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'author_email',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'author_email',array('class'=>'form-control')); ?>
	</div>

	<div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'author_ip',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'author_ip',array('class'=>'form-control')); ?>
	</div>
     </div><br />
	<div class="input-group">
		<?php echo $form->label($model,'comment_content',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textArea($model,'comment_content',array('class'=>'form-control')); ?>
	</div><br />

	<div class="text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->