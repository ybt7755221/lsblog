<?php 
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl.'/js/jquery.Jcrop.min.js', CClientScript::POS_END );
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl.'/js/jcrop.js', CClientScript::POS_END );
?>

<div id="outer" class="well" style=" max-width: 600px; margin:0 auto">
    <img src="<?php echo Yii::app()->baseUrl.$imagePath; ?>" id="cropbox" />
    <form action="<?php echo Yii::app()->createUrl('/manage/users/crop'); ?>" method="post" onsubmit="return checkCoords();">
        <input type="hidden" name="path" value="<?php echo $imagePath; ?>" id="pathInput" readonly="readonly" />
        <input type="hidden" id="x" name="x" />
        <input type="hidden" id="y" name="y" />
        <input type="hidden" id="w" name="w" />
        <input type="hidden" id="h" name="h" />
    <div class="text-center height">
        <input type="submit" class="btn btn-primary" value="Crop Image" />
    </div>
    </form>
</div>