<?php

class PostsController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 
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

	
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Posts;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Posts']))
		{
            var_dump( $_POST );
			$model->attributes=$_POST['Posts'];
            $model->comment_count = 0;
            $model->create_time = time();
            $model->post_password = md5('lsblog');
            $model->author = Yii::app()->user->id;
            $model->tag_id = Tags::model()->getTagName( trim( $_POST['Posts']['tag_id'] ) );
            echo $model->type; exit;
			if($model->save())
				$this->redirect( array( 'index' ) );
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $oldTag = $model->tag_id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Posts']))
		{
            $model->attributes=$_POST['Posts'];
            $model->tag_id = Tags::model()->getTagName( trim( $_POST['Posts']['tag_id'] ) );
			if($model->save())
				$this->redirect( array( 'index' ) );
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete ($id )
	{
		$this->loadModel( $id )->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if( !isset( $_GET['ajax'] ) )
			$this->redirect( isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index') );
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Posts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Posts']))
			$model->attributes=$_GET['Posts'];
		$this->render( 'admin', array(
			'model' => $model,
		));
	}
    
    public function actionCommentstatus()
    {
        if( isset( $_GET['postid']) )
        {
            $sql = 'UPDATE `{{posts}}` SET `comment_status` = :cid WHERE `id` = :id ';
            $res = Yii::app()->db->createCommand( $sql )->bindValue( ':cid', $_GET['cid'], PDO::PARAM_INT )->bindValue( ':id', $_GET['postid'], PDO::PARAM_INT )->execute();
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Posts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Posts::model()->findByPk($id);
        $model->tag_id = Tags::model()->showName( $model->tag_id );
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Posts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='posts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
