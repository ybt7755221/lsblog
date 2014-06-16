<div class="well form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div class="row">
	<div class="input-group col-md-5 col-xs-12">
		<?php echo $form->label($model,'title',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-control')); ?>
	</div>

	<div class="input-group col-md-3 col-xs-12">
		<?php echo $form->label($model,'status',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'status',Posts::model()->getStatus(),array('class'=>'form-control')); ?>
	</div>

	<div class="input-group col-md-4 col-xs-12">
		<?php echo $form->label($model,'cate_id',array('class'=>'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'cate_id',Categorise::model()->getFidCate(),array('class'=>'form-control')); ?>
	</div>
</div>
    <div class="height clearfix"></div>
	<div class="text-center">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->