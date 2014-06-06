<?php

class SiteController extends Controller
{
    
    public function filters() {
            return array (
                array (
                    'COutputCache + index',
                    'duration' => 604800,
                )
            );
    }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 *网站首页
	 */
	public function actionIndex()
	{
	    /*博主信息 master information*/
	    $dbConnection = Yii::app()->db;
            $masterSql = 'SELECT * FROM `{{user_field}}` WHERE `uid` = 1 LIMIT 1';
            $command = $dbConnection->createCommand( $masterSql );
            $masterArr = $command->queryRow();
            $masterArr = UserField::model()->userDataOutput( $masterArr );
            $logo = $masterArr['logo'];
            $information = $masterArr['description'];
            $uid = $masterArr['uid'];
            unset( $masterArr['uid'] );
            unset( $masterArr['logo'] ); 
            unset( $masterArr['description'] );
            
            /*首页分类 home data*/
            $categorySql = 'SELECT `id`, `cate_name`, `cate_english`, `description`, `cate_image` FROM `{{categorise}}` WHERE `visible` = 1 AND `fid` = 0 ORDER BY `cate_order`, `id`';
            $command = $dbConnection->createCommand( $categorySql );
            $categoryArr = $command->queryAll();
          
            $this->render( 'index', array( 'uid' => $uid, 'master' => $masterArr, 'nav' => $categoryArr, 'category' => $categoryArr, 'logo' => $logo, 'information' => $information ) );
	}

	/**
	 * This is the action to handle external exceptions.
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
