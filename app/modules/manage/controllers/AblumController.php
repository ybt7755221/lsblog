<?php

class AblumController extends AController
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

	splays a particular model.
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
		$model=new Ablum;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ablum']))
		{
            if ( empty( $_POST['Ablum']['passwd'] ) )
                $_POST['Ablum']['passwd'] = md5( 123654 );
            $image=CUploadedFile::getInstance($model,'cover');
		    $imagePath = $this->uploadImg( $image );
            $model->cuid = Yii::app()->user->id;
			$model->attributes=$_POST['Ablum'];
            $model->cover = $imagePath;
            $model->ctime = time();
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
        $oldImg = $model->cover;
        $oldPass = $model->passwd;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if( isset( $_POST['Ablum'] ) )
		{
            if ( empty( $_POST['Ablum']['passwd'] ) )
                $_POST['Ablum']['passwd'] = $oldPass;
            $image=CUploadedFile::getInstance( $model, 'cover' );
            $model->attributes = $_POST['Ablum'];
            $model->passwd = trim( $_POST['Ablum']['passwd'] );
		    $imagePath = $this->uploadImg( $image );
            if( !empty( $imagePath ) )
            {
                $model->cover = $imagePath;
                $this->delOldImage( $oldImg );
            }
            else
                $model->cover = $oldImg;
			if( $model->save() )
            {
                $this->redirect( array( 'index' ) );
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    
    public function actionUploadImg()
    {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
            $dirname = date('Ym/',time());
            $folder=Yii::getPathOfAlias('webroot').'/upload/ablum/'.$dirname;// folder for uploaded files
            if (!is_dir($folder))
               @mkdir($folder,0777,true);
            $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 100 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
     
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
            $this->SaveImage('/upload/ablum/'.$dirname.$fileName,$_GET['aid']);
            echo $return;// it's array
    }
    
    private function SaveImage($path,$aid)
    {
        $model = new Images();
        $model->aid = $aid;
        $model->path = $path;
        $model->sort = 0;
        $model->backup = '暂无';
        $model->ctime = $_SERVER['REQUEST_TIME'];
        $model->save();
    }
    
    public function actionManageImg( $id )
    {
        $sql = 'SELECT * FROM `{{images}}` WHERE `aid` = :id';
        $imagesArr = Yii::app()->db->createCommand( $sql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryAll();
        $this->render( 'manageImage', array( 'aid' => $id, 'ablumName' => $_GET['name'], 'images' => $imagesArr ) );
    }
    
    public function actionDelImage( $id )
    {
        $sql = 'SELECT `path` FROM `{{images}}` WHERE `id` = :id LIMIT 1';
        $pathArr = Yii::app()->db->createCommand( $sql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryRow();
        $result = Images::model()->deleteByPk( $id );
        if ( $result )
        {
            $this->delOldImage( $pathArr['path'] );
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manageImg', 'id' => $_GET['aid'], 'name' => $_GET['name'] ));
        }
    }
    
    public function actionSaveBackUp()
    {
        if( isset( $_POST['ajax'] ) && $_POST['ajax'] == 'AJAX' )
        {
            $model = Images::model()->findByPk($_POST['id']);
            $model->backup = trim($_POST['backup']);
            $result = $model->save();
            if ( $result )
                echo 'succ';
            Yii::app()->end();
        }
        echo 'error';
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$res = $this->loadModel($id)->delete();
        if ( $res )
        {
            $sql = "DELETE FROM `{{images}}` WHERE `aid` = :aid";
            $result = YII::app()->db->createCommand( $sql )->bindParam( ':aid', $id, PDO::PARAM_INT )->execute();   
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Ablum('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ablum']))
			$model->attributes=$_GET['Ablum'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
    public function actionDelAllImage( $aid )
    {
        $sql = "DELETE FROM `{{images}}` WHERE `aid` = :aid";
        $result = YII::app()->db->createCommand( $sql )->bindParam( ':aid', $aid, PDO::PARAM_INT )->execute();
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manageImg', 'id' => $_GET['aid'], 'name' => $_GET['name'] ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ablum the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ablum::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ablum $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ablum-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
