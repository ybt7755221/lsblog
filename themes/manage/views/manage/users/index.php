<?php
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl."/js/base.js", CClientScript::POS_END );
$this->breadcrumbs=array(
    'User',
);

$this->menu=array(
    array('label'=>'Options', 'itemOptions' => array( 'class' => 'list-group-item bg-block lg-header' ) ),
	array('label'=>'Update Logo', 'url'=>array( '/manage/users/userLogo' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array('label'=>'Update Infomation', 'url'=>array( '/manage/users/update' ), 'itemOptions' => array( 'class' => 'list-group-item' ) ),
    array('label'=>'Update Password', 'url'=>'javascript:void(0);', 'itemOptions' => array( 'class' => 'list-group-item', 'data-toggle' => "modal", 'data-target' => "#myModal" ) ),
);
?>
<div class="panel">
    <h1 class="text-center">我的主页</h1>
    <table class="table table-condensed">
        <tr class="bg-block" >
            <th colspan="3"><?php echo Yii::app()->user->name ; ?> - 用户资料</th>
        </tr>
        <tr>
            <td class="center" rowspan="6" style="width: 160px; vertical-align: middle;" ><img src="<?php echo Yii::app()->baseUrl.$user['logo']; ?>" alt="<?php echo Yii::app()->user->name ; ?>" class="img-circle" width="150" height="150" /></td>
            <td>身高 : <?php echo CHtml::encode( $user['height'] ); ?></td>
            <td>体重 : <?php echo CHtml::encode( $user['weight'] ); ?></td>
        </tr>
        <tr>
            <td>血型 : <?php echo CHtml::encode( $user['blood'] ); ?></td>
            <td>性别 : <?php echo CHtml::encode( $user['sex'] ); ?></td>
        </tr>
        <tr>
            <td>取向 : <?php echo CHtml::encode( $user['sexual'] ); ?></td>
            <td>感情 : <?php echo CHtml::encode( $user['felling'] ); ?></td>
        </tr>
        <tr>
            <td>生日 : <?php echo CHtml::encode( $user['birthday'] ); ?></td>
            <td>QQ : <?php echo CHtml::encode( $user['qq'] ); ?></td>
        </tr>  
        <tr>
            <td>微博 : <?php echo CHtml::encode( $user['weibo'] ); ?></td>
            <td>微信 : <?php echo CHtml::encode( $user['weixin'] ); ?></td>
        </tr>
        <tr>
            <td>MSN : <?php echo CHtml::encode( $user['msn'] ); ?></td>
            <td>EMAIL : <?php echo CHtml::encode( $user['email'] ); ?></td>
        </tr> 
    </table>
</div>
<?php $this->renderPartial( '_updatePasswd' ); ?>