<?=$this->element('header')?>

<h2>北館</h2>

<ul>
<? foreach($tanks as $tank): ?>
  <li><?= $this->Html->link($tank['Tank']['name'], $tank['Tank']['id']) ?></li>
<? endforeach ?>
</ul>
