<? $this->Html->css('tank', null, array('inline' => false)) ?>
<?=$this->element('header')?>

<h2><?= $tank['Tank']['name'] ?></h2>

<div class="tank">
<? function css_comp($arr){ return join(';', array_map(function($k,$v){return"$k:$v";}, array_keys($arr), array_values($arr))); } ?>
<? foreach($images as $image): ?>
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
      <?=$this->Html->image('upload/'.$image['Image']['id'].'.png')?>

      <div class="fukidashi">
        <p class="fishname"><?=$image['Fish']['name']?></p>
        <p class="artist">by <?=$image['User']['name']?></p>
      </div>
    </div>
  </div>
<? endforeach ?>
</div>

<?= $this->Form->create('Image', array(
	'inputDefaults' => array(
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
  'class' => 'form-inline',
  'action' => 'paint',
  'onSubmit' => "location.href='{$this->Html->url('/images/paint/')}'+this.fish_id.value;return false"
)) ?>
この水槽の
<?= $this->Form->select('fish_id', $fishes, array('name'=>'fish_id', 'empty'=>false)) ?>
の絵を
<?= $this->Form->submit('描く！', array('div' => false, 'class' => 'btn btn-success btn-lg')) ?>
<?= $this->Form->end() ?>
