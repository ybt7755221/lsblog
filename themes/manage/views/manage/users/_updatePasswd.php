<!-- Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Update Password</h4>
        </div>
        <div class="modal-body">
            <?php $form=$this->beginWidget('CActiveForm', array(
               	'id'=>'user-field-form',
   	            'enableAjaxValidation'=>true,
                'action' => array( '/manage/Users/updatePassword' ),
                'htmlOptions' => array( 'class' => 'form text-center' ),
            )); ?>
                <div class="input-group">
                    <span class="input-group-addon">Old Password</span>
                    <input class="form-control" type="password" name="password" value="" />
                </div><br />
                <div class="input-group">
                    <span class="input-group-addon">New Password</span>
                    <input class="form-control" type="password" name="newPasswd" value="" />
                </div><br />
                <div class="input-group">
                    <span class="input-group-addon">Repeat Password</span>
                    <input class="form-control" type="password" name="resPasswd" value="" />
                </div><br />
                <p class="text-danger" id="danger"></p>
               	<div class="modal-footer">
                    <input type="button" id="update_passwd" class="btn btn-primary" value="update" />
                </div>
                <?php $this->endWidget(); ?>

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->