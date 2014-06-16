<?php
class AblumController extends Controller
{
    public $_page = 48;
    public function filters() {
            return array (
                array (
                    'COutputCache + index,view',
                    'duration' => 604800,
                    'varyByParam' => array('id'),
                )
            );
    }
    
    public function actionIndex()
    {
        $this->pageTitle = '相册展示 - '.CHtml::encode( Yii::app()->name );
        $sql = 'SELECT u.`username`, a.`id`, a.`ablum_name`, a.`cover`, a.`information`, a.`status` FROM `{{ablum}}` a LEFT JOIN `{{users}}` u ON a.`cuid` = u.`id` WHERE a.`status` > 0 ORDER BY a.`id` DESC LIMIT :limit';
        $ablumArr = Yii::app()->db->createCommand( $sql )->bindValue( ':limit', $this->_page, PDO::PARAM_INT )->queryAll();
        $num = 0;
        $albumsArr = array();
        $n0 = 0; $n1 = 0; $n2 = 0; $n3 = 0;
        foreach ( $ablumArr as $val )
        {
            switch ( $num )
            {
                case 0 :
                        $albumsArr[$num][$n0] = $val;
                        $n0++; $num++;
                        break;
                case 1 :
                        $albumsArr[$num][$n1] = $val;
                        $n0++; $num++;
                        break;
                case 2 :
                        $albumsArr[$num][$n2] = $val;
                        $n0++; $num++;
                        break;
                case 3 :
                        $albumsArr[$num][$n3] = $val;
                        $n0++; $num = 0;
                        break;
            }
	    $lastId = $val['id'];
        }
	if ( !isset($lastId) )
	    $lastId = 0;
        $this->render( 'index', array(
            'ablums' => $albumsArr,
            'lastId' => $lastId 
        ) );
    }
    
    public function actionAjaxPager()
    {
        
        if( isset( $_POST['ajax'] ) && $_POST['ajax'] == 'AJAX' )
        {
            $sql = 'SELECT u.`username`, a.`id`, a.`ablum_name`, a.`cover`, a.`information`, a.`status` FROM `{{ablum}}` a LEFT JOIN `{{users}}` u ON a.`cuid` = u.`id` WHERE a.`id` < :id AND a.`status` > 0 ORDER BY a.`id` DESC LIMIT :limit';
            $ablumArr = Yii::app()->db->createCommand( $sql )->bindValue( ':id', $_POST['id'], PDO::PARAM_INT )->bindValue( ':limit', $this->_page, PDO::PARAM_INT )->queryAll();
            if ( !empty ( $ablumArr ) )
            {
                $num = 0;
                $albumsArr = array();
                $n0 = 0; $n1 = 0; $n2 = 0; $n3 = 0;
                foreach ( $ablumArr as $val )
                {
                    switch ( $num )
                    {
                        case 0 :
                                $albumsArr[$num][$n0] = $val;
                                $n0++; $num++;
                                break;
                        case 1 :
                                $albumsArr[$num][$n1] = $val;
                                $n0++; $num++;
                                break;
                        case 2 :
                                $albumsArr[$num][$n2] = $val;
                                $n0++; $num++;
                                break;
                        case 3 :
                                $albumsArr[$num][$n3] = $val;
                                $n0++; $num = 0;
                                break;
                    }
                    $lastId = $val['id'];
                }
                $this->renderPartial( '_list', array(
                    'ablums' => $albumsArr,
                    'lastId' => $lastId 
                ) );
            }
        }
        echo ' ';
        Yii::app()->end();
    }
    
    public function actionView( $id )
    {
        $ablumSql = 'SELECT `ablum_name`, `cover`, `ctime`, `information` FROM `{{ablum}}` WHERE `id` = :id LIMIT 1';
        $ablumArr = Yii::app()->db->createCommand( $ablumSql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryRow();
        $sql = 'SELECT `path`, `backup` FROM `{{images}}` WHERE `aid` = :id ORDER BY `sort` DESC, `id` DESC';
        $imageArr = Yii::app()->db->createCommand( $sql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryAll();
        $imgCount = count( $imageArr );
        $this->render( 'view', array( 'images' => $imageArr, 'imageCount'=>$imgCount, 'ablum' => $ablumArr ) );
    }
}
