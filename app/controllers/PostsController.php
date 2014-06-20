<?php

class PostsController extends Controller
{
    public function filters() {
            return array (
                array (
                    'COutputCache + index,view',
                    'duration' => LS_CACHE,
                    'varyByParam' => array('id'),
                )
            );
    }
	/**
         * Category article list page
	 * 分类文章列表页
	 */
    public function actionIndex($id)
    {   /**
         *Get right menu information 
         */
        $rightMenuArr = $this->getRightData();
        
        if ( isset(Yii::app()->session['topNav'][$id]) )
        {
            $categoryInfoArr = Yii::app()->session['topNav'][$id];
        }
        else
        {
            $cateSql = 'SELECT `id`, `cate_name`, `cate_english`, `description`, `cate_image` FROM `{{categorise}}` WHERE `id` = :id LIMIT 1';
            $categoryInfoArr = Yii::app()->db->createCommand( $cateSql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryRow();
        }
        
        $pages = $this->_page;
       	$postSql = "SELECT p.`id`, u.`nickname` AS author, p.`title`, p.`excerpt`, p.`tag_id`, p.`create_time` FROM `{{posts}}` p LEFT JOIN `{{users}}` u ON p.author = u.id WHERE p.`cate_id` = :cate_id ORDER BY p.`id` DESC LIMIT :limit";
        $result = Yii::app()->db->createCommand( $postSql );
        $result->bindValue( ':cate_id', $id, PDO::PARAM_INT );
        $result->bindValue( ':limit', $pages, PDO::PARAM_INT );
        $postsArr = $result->queryAll();
        $postsCount = count( $postsArr );
        if ( $postsCount < $pages )
            $noPage = 0;
        else
            $noPage = 1;
        $this->pageTitle = $categoryInfoArr['cate_name'].' - '.Yii::app()->name;
        $this->render( 'index', array(
            'cateInfo' => $categoryInfoArr,
            'posts' => $postsArr,
            'postsCount' => $postsCount,
            'pages' => $pages,
            'cate_id' => $id,
            'rightMenu' => $rightMenuArr,
            'noPage' => $noPage,
        ));
    }
        /**
	 * ajax分页
	 */    
    public function actionAjaxPager()
    {
        if( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'AJAX' && !empty( $_POST['postId'] )  )
        {  
            $limit = $this->_page;
            $cateId = $_POST['cateId'] * 1;
            $postId = $_POST['postId'] * 1;
            $connection = ' `id` = '.$_POST['cateId'] * 1;
            if ( $_POST['tag'] === 'prev' )
                $connection = '`id` > :id ';
            elseif ( $_POST['tag'] === 'next' )
                $connection = '`id` < :id ';
            $postSql = 'SELECT `id`, `title`, `excerpt`, `tag_id`, `create_time` FROM `{{posts}}` WHERE cate_id = :cate_id AND '.$connection.' ORDER BY `id` DESC LIMIT :limit';
            $postCommand = Yii::app()->db->createCommand( $postSql );
            $postCommand->bindParam( ':cate_id', $cateId, PDO::PARAM_INT );
            $postCommand->bindParam( ':id', $postId, PDO::PARAM_INT );
            $postCommand->bindParam( ':limit', $limit, PDO::PARAM_INT );
            $postArr = $postCommand->queryAll();
            $count = count( $postArr );
            if ( !empty( $postArr ) )
            {
                $msg = '';
                foreach ( $postArr as $idx => $val )
                {
                    if ( $idx == 0 )
                        $msg .= '<input type="hidden" id="firstId" value="'.$val['id'].'" readonly="readonly" />';
                    if ( $idx == $count-1 )
                        $msg .= '<input type="hidden" id="lastId" value="'.$val['id'].'" readonly="readonly" />';
                    $url = Yii::app()->createUrl( '/posts/view', array( 'id' => $val['id'] ) );
                    $dateTime = date( 'Y-m-d H:i:s', $val['create_time'] );
                    $tags = Tags::model()->showName( $val['tag_id'] );
                    //$tags = Tags::model()->showName( $data['tag_id'] );
                    $msg .= '<a href="'.Yii::app()->createUrl( '/posts/view', array( 'id' => $val['id'], 'name' => $val['title'] ) ).'" >
                                    <div class="row well bg-white " style="padding:5px; margin-bottom: 1px;">
                                        <p class="col-sm-6 col-xs-8 text-left text-brown" style="font-size: 10px;">'.CHtml::encode( $val["title"] ).'</p>
                                        <p class="col-sm-6 col-xs-4 text-right text-brown" style="font-size: 10px;">'.date( "Y-m-d", $val["create_time"] ).'</p>
                                    </div>
								</a>';
                }
                echo urldecode($msg);
                //$this->renderPartial( '_list', array( 'posts' => $postArr , 'pages' => $limit, 'cate_name' => $cateInfo['cate_name'] ) );
            }else
                echo 'end';
            Yii::app()->end();    
        }
    }
    
    /**
    *添加评论
    */
    public function actionCreateComment()
    {
        if ( isset( Yii::app()->session['commentTime'] ) && !empty( Yii::app()->session['commentTime'] ) )
        {
            $second = $_SERVER['REQUEST_TIME'] - Yii::app()->session['commentTime'];
            if ( $second < 30 )
                die('30秒内只能评论一次');
        }
        if ( empty( $_POST['author'] ) )
            die('用户名不能为空'); 
        else
            $author = $_POST['author'];
        if ( empty( $_POST['postId'] ) )
            die('数据错误'); 
        else
            $postId = $_POST['postId'];
        if ( empty( $_POST['email'] ) )
            die('邮箱不能为空');
        else if ( !$this->check_email( $_POST['email'] ) )
            die('邮箱格式不对');
        else
            $email = $_POST['email'];
        if ( empty( $_POST['content'] ) )
            die('内容不能为空');
        else
            $content = $_POST['content'];
        if ( empty( $_POST['webroot'] ) )
            $webroot = Yii::app()->homeUrl;
        else
            $webroot = $_POST['webroot'];
        $host = Yii::app()->request->userHostAddress;
        $dateTime =  date( 'Y-m-d H:i:s', $_SERVER['REQUEST_TIME'] );
        $show = 'FALSE';
        $model = new Comments;
        $model->post_id = $postId;
        $model->author = $author;
        $model->author_email = $email;
        $model->author_webroot = $webroot;
        $model->comment_date = $dateTime;
        $model->comment_content = $content;
        $model->is_show = $show;
        Yii::app()->session['commentTime'] = $_SERVER['REQUEST_TIME'];
        if ( $model->save() ) {
            $sql = 'UPDATE `{{posts}}` SET `comment_count` = `comment_count` + 1';
            $db = Yii::app()->db->createCommand($sql);
            $db->execute();
            echo 'succ';
        }
    }
    
    private function check_email( $email ){
           $pattern = "/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";  //[ch]定义验证email正则表达式
           if( preg_match( $pattern, $email, $counts ) )
           {
                return true;
           }
           else
           {
                return false;
           }
     }
    /**
     *文章展示页 
     */
    public function actionView( $id )
    {
        $rightMenuArr = $this->getRightData();
        
        $postSql = 'SELECT p.*, u.`nickname`, c.`cate_name` FROM `{{posts}}` p LEFT JOIN `{{categorise}}` c ON p.`cate_id` =  c.`id` LEFT JOIN `{{users}}` u ON u.`id` = p.`author` WHERE p.`id` = :id LIMIT 1';
        $postArr = Yii::app()->db->createCommand( $postSql )->bindParam( ':id', $id, PDO::PARAM_INT )->queryRow();
        
        $commentSql = 'SELECT `author`, `comment_content`, `comment_date` FROM `{{comments}}` WHERE `post_id` = :postId AND `is_show` = 1 ';
        $commentArr = Yii::app()->db->createCommand( $commentSql )->bindParam( ':postId', $id, PDO::PARAM_INT )->queryAll();
        
        if ( isset($postArr['tag_id']) && $postArr['tag_id'] != 0 )
        {
            $limit = substr_count( $postArr['tag_id'], ',' ) + 1;
            $tagSql = 'SELECT `id`, `tagname` FROM `{{tags}}` WHERE id IN ( '.$postArr['tag_id'].' ) LIMIT :limit';
            $tagArr = Yii::app()->db->createCommand( $tagSql )->bindParam( ':limit', $limit, PDO::PARAM_INT )->queryAll();              
        }
        else
            $tagArr = 0;
        $this->render( 'view', array( 'post' => $postArr, 'comments' => $commentArr, 'tags' => $tagArr, 'rightMenu' => $rightMenuArr ) );
    }
    private function getRightData(){
        
        $tagSql = 'SELECT `id`, `tagname` FROM `{{tags}}` ORDER BY `id` DESC LIMIT 20 ';
        $tagArr = Yii::app()->db->createCommand( $tagSql )->queryAll();
        
        $hotPostsSql = 'SELECT `id`, `title` FROM `{{posts}}` WHERE `status` = 2 ORDER BY `id` DESC LIMIT 10';
        $hotPostArr = Yii::app()->db->createCommand( $hotPostsSql )->queryAll();
        
        $newPostsSql = 'SELECT `id`, `title` FROM `{{posts}}` ORDER BY `id` DESC LIMIT 10';
        $newPostArr = Yii::app()->db->createCommand( $newPostsSql )->queryAll();
        $resultArr = array( 'tags' => $tagArr, 'hot' => $hotPostArr, 'new' => $newPostArr );
        return $resultArr;
    }
}
