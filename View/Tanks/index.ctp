トップページ

<h2>水槽を観る</h2>

<p><?= $this->Html->link('北館', '/north') ?></p>
<p><?= $this->Html->link('南館', '/south') ?></p>

<?php
if(!$is_login){
  echo $this->Html->link('ログイン', '/users/login');
}
else{
  pr($user);
}
?>
