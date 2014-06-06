var urlRoot = '/index.php';
$( document ).ready( function(){
   $( '#button' ).click( function(){
        var theme_id = $( 'input[type=radio][name=theme_id]:checked' ).val();
        $.post( urlRoot + '/manage/site/theme', { theme_id : theme_id }, 
            function(txt){
                if ( txt == 'success' )
                {
                    alert( '模版已启用' );
                }
                else if ( txt == 'double' )
                {
                    alert( '模版正在使用' );
                }
            } );
    });
    
    $( '#update_passwd' ).click( function(){
        var oldPass = $('input[name=password]').val();
        var newPass = $('input[name=newPasswd]').val();
        var repPass = $('input[name=resPasswd]').val();
        var txt = '';
        if ( oldPass == '' || newPass == '' || repPass == '' )
        {
            txt = '密码不能为空';
            $( '#danger' ).html( txt );
        }
        else if ( newPass != repPass )
        {
            txt = '两次密码不一致';
            $( '#danger' ).html( txt );
        }
        else if ( String(newPass).length  < 6 )
        {
            txt = '密码长度不能小于6位';
            $( '#danger' ).html( txt );
        }
        else
        {
            $.post( urlRoot + '/manage/Users/updatePassword', 
                { password : oldPass, newPasswd : newPass, resPasswd : repPass },
                function( result ){
                    $( '#danger' ).html( result );
                }
            );
        }
    });
    
});

function saveBackUp( id )
{
    var tag = '#backup' + id;
    var backup = $(tag).val();
    $.ajax({
            type : 'POST', 
            url : urlRoot + '/manage/ablum/saveBackUp',
            data : { ajax : 'AJAX', backup : backup, id : id },
            timeout : 1000, 
            error : function(){ alert( 'Error loading PHP document' ); }, 
            success : function( data )
                    {
                        if ( data == 'succ' )
                        {
                            alert( '保存成功' );
                        }
                        else
                        {
                            alert( data );
                        }
                    }
        });
}

function ajaxFileUpload()
{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url : urlRoot + '/manage/Users/AjaxUpload',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				data:{name:'logan', id:'id'},
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
                            $('#upload_img').css('display', 'none');
						}
					}
				},
			}
		)
		
		return false;

}
var editor_a = UE.getEditor('myEditor',{initialFrameHeight:500});