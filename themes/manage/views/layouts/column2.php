<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="col-md-9 col-xs-12">
        <?php echo $content; ?>
    </div>
    <div class="col-md-3 col-xs-12">
        <?php
		$this->beginWidget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'list-unstyled text-white'),
		));
		$this->endWidget();
	   ?>
    </div>
</div>
<?php $this->endContent(); ?>
