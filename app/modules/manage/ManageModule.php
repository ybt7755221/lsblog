<?php

class ManageModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'manage.components.*',
            'application.models.*',
            'application.components.*',
		));
        Yii::app()->theme='manage';
        Yii::app()->homeUrl = '/manage/Site/index';
        Yii::app()->setComponents(array(
            'name' => 'lsBlog Manage',
            'defaultController'=>'manage/Site',
            'errorHandler' => array(
                'class' => 'CErrorHandler',
                'errorAction'=>'manage/default/error',
            ),
        ));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
