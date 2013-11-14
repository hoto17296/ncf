<? $this->Html->css('tank', null, array('inline' => false)) ?>

<h2><?= $tank['Tank']['name'] ?></h2>

<div class="tank">
<? foreach($images as $image): ?>
<?php
$style = array(
  'div' => sprintf("top:%dpx;animation-delay:%dms;animation-duration:%dms", mt_rand(0,360), mt_rand(0,2000), mt_rand(8000,12000)),
  'img' => sprintf("animation-delay:%dms;animation-duration:%dms", mt_rand(0,2000), mt_rand(2000,3000))
);
?>
  <div class="fish swim" style="<?=$style['div']?>"><?=$this->Html->image('upload/'.$image['Image']['id'].'.jpg', array('class'=>'updown', 'style'=>$style['img']))?></div>
<? endforeach ?>
</div>

<ul>
<? foreach($tank['Fish'] as $fish): ?>
  <li><?= $this->Html->link($fish['name'].'の絵を描く', '/images/paint/'.$fish['id']) ?></li>
<? endforeach ?>
</ul>
