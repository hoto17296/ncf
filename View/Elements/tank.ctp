<? $this->Html->css('tank', null, array('inline' => false)) ?>
<div class="tank">
<? function css_comp($arr){ return join(';', array_map(function($k,$v){return"$k:$v";}, array_keys($arr), array_values($arr))); } ?>
<? foreach($fishes as $fish): ?>
<?php
$style = array(
  'fish' => array(
    'top' => mt_rand(-20,80)."px",
    'animation-delay' => mt_rand(0,2000)."ms",
    '-webkit-animation-delay' => mt_rand(0,2000)."ms",
    'animation-duration' => mt_rand(8000,12000)."ms",
    '-webkit-animation-duration' => mt_rand(8000,12000)."ms"
  ),
  'updown' => array(
    'animation-delay' => mt_rand(0,2000).'ms',
    '-webkit-animation-delay' => mt_rand(0,2000).'ms',
    'animation-duration' => mt_rand(2000,3000).'ms',
    '-webkit-animation-duration' => mt_rand(2000,3000).'ms'
  )
);
$style['fish'] = css_comp($style['fish']);
$style['updown'] = css_comp($style['updown']);
?>
  <div class="fish" style="<?=$style['fish']?>">
    <div class="updown" style="<?=$style['updown']?>">
      <?=$this->Html->image('upload/'.$fish['Image']['id'].'.png')?>

      <div class="fukidashi">
        <p class="fishname"><?=$fish['Fish']['name']?></p>
        <p class="artist">by <?=$fish['User']['name']?></p>
      </div>
    </div>
  </div>
<? endforeach ?>
<? if(count($fishes)==0): ?>
  <p class="empty">この水槽には魚はまだいません(´・ω・`)</p>
<? endif ?>
</div>

