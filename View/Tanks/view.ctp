<? $this->Html->css('tank', null, array('inline' => false)) ?>

<h2><?= $tank['Tank']['name'] ?></h2>

<div class="tank">
<? function css_comp($arr){ return join(';', array_map(function($k,$v){return"$k:$v";}, array_keys($arr), array_values($arr))); } ?>
<? foreach($images as $image): ?>
<?php
$style = array(
  'div' => array(
    'top' => mt_rand(0,360)."px",
    'animation-delay' => mt_rand(0,2000)."ms",
    '-webkit-animation-delay' => mt_rand(0,2000)."ms",
    'animation-duration' => mt_rand(8000,12000)."ms",
    '-webkit-animation-duration' => mt_rand(8000,12000)."ms"
  ),
  'img' => array(
    'animation-delay' => mt_rand(0,2000).'ms',
    '-webkit-animation-delay' => mt_rand(0,2000).'ms',
    'animation-duration' => mt_rand(2000,3000).'ms',
    '-webkit-animation-duration' => mt_rand(2000,3000).'ms'
  )
);
$style['div'] = css_comp($style['div']);
$style['img'] = css_comp($style['img']);
?>
  <div class="fish swim" style="<?=$style['div']?>"><?=$this->Html->image('upload/'.$image['Image']['id'].'.png', array('class'=>'updown', 'style'=>$style['img']))?></div>
<? endforeach ?>
</div>

<ul>
<? foreach($tank['Fish'] as $fish): ?>
  <li><?= $this->Html->link($fish['name'].'の絵を描く', '/images/paint/'.$fish['id']) ?></li>
<? endforeach ?>
</ul>
