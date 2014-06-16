<?php
class AController extends Controller
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
    public $menu = array();
    
    public $breadcrumbs = array();
    
    //添加图片
    protected function uploadImg( $image, $path = 'ablum' )
    {
        
        if ( !empty( $image ) )
        {
            $newFileName = time().rand(100,999).'.'.$image->extensionName;
            $dirName = '/upload/'.$path.'/'.date('Ym', time()).'/';
            if ( !is_dir( Yii::getPathOfAlias( 'webroot' ).$dirName  ))
                mkdir( Yii::getPathOfAlias( 'webroot' ).$dirName,0777,true );
            if ( $image->saveAs( Yii::getPathOfAlias( 'webroot' ).$dirName.$newFileName ) )
                return $dirName.$newFileName;           
        }
        return FALSE;
    }
    //删除图片
    protected function delOldImage( $oldImage )
    {
        if ( $oldImage )
        {
            $fileDir = Yii::getPathOfAlias( 'webroot' ).$oldImage;
            if ( file_exists( $fileDir ) )
            {
                unlink( $fileDir );
                return TRUE;
            }
        }
        return FALSE;
    }
    //添加标签
    public function addTag( $tag )
    {
        $endData = '';
        $tag = str_replace( '，', ',', $tag );
        $arr = explode( ',', $tag );
        $arr = array_unique( array_diff( $arr,array( 'null', ' ', '' ) ) );
        $arrc = array();
        $num = count($arr);
        $str = '';
        if ( $num > 0 && $num < 10 )
        {
            foreach ( $arr as $value )
            {
                $str .=' SELECT `id`,`tagname` FROM `{{tags}}` where `tagname` ="'.strtolower( $value ).'" UNION';
                $temp[] = strtolower( $value );
            }
            $arr = $temp;
            $connection = Yii::app()->db;
            $sql = substr($str,0,-6);
            $command = $connection->createCommand( $sql );
            $result = $command->queryAll();
            if ( empty( $result ) )
            {
                $arrc = $arr;
                $endData = PublicFunc::createTag( $arrc );
            }
            else{
                $renum = count( $result );
                $idStr = '';
                for ( $i = 0; $i < $renum; $i++ )
                {
                    $a[]=strtolower( $result[$i]['tagname'] );
                    $idStr .= $result[$i]['id'].',';
                }
                $arrc = array_diff( $arr, $a );
                if ( empty( $arrc ) )
                    $endData = substr( $idStr, 0, -1 );
                else
                {
                    $resData = PublicFunc::createTag( $arrc );
                    $endData = $idStr.$resData;
                }
            } 
        }
        return $endData;
    }
    //创建标签
    protected function createTag( $tagArr )
    {
        
        $num = count( $tagArr );
        $str = 'INSERT INTO `{{tags}}` ( `create_uid`, `tagname`, `description` ) VALUES ';
        foreach( $tagArr as $value )
        {
            $str .='( "'.Yii::app()->user->id.'","'.strtolower( $value ).'","'.strtolower( $value ).'" ),';
        }
        $connection = Yii::app()->db;
        $sql = substr( $str,0,-1 );
        $command = $connection->createCommand( $sql );
        $command->execute();
        $result = $connection->getLastInsertId() 
;
        if ( !empty( $result ) )
        {
            $res = '';
            for ( $i = 0; $i < $num; $i++ )
            {
                $res .= $result + $i.',';
            }
            $end = substr( $res, 0, -1 );
        }
        else
            $end = '';
        return $end;
    }
     
    public function init()
    {
        if ( Yii::app()->user->isGuest )
            $this->redirect( array( '/manage/default/login' ) );
    }
}