<?php
Yii::app()->clientScript->registerCssFile( Yii::app()->theme->baseUrl.'/css/bootstrap-switch.css');
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl.'/js/bootstrap-switch.min.js', CClientScript::POS_END );
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-field-form',
	'htmlOptions' => array( 'class' => 'form' ),
	'enableAjaxValidation'=>false,
)); ?>
<div class="row">
	<div class="input-group col-sm-3 col-xs-6">
		<?php echo $form->label($model,'height',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'height',array('class' => 'form-control')); ?>
        <span class="input-group-addon">㎝</span>
	</div>
    
    <div class="input-group col-sm-3 col-xs-6">
		<?php echo $form->label($model,'weight',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'weight',array('class' => 'form-control')); ?>
        <span class="input-group-addon">㎏</span>
	</div>
    
    <div class="input-group col-sm-3 col-xs-6">
		<?php echo $form->label($model,'blood',array('class' => 'input-group-addon')); ?>
        <?php echo $form->dropDownList($model, 'blood', UserField::model()->getOption( 'BLOOD' ), array('class' => 'form-control')); ?>
	</div>
    <div class="input-group col-sm-3 col-xs-6">
		<?php echo $form->label($model,'sex',array('class' => 'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'sex', UserField::model()->getOption( 'SEX' ), array('class' => 'form-control')); ?>
	</div>
</div><br />
<div class="row">
	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'sexual',array('class' => 'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'sexual', UserField::model()->getOption( 'SEXUAL' ), array('class' => 'form-control')); ?>
	</div>
    
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch"  data-on="success" data-on-label="显示" data-off-label="隐藏" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_sexual') ; ?>
        </span>
    </div>

	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'felling',array('class' => 'input-group-addon')); ?>
		<?php echo $form->dropDownList($model,'felling', UserField::model()->getOption( 'FELLING' ), array('class' => 'form-control')); ?>
	</div>
    
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch"  data-on="success" data-on-label="显示" data-off-label="隐藏" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_felling') ; ?>
        </span>
    </div>
</div><br />
<div class="row">
	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'birthday',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'birthday',array('class' => 'form-control')); ?>
	</div>
    
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_birthday') ; ?>
        </span>
    </div>
 
	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'email',array('class' => 'input-group-addon')); ?>
		<?php echo $form->emailField($model,'email',array('class' => 'form-control')); ?>
	</div>
    
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_email') ; ?>
        </span>
    </div>
</div><br />
<div class="row">
	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'weibo',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'weibo',array('class' => 'form-control')); ?>
	</div>
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_weibo') ; ?>
        </span>
    </div>

	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'weixin',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'weixin',array('class' => 'form-control')); ?>
	</div>
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_weixin') ; ?>
        </span>
    </div>
</div><br />
<div class="row">
	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'qq',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'qq',array('class' => 'form-control')); ?>
	</div>
    <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_qq') ; ?>
        </span>
    </div>

	<div class="input-group col-sm-4 col-xs-8">
		<?php echo $form->label($model,'msn',array('class' => 'input-group-addon')); ?>
		<?php echo $form->emailField($model,'msn',array('class' => 'form-control')); ?>
	</div>
     <div class="col-sm-2 col-xs-4 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_msn') ; ?>
        </span>
    </div>
</div><br />
<div class="row">
    <div class="col-sm-12 col-xs-12 height34">
        <span class="make-switch" data-on="success" data-on-label="显示" data-off-label="隐藏">
           <?php echo $form->checkBox($model, 'is_edu') ; ?>
        </span>
        &nbsp;教育状态
    </div>
	<div class="input-group col-sm-6 col-xs-12">
		<?php echo $form->label($model,'university',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'university',array('class' => 'form-control')); ?>
	</div>

	<div class="input-group col-sm-6 col-xs-12">
		<?php echo $form->label($model,'school',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textField($model,'school',array('class' => 'form-control')); ?>
	</div>
</div><br />
<div class="row">
    <div class="input-group col-sm-12 col-xs-12">
		<?php echo $form->label($model,'description',array('class' => 'input-group-addon')); ?>
		<?php echo $form->textArea($model,'description',array('class' => 'form-control','rows' => '3' )); ?>
	</div>
</div><br />
<div class="row">  
     <div class="error col-sm-12 col-xs-12 text-danger">
        <?php echo $form->errorSummary($model); ?>
    </div>
</div><br />
	<div class="text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>