<?php
$this->renderPartial( '../site/_topNav', array('cate_id' => '-1' ) ); 
?>
<div class="content"> 
    <div id="imageView" class="container">
    <?php if( !empty( $ablums ) ){
        $this->renderPartial( '_list', array ( 'ablums' => $ablums, 'lastId' => $lastId ) );    
    ?>
    <?php }?> 
    </div> 
    <div id="loading" class="col-sm-12 col-xs-12 btn bg-gold">换一组</div>
</div>
<div class="clearfix height"></div>