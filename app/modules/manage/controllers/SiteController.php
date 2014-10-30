<?php
class SiteController extends AController
{
   
    public function filters() {
            return array (
                array (
                    'COutputCache + index, Theme',
                    'duration' => 604800,
                )
            );
    }
    
    public function actionIndex()
    {
        $sql = 'SELECT `id` FROM `{{comments}}` WHERE `is_show` = "FALSE"';
        $noShow = Yii::app()->db->createCommand( $sql )->query()->rowCount;
        $siteSql = 'SELECT `name`, `variate`, `value`, `type` FROM `{{site}}` WHERE `is_show` = 1 ';
        $siteArr = Yii::app()->db->createCommand( $siteSql )->queryAll();
        $postSql = 'SELECT `id` FROM `{{posts}}`';
        $postTotle =  Yii::app()->db->createCommand( $postSql )->query()->rowCount;
        $comSql = 'SELECT `id` FROM `{{comments}}`';
        $comTotle =  Yii::app()->db->createCommand( $comSql )->query()->rowCount;
        $totleArr = array(  array( 'name' => '总文章数', 'value' => $postTotle ), 
                            array( 'name' => '总评论数', 'value' => $comTotle ), 
                            array( 'name' => '服务器IP', 'value' => $_SERVER['SERVER_ADDR'] ), 
                            array( 'name' => '服务器时间', 'value' => date("Y-m-d G:i:s") ),
                            array( 'name' => '现用域名', 'value' => $_SERVER['SERVER_NAME'] ),
                            array( 'name' => '服务器信息', 'value' => php_uname('s').', '.php_sapi_name().', PHP'.PHP_VERSION ),
                    );
        $this->render( 'index', array( 'sites' => $siteArr, 'total' => $totleArr, 'commentNum' => $noShow ) );
    }
    
    public function actionTheme()
    {
        if( isset( $_POST['theme_id'] ) && !empty( $_POST['theme_id'] ) )
        {
            $selSql = 'SELECT `id` FROM `{{site}}` WHERE `is_show` = 1 AND `type` = 2 LIMIT 1';
            $oldThemeArr = Yii::app()->db->createCommand( $selSql )->queryRow();
            if ( $_POST['theme_id'] != $oldThemeArr['id'] )
            {
                $updSql = 'UPDATE `{{site}}` SET `is_show` = 1 WHERE `id` = :updateId';
                $result = Yii::app()->db->createCommand( $updSql )->bindParam( ':updateId', $oldThemeArr['id'], PDO::PARAM_INT )->execute();
                $updSql = 'UPDATE `{{site}}` SET `is_show` = 1 WHERE `id` = :updateId';
                Yii::app()->db->createCommand( $updSql )->bindParam( ':updateId', $_POST['theme_id'], PDO::PARAM_INT )->execute();
                echo 'success';
                Yii::app()->end();
            }
            else
            {
                echo 'double';
            }
            Yii::app()->end();
        }
        $siteSql = 'SELECT * FROM `{{site}}` WHERE `type` = 2 ';
        $siteArr = Yii::app()->db->createCommand( $siteSql )->queryAll();
        $this->render( 'theme', array( 'sites' => $siteArr ) );
    }
       
    public function actionUpdateSite()
    {
        if( $_POST )
        {
            $ids = '';   
            $sql = "UPDATE `{{site}}` SET `value` = CASE id ";  
            foreach ( $_POST as $key => $value ) 
            {   
                $sql .= "WHEN $key THEN '".CHtml::encode($value)."' ";  
                $ids .= $key.',';
            }   
            $ids = substr( $ids, 0, -1 );
            $sql .= "END WHERE id IN ( $ids )"; 
            Yii::app()->db->createCommand( $sql )->execute();
            //$this->actionflushSite();
            $this->redirect( array( Yii::app()->homeUrl ) );
        }
        $siteSql = 'SELECT * FROM `{{site}}` WHERE `type` = 1 ';
        $siteArr = Yii::app()->db->createCommand( $siteSql )->queryAll();
        $this->render( 'updateSite', array( 'sites' => $siteArr ) );
    }
    
    public function actionflushSite()
    {
        $sql = 'SELECT `variate`, `value` FROM `{{site}}` WHERE `is_show` = 1';
        $siteArr = Yii::app()->db->createCommand( $sql )->queryAll();
        $txt = "<?php ";
        foreach( $siteArr as $val )
        {
            $txt .= 'define( \''.strtoupper($val['variate']).'\', \''.$val['value'].'\' );';
        }
        $txt .= ' ?>';
        $fileDir = Yii::app()->basePath.'/config/siteInfo.php';
        // w表示以写入的方式打开文件，如果文件不存在，系统会自动建立
        $file_pointer = fopen($fileDir,"w+");
        fwrite($file_pointer,$txt);
        fclose($file_pointer);
        $this->redirect( array( Yii::app()->homeUrl ) );
    }
    
    public function actionDelCache()
    {
    	if (Yii::app()->cache)
        	Yii::app()->cache->flush();
        $this->redirect( array( Yii::app()->homeUrl ) );
    }
}
