<?php
class TagsController extends Controller
{
    public function filters() {
            return array (
                array (
                    'COutputCache + index',
                    'duration' => 604800,
                    'varyByParam' => array('id'),
                )
            );
    }
    
	public function actionIndex( $id )
	{
        $limit = $this->_page;
        $id = $id*1;
		$postSql = "SELECT p.`id`, p.`title`, p.`excerpt`, c.`cate_name`, c.`cate_english`, p.`tag_id`, p.`create_time` FROM `{{posts}}` p LEFT JOIN `{{categorise}}` c ON p.`cate_id` = c.`id` WHERE `tag_id` LIKE '%".$id."%' ORDER BY `type` DESC, `id` DESC LIMIT :limit";
        $result = Yii::app()->db->createCommand( $postSql );
        $result->bindValue( ':limit', $limit, PDO::PARAM_INT );
        $postsArr = $result->queryAll();
        $postCount = count( $postsArr );
        $hotPostsSql = 'SELECT `id`, `title` FROM `{{posts}}` WHERE `status` = 1 ORDER BY `id` DESC LIMIT 10';
        $hotPostArr = Yii::app()->db->createCommand( $hotPostsSql )->queryAll();
        $tagSql = 'SELECT `id`, `tagname` FROM `{{tags}}` ORDER BY `id` DESC LIMIT 20 ';
        $tagArr = Yii::app()->db->createCommand( $tagSql )->queryAll(); 
        if( $postCount < $limit )
            $noPage = 1;
        else
            $noPage = 0;
        $this->render( 'index', array(
            'posts' => $postsArr,
            'tags'=> $tagArr,
            'hotPosts' => $hotPostArr,
            'postsCount' => $postCount,
            'noPage' => $noPage,
            'tag_id' => $id,
        ) );
	}
    
    public function actionAjaxPager()
    {
        if ( isset( $_POST['ajax'] ) && $_POST['ajax'] == 'AJAX' )
        {  
           
            $limit = $this->_page;
            $tagId = $_POST['tagId'] * 1;
            $postId = $_POST['postId'] * 1;
            if ( $_POST['tag'] === 'prev' )
                $connection = 'p.`id` > :id ';
            elseif ( $_POST['tag'] === 'next' )
                $connection = 'p.`id` < :id ';
            $postSql = 'SELECT p.`id`, p.`title`, p.`excerpt`,  p.`tag_id`, c.`cate_name`, c.`cate_english`, p.`create_time` FROM `{{posts}}` p LEFT JOIN `{{categorise}}` c ON p.cate_id = c.id WHERE p.`tag_id` LIKE "%'.$tagId.'%" AND '.$connection.' ORDER BY p.`id` DESC LIMIT :limit';
            $postCommand = Yii::app()->db->createCommand( $postSql );
            $postCommand->bindParam( ':id', $postId, PDO::PARAM_INT );
            $postCommand->bindParam( ':limit', $limit, PDO::PARAM_INT );
            $postArr = $postCommand->queryAll();
            $pageCount = count( $postArr );
            if ( !empty( $postArr ) )
            {
                $this->renderPartial( '_list', array( 'posts' => $postArr , 'pages' => $pageCount ) );
            }else
                echo 'end';
            Yii::app()->end();    
        }
    }
}
