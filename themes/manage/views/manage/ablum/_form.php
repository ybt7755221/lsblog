<?php
/* @var $this AblumController */
/* @var $model Ablum */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ablum-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<div class="info text-danger">
	<?php echo $form->errorSummary($model); ?>
</div>
    <div>
        <h3 class="label label-default"><a class="text-white">cover</a></h3>
        <img src="<?php echo Yii::app()->baseUrl.$model->cover; ?>" class="img-responsive" alt="Responsive image" />
    </div><br />
	<div class="input-group">
		<?php echo $form->label($model,'ablum_name',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'ablum_name',array('class'=>'form-control')); ?>
	</div><br />
    <div class="input-group">
		<?php echo $form->label($model,'cover',array('class'=>'input-group-addon')); ?>
		<?php echo $form->fileField($model,'cover',array('class'=>'form-control')); ?>
	</div><br />
<div class="row">
    <div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'status',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'status',Ablum::model()->getStatus(),array('class'=>'form-control')); ?>
	</div>
	<div class="input-group col-md-6 col-xs-12">
		<?php echo $form->label($model,'passwd',array('class'=>'input-group-addon')); ?>
		<?php echo $form->passwordField($model,'passwd',array('class'=>'form-control', 'value' => '')); ?>
	</div>
</div><br />
	

	<div class="input-group">
		<?php echo $form->label($model,'information',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textArea($model,'information',array('class'=>'form-control')); ?>
	</div><br />

	<div class="text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->