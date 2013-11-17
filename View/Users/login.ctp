<?= $this->element('header') ?>

<div class="alert alert-warning">
  <span class="glyphicon glyphicon-exclamation-sign"></span>
  お絵かきをするにはログインが必要です
</div>

<ul class="link_list">
  <li>
    <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-right"></span> Twitterアカウントでログイン', '/twitter', array('escape'=>false)) ?>
  </li>
  <li>
    <?= $this->Html->link('<span class="glyphicon glyphicon-arrow-right"></span> 「名無しさん」としてログイン', '/anonymous', array('escape'=>false)) ?>
  </li>
</ul>

<p>Twitterアカウントでログインすると、自分の描いた魚の一覧を観ることが出来ます。</p>
