<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<title>
		<?= $title_for_layout ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
    
    echo $this->Html->script('//code.jquery.com/jquery-2.0.3.min.js');

    echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css');
    echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js');

    echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">
			<?= $this->Session->flash() ?>

      <?= $this->fetch('content') ?>

		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
