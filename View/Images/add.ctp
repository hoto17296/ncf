<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.custom/lightness.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.paint.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jcanvas.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.colorpicker.js"></script>
	<script type="text/javascript" src="js/jquery.paint.js"></script>
</head>
<body>

<h1 style="color:#666">jQuery.paint デモページ</h1>

<script type="text/javascript">
$(function(){
	$('#paint').paint({
		upload : function(image){
			// アップロード処理
		},
	});
});
</script>

<div id="paint"></div>

</body>
</html>
