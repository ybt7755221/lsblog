<script type="text/javascript" src="ueditor.config.js"></script>
<script type="text/javascript" src="ueditor.all.js"></script>
<link rel="stylesheet" href="themes/default/css/ueditor.css"/>
<form id="form" method="post" target="_blank">
<div id="myEditor" name="myEditor">
<p>欢迎使用UEditor！</p>
</div>
<input type="submit" value="通过input的submit提交">
</form>
<script type="text/javascript">
        var editor_a = UE.getEditor('myEditor',{initialFrameHeight:500});
        //--自动切换提交地址----
        var doc=document,
            version=editor_a.options.imageUrl||"php",
            form=doc.getElementById("form");
            form.action="./getContent.php";
</script>