<?php

class CategoriseController extends AController
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
			array( 'allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array( 'index','view' ),
				'users'=>array( '*' ),
			 ),
			array( 'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array( 'create','update' ),
				'users'=>array( '@' ),
			 ),
			array( 'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array( 'admin','delete' ),
				'users'=>array( 'admin' ),
			 ),
			array( 'deny',  // deny all users
				'users'=>array( '*' ),
			 ),
		 );
	}

	
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView( $id )
	{
		$this->render( 'view',array( 
			'model'=>$this->loadModel( $id ),
		 ) );
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Categorise;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation( $model );

		if( isset( $_POST['Categorise'] ) )
		{
			$model->attributes=$_POST['Categorise'];
                        $model->path = '0';
                        $image = CUploadedFile::getInstance( $model,'cate_image' );
                        $model->cate_image = $this->uploadImg( $image );
			if( $model->save() )
            {
                $path = $model->fid ;
                $result = $model->updateByPk( $model->id, array( 'path' => $path.'-'.$model->id ) );
                if( $result )
                    $this->redirect( array( 'index' ) );
            }
		}

		$this->render( 'create',array( 
			'model' => $model,
		 ) );
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate( $id )
	{
		$model=$this->loadModel( $id );
        $oldImage = $model->cate_image;
        $oldFid = $model->fid;
		if( isset( $_POST['Categorise'] ) )
		{
			$model->attributes = $_POST['Categorise'];
            $image = CUploadedFile::getInstance( $model, 'cate_image' );
            if ( !empty( $image ) ){
                $model->cate_image = $this->uploadImg( $image );
                if ( !empty( $model->cate_image ) && !empty( $oldImage ) )
                    $this->delOldImage( $oldImage );
            }
            else
                $model->cate_image = $oldImage;
            
            if ( $oldFid != $model->fid )
            {
                $path = $model->fid ;
                $model->path = $path.'-'.$model->id;
            }
			if( $model->save() )
				$this->redirect( array( 'index' ) );
		}

		$this->render( 'update',array( 
			'model'=>$model,
		 ) );
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete( $id )
	{
		$this->loadModel( $id )->delete();

		// if AJAX request ( triggered by deletion via admin grid view ), we should not redirect the browser
		if( !isset( $_GET['ajax'] ) )
			$this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'index' ) );
	}


	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Categorise( 'search' );
		$model->unsetAttributes();  // clear any default values
		if( isset( $_GET['Categorise'] ) )
			$model->attributes=$_GET['Categorise'];

		$this->render( 'admin',array( 
			'model'=>$model,
		 ) );
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Categorise the loaded model
	 * @throws CHttpException
	 */
	public function loadModel( $id )
	{
		$model=Categorise::model()->findByPk( $id );
		if( $model===null )
			throw new CHttpException( 404,'The requested page does not exist.' );
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Categorise $model the model to be validated
	 */
	protected function performAjaxValidation( $model )
	{
		if( isset( $_POST['ajax'] ) && $_POST['ajax']==='categorise-form' )
		{
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
	}
}
