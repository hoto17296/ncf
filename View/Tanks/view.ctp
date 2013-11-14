<? $this->Html->css('tank', null, array('inline' => false)) ?>
<?=$this->element('header')?>

<h2><?= $tank['Tank']['name'] ?></h2>

<div class="tank">
<? function css_comp($arr){ return join(';', array_map(function($k,$v){return"$k:$v";}, array_keys($arr), array_values($arr))); } ?>
<? foreach($images as $image): ?>
<?php
$style = array(
  'div' => array(
    'top' => mt_rand(-20,80)."px",
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

<?= $this->Form->create('Image', array(
	'inputDefaults' => array(
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
  'class' => 'form-inline',
  'action' => 'paint'
)) ?>
この水槽の
<?= $this->Form->select('fish_id', $fishes, array('empty'=>false)) ?>
の絵を
<?= $this->Form->submit('描く！', array('div' => false, 'class' => 'btn btn-success btn-lg')) ?>
<?= $this->Form->end() ?>
<script>
$(function(){
  $('#ImagePaintForm').submit(function(e){
    e.preventDefault();
    location.href = "<?= $this->Html->url('/images/paint/') ?>" + $("#ImageFishId").val();
  });
})
</script>
