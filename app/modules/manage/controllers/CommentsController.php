<?php

class CommentsController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 
	public $layout='//layouts/column2';

	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}


	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    

	 */
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate( $id )
	{
		$model=$this->loadModel( $id );

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if( isset( $_POST['Comments'] ) )
		{
			$model->attributes=$_POST['Comments'];
			if( $model->save() )
				$this->redirect( array( 'index' ) );
		}

		$this->render( 'update',array(
			'model'=>$model,
		) );
	}
    
    public function actionIsShow()
    {
        if ( isset( $_GET['show'] ) )
        {
            $sql = "UPDATE `{{comments}}` SET `is_show` = :show WHERE `id` = :id";
            $result = Yii::app()->db->createCommand( $sql )->bindValue(':show', $_GET['show'], PDO::PARAM_INT )->bindValue(':id', $_GET['comid'], PDO::PARAM_INT )->execute();
            if ( $result )
           	    $this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array('index' ));
        }
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $this->layout = '//layouts/column1';
        $sql = 'SELECT `id` FROM `{{comments}}` WHERE `is_show` = "FALSE"';
        $noShow = Yii::app()->db->createCommand( $sql )->query()->rowCount;
        
		$model=new Comments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comments']))
			$model->attributes=$_GET['Comments'];

		$this->render('admin',array(
			'model'=>$model,
            'number' => $noShow,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comments the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comments $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
