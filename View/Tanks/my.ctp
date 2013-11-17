<?= $this->element('header')?>

<h2><?=$user['name']?>の水槽</h2>

<?= $this->element('tank', array('fishes'=>$images)) ?>

<p class="pull-right"><?= $this->Html->link('ログアウトする', '/users/logout') ?></p>
