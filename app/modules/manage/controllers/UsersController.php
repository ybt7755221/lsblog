<?php

class UsersController extends AController
{
    
    public function actions()
    {
        return array(
            'upload'=>array(
                'class'=>'xupload.actions.XUploadAction',
                'path' =>Yii::app() -> getBasePath() . "/upload/users/",
                'publicPath' => Yii::app() -> getBasePath() . "/upload/users/",
            ),
        );
    }
    
	public function actionUpdate()
	{
        $id = Yii::app()->user->id;
		$model = UserField::model()->findByPk($id);

		if( isset( $_POST['UserField'] ) )
		{
			$model->attributes = $_POST['UserField'];
			if( $model->save() )
				$this->redirect( array( 'index' ) );
		}

		$this->render( 'update', array(
			'model' => $model,
		));
	}
    
    public function actionUpdatePassword()
    {
        if ( isset( $_POST['password'] ) )
        {
            $id = Yii::app()->user->id;
            $passwordSql = 'SELECT `password` FROM `{{users}}` WHERE id = :id';
            $passwordArr = Yii::app()->db->createCommand( $passwordSql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryRow();
            
            if ( md5( $_POST['password'] ) == $passwordArr['password'] )
            {
                $passwd = md5( $_POST['newPasswd'] );
                $updateSql = 'UPDATE `{{users}}` SET `password` = :passwd WHERE id = :id';
                $result = Yii::app()->db->createCommand( $updateSql )->bindParam( ':passwd', $passwd, PDO::PARAM_STR )->bindParam( ':id', $id, PDO::PARAM_INT)->execute();
                if ( $result )
                {
                    echo '修改成功'; exit;
                }
            }
            else
            {
                echo '旧密码错误';  exit;  
            }
        }
        echo '数据提交不全'; exit;
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $id = Yii::app()->user->id;
		$userSql = 'SELECT * FROM `{{user_field}}` WHERE `uid` = '.$id;
        $userArr = Yii::app()->db->createCommand( $userSql )->queryRow();
        $this->render( 'index', array( 'user' => $userArr ) );
	}
    
    public function actionUserLogo()
    {
        $this->layout = '//layouts/column1';
        $id = Yii::app()->user->id;
        if( $_POST )
        {
            $imagePath = '';
            if( isset( $_POST['type'] ) )
            {
                $model = new UserField;
                $image=CUploadedFile::getInstance($model,'logo');
    		    $imagePath = $this->uploadImg( $image, 'users' ); 
                Yii::app()->session['tempUserLogo'] =  $imagePath;
                $seleSql = 'SELECT `logo` FROM `{{user_field}}` WHERE `uid` = :id';
                $oldLogoArr = Yii::app()->db->createCommand( $seleSql )->bindParam( ':id',$id, PDO::PARAM_INT )->queryRow();
                $sql = 'UPDATE `{{user_field}}` SET `logo` = :logo WHERE `uid` = :id';
                $result = Yii::app()->db->createCommand( $sql )->bindParam( ':logo',$imagePath, PDO::PARAM_INT )->bindParam( ':id',$id, PDO::PARAM_INT )->execute();
                if ( $result && $oldLogoArr['logo'] != '/upload/default.jpg' )
                {
                    @unlink(Yii::getPathOfAlias( 'webroot' ).$oldLogoArr['logo']);
                }
                    
            }
            $this->render( 'crop', array( 'imagePath' => $imagePath ) );
        }
        else
        {
            if ( !isset( Yii::app()->session['userLogo'] ) )
            {
                $id = Yii::app()->user->id;
                $userSql = 'SELECT `logo` FROM `{{user_field}}` WHERE `uid` = '.$id;
                $userArr = Yii::app()->db->createCommand( $userSql )->queryRow();
                $userLogo = $userArr['logo'];
            }
            else
                $userLogo = Yii::app()->session['userLogo'];
            $this->render( 'userLogo', array( 'userLogo' => $userLogo ) );
        }
    }
    
    /**
	 * .
	 */
    public function actionCrop()
    {
        if ( $_POST )
        {
            $targ_w = $targ_h = 150;
           	$jpeg_quality = 90;
           	$src = Yii::getPathOfAlias( 'webroot' ).$_POST['path'];
            $type = pathinfo($src);
            if ( $type['extension'] == 'jpeg' || $type['extension'] == 'jpg' ) {
                $img_r = imagecreatefromjpeg($src);
               	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
               	imagecopyresampled( $dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h'] );
                header( 'Content-type: image/jpeg' );
           	    imagejpeg( $dst_r, $src, $jpeg_quality );
                imagedestroy($img_r);
            }
           	elseif ( $type == 'png' )
            {
                var_dump(111);
            }
            Yii::app()->session['tempUserLogo'] = '';
            $this->redirect( array( '/manage/Users/index' ) );
        }
        if ( isset( Yii::app()->session['tempUserLogo'] ) && !empty( Yii::app()->session['tempUserLogo'] ) )
            $this->render( 'crop', array( 'imagePath' => Yii::app()->session['tempUserLogo'] ) );
        else
            throw new CHttpException(404,'The requested page does not exist.');
    }
}
