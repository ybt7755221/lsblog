<div id="upload_img" class="well row text-center" style="max-width: 600px; margin:0 auto;" >
    <img src="<?php echo Yii::app()->baseUrl.CHtml::encode( $userLogo ); ?>" width="150px" height="150px" />
    <div class="height"></div>
    <form class="form" action="<?php echo Yii::app()->createUrl( '/manage/users/userLogo' );?>" method="POST" enctype="multipart/form-data">
        <div class="input-group col-md-8 col-xs-10">
            <input id="fileToUpload" class="form-control" type="hidden" name="type" value="1" readonly="readonly" />
            <input id="fileToUpload" class="form-control" type="file" name="UserField[logo]" />
            <span class="input-group-addon text-muted font-Small">剪切功能只支持jpeg,png格式</span>
        </div>
        <input class="col-md-4 col-xs-2 btn btn-primary" type="submit" name="btn" value="上传" />
    </form>
</div>