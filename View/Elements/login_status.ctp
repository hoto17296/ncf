<? if($is_login): ?>
<p id="user_status"><?= $this->Html->link("ログイン中： {$user['name']}", '/my') ?></p>
<? endif ?>
