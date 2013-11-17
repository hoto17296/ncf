<? if($is_login): ?>
<? if($user['id']==1): ?>
<p id="user_status">
  ログイン中： <?= $user['name'] ?><br/>
  <?= $this->Html->link('[ ログアウトする ]', '/logout') ?>
</p>
<? else: ?>
<p id="user_status"><?= $this->Html->link("ログイン中： {$user['name']}", '/my') ?></p>
<? endif ?>
<? endif ?>
