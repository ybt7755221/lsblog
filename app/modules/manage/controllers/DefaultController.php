<?php

class DefaultController extends AController
{
    public function init()
    {
        
    }
    
    public function actionIndex()
    {
        $this->redirect( array( Yii::app()->homeUrl ) );
    }
    /**
	 * 登陆
	 */
	public function actionLogin()
	{
        $this->layout = '//layouts/login';
		$model=new LoginForm;
		// if it is ajax validation request
		if( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'login-form' )
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
		// collect user input data
		if(isset( $_POST['LoginForm']) )
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if( $model->validate() && $model->login() )
				$this->redirect( array ( Yii::app()->homeUrl ) );
		}
		// display the login form
		$this->render( 'login' ,array( 'model' => $model ) );
	}
    /**
	 * 注销
	 */
   	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect( array( Yii::app()->homeUrl ) );
	}   
    /**
	 * 错误提示
	 */
    public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}