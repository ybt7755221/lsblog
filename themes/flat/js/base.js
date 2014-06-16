var urlRoot = '/index.php';
$( document ).ready( function(){    
    $('#postComment').click(function(){
        var postId = $('input[name=post_id').val();
        var author = $('input[name=author').val();
        var webroot = $('input[name=author_webroot').val();
        var email = $('input[name=author_email').val();
        var content = $('#comment_content').val();
        
        $.ajax({ url: urlRoot + '/posts/createComment', 
            type : 'POST', 
            data : { postId : postId, email : email, author : author, webroot : webroot, content : content}, 
            timeout : 1000, 
            error : function(){ alert( 'Error loading PHP document' ); }, 
            success : function( data )
                    {
                        if ( data == 'succ' )
                        {
                            $( '#info' ).html( '评论成功，等待审核' );
                            $('input[name=post_id').val('');
                            $('input[name=author').val('');
                            $('input[name=author_webroot').val('');
                            $('input[name=author_email').val('');
                            $('#comment_content').val('');
                        }
                        else
                        {
                            $( '#info' ).html( data );
                        }
                    }
        });
    });
    
    $('#loading').click(function(){
        var id = $('#lastId').html();
        $.ajax({ url: urlRoot + '/ablum/ajaxPager', 
            type : 'POST', 
            data : { ajax : 'AJAX', id : id }, 
            timeout : 1000, 
            error : function(){ alert( 'Error loading PHP document' ); }, 
            success : function( data )
                    {
                        if ( data != ' ' )
                        {
                            $('#imageView').html( data );
                        }
                        else
                        {
                            alert( '已经是最后一页' );
                        }
                    }
        });
    })
});

function ajaxPager( tag )
{
    if ( tag == 'prev' )
        var postId = $( '#firstId' ).val(); 
    else if ( tag == 'next' )
        var postId = $( '#lastId' ).val(); 
    var cateId = $( '#category' ).text() * 1;
    var cateName = $( '#cateName' ).html();
    $.ajax({ url : urlRoot + '/posts/ajaxPager',
            type : 'POST',
            data : { postId : postId, cateId : cateId, cateName : cateName, tag : tag, ajax : 'AJAX' }, 
            timeout : 1000, 
            error : function(){ alert( 'Error loading PHP document' ); }, 
            success : function( data )
                    {
                        if ( data == 'end' ) 
                        {
                            if ( tag == 'prev' )
                                alert( '已经是第一页' );
                            else if ( tag == 'next' )
                                alert( '已经是最后一页' );
                        }
                        else
                        {
                            $('#listview').html( data );
                        }
                    }
    });
}

function ajaxTagPager( tag, tagId )
{
    if ( tag == 'prev' )
        var postId = $( '#firstId' ).val(); 
    else if ( tag == 'next' )
        var postId = $( '#lastId' ).val(); 
    var tagId = $( '#tag' ).text() * 1;
    $.ajax({ url : urlRoot + '/tags/ajaxPager',
            type : 'POST',
            data : { postId : postId, tagId : tagId, tag : tag, ajax : 'AJAX' }, 
            timeout : 1000, 
            error : function(){ alert( 'Error loading PHP document' ); }, 
            success : function( data )
                    {
                        if ( data == 'end' ) 
                        {
                            if ( tag == 'prev' )
                                alert( '已经是第一页' );
                            else if ( tag == 'next' )
                                alert( '已经是最后一页' );
                        }
                        else
                        {
                            $('#listview').html( data );
                        }
                    }
    });
}