<?=$this->element('header')?>

<h2><?= $tank['Tank']['name'] ?></h2>

<?= $this->element('tank', array('fishes'=>$images)) ?>

<?= $this->Form->create('Image', array(
	'inputDefaults' => array(
		'label' => false,
		'wrapInput' => false,
		'class' => 'form-control'
	),
  'class' => 'form-inline',
  'action' => 'paint',
  'onSubmit' => "location.href='{$this->Html->url('/paint/')}'+this.fish_id.value;return false"
)) ?>
この水槽の
<?= $this->Form->select('fish_id', $fishes, array('name'=>'fish_id', 'empty'=>false)) ?>
の絵を
<?= $this->Form->submit('描く！', array('div' => false, 'class' => 'btn btn-success btn-lg')) ?>
<?= $this->Form->end() ?>
