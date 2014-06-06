<?php
/* @var $this CategoriseController */
/* @var $model Categorise */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categorise-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<div class="info text-danger">
	<?php echo $form->errorSummary($model); ?>
</div>
<div class="row" >
    <div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'fid',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'fid',Categorise::model()->getFidCate('Controller'),array('class'=>'form-control')); ?>
	</div>
    
    <div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'visible',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'visible',Categorise::model()->getVisible(),array('class'=>'form-control')); ?>
	</div>
    
    <div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'cate_order',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'cate_order',array('class'=>'form-control')); ?>
	</div>
</div><br />
<div class="row" >
	<div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'cate_name',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'cate_name',array('class'=>'form-control')); ?>
	</div>
    
    <div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'cate_english',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'cate_english',array('class'=>'form-control')); ?>
	</div>
</div><br />
	<div class="input-group">
		<?php echo $form->label($model,'description',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textArea($model,'description',array('class'=>'form-control')); ?>
	</div><br />

	<div class="input-group">
		<?php echo $form->label($model,'cate_image',array('class'=>'input-group-addon')); ?>
		<?php echo $form->FileField($model,'cate_image',array('class'=>'form-control')); ?>
        <span class="input-group-addon">只支持jpg,jpeg,png,gif图片，并且大小不超过2M</span>
	</div><br />

	<div class="text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->