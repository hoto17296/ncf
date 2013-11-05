<!DOCTYPE html>
<html lang="ja">
<head>
  <?= $this->Html->charset() ?>
	<title><?= $title_for_layout ?></title>
<?php
  echo $this->Html->css('jquery-ui.custom/lightness.css');
  echo $this->Html->css('jquery.colorpicker.css');
  echo $this->Html->css('jquery.paint.css');
  echo $this->Html->script('jquery.min.js');
  echo $this->Html->script('jcanvas.min.js');
  echo $this->Html->script('jquery-ui.custom.min.js');
  echo $this->Html->script('jquery.colorpicker.js');
  echo $this->Html->script('jquery.paint.js');
?>
</head>
<body>

<h1 style="color:#666"><?= $fish['Fish']['name'] ?> の絵を描く</h1>

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
