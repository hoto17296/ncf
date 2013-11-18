<? if($is_login): ?>
<p id="user_status">
  ログイン中： <?= $user['name'] ?><br/>
<? if($user['id']==1): ?>
  <?= $this->Html->link('[ ログアウトする ]', '/logout') ?>
<? else: ?>
  <?= $this->Html->link("[ マイページ ]", '/my') ?>
<? endif ?>
</p>
<? endif ?>
