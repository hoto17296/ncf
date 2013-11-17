<?=$this->element('header')?>

<h2><?=$building_name?></h2>

<ul class="tank_list">
<? foreach($tanks as $tank): ?>
  <li><?= $this->Html->link($tank['Tank']['name'], "/tank/{$tank['Tank']['id']}") ?></li>
<? endforeach ?>
</ul>
