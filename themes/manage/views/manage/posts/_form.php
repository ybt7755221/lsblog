<?php
Yii::app()->clientScript->registerCssFile( Yii::app()->baseUrl. '/ueditor/themes/default/css/ueditor.css' );
Yii::app()->clientScript->registerScriptFile( Yii::app()->baseUrl . '/ueditor/ueditor.config.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile( Yii::app()->baseUrl . '/ueditor/ueditor.all.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/base.js',CClientScript::POS_END);
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posts-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="info text-danger">
        <?php echo $form->errorSummary($model); ?>
    </div><br />
	<div class="input-group">
		<?php echo $form->label($model,'title', array( 'class' => 'input-group-addon' )); ?>
		<?php echo $form->textField($model,'title',array('class' => 'form-control')); ?>
	</div><br />
    <div class="row">
        <div class="input-group col-md-6 col-xs-6">
    		<?php echo $form->label($model,'cate_id',array('class'=>'input-group-addon')); ?>
    		<?php echo $form->dropDownList($model,'cate_id',Categorise::model()->getFidCate(),array('class' => 'form-control')); ?>
   	    </div>
        <div class="input-group col-md-6 col-xs-6">
    		<?php echo $form->label($model,'status',array('class'=>'input-group-addon')); ?>
    		<?php echo $form->dropDownList($model,'status',Posts::model()->getStatus(),array('class' => 'form-control')); ?>
    	</div>
    </div><br />
    <div class="row">
    
    	<div class="input-group col-md-6 col-xs-6">
    		<?php echo $form->labelEx($model,'type',array('class'=>'input-group-addon')); ?>
    		<?php echo $form->dropDownList($model,'type', Posts::model()->getType(), array('class' => 'form-control')); ?>
    	</div>
        
       	<div class="input-group col-md-6 col-xs-6">
    		<?php echo $form->label($model,'comment_status',array('class'=>'input-group-addon')); ?>
    		<?php echo $form->dropDownList($model,'comment_status',Posts::model()->getCommentStatus(),array('class' => 'form-control')); ?>
    	</div>
    </div><br />
    <div class="input-group">
		<?php echo $form->label($model,'excerpt', array( 'class' => 'input-group-addon')); ?>
		<?php echo $form->textArea($model,'excerpt',array('class' => 'form-control','rows'=>3)); ?>
	</div><br />

	<div class="input-group" >
        <?php echo $form->textArea($model,'content',array('id'=>'myEditor', 'rows'=>3)); ?>
    </div><br />

	<div class="input-group">
		<?php echo $form->label($model,'tag_id',array('class'=>'input-group-addon')); ?>
		<?php echo $form->textField($model,'tag_id',array('class' => 'form-control')); ?>
	</div><br />
	<div class="row text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->