<?php
/* @var $this LinksController */
/* @var $model Links */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'links-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

    <div class="info text-danger">
        <?php echo $form->errorSummary($model); ?>
    </div><br />
	<div class="input-group">
		<?php echo $form->label($model,'url',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'url',array('class'=>'form-control')); ?>
	</div><br />

	<div class="input-group">
		<?php echo $form->label($model,'lname',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'lname',array('class'=>'form-control')); ?>
	</div><br />

	<div class="input-group">
		<?php echo $form->label($model,'mage',array('class' => 'input-group-addon')); ?>
		<?php echo $form->fileField($model,'mage',array('class'=>'form-control')); ?>
	</div><br />

	<div class="input-group">
		<?php echo $form->label($model,'description',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textArea($model,'description',array('class'=>'form-control')); ?>
	</div><br />

	<div class="input-group">
		<?php echo $form->label($model,'visible',array('class' => 'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'visible',array( '不启用', '启用' ),array('class'=>'form-control')); ?>
	</div><br />

	<div class="text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->