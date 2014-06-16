<?php $this->pageTitle=Yii::app()->name . ' - Login'; ?>
<div class="container">
    <h2 class="form-signin-heading text-center">Please sign in</h2>
     <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'login-form',
        	'enableClientValidation'=>true,
            'htmlOptions' => array( 'class' => 'form-signin' ),
        	'clientOptions'=>array(
        		'validateOnSubmit'=>true,
        	),
     )); ?>
        <?php echo $form->textField( $model, 'username', array( 'class' => 'form-control', 'placeholder' => 'Email Address', 'required' => 'required' ) ); ?>
       	<?php echo $form->passwordField($model,'password', array( 'class' => 'form-control', 'placeholder' => 'Password', 'required' => 'required' )); ?>
    
    	<div class="checkbox">
    		<?php echo $form->checkBox($model,'rememberMe'); ?>
    		<?php echo $form->label($model,'rememberMe'); ?>
    	</div>
    
    	<p class="text-danger" >
            	<?php echo $form->errorSummary($model); ?>
        </p>
    	<?php echo CHtml::submitButton('Login', array( 'class' => 'btn btn-lg btn-primary btn-block' ) ); ?>
    	
     <?php $this->endWidget(); ?>
 </div>
