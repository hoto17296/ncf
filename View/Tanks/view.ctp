<h2><?= $tank['Tank']['name'] ?></h2>

<ul>
<? foreach($tank['Fish'] as $fish): ?>
  <li><?= $this->Html->link($fish['name'].'の絵を描く', '/images/add/'.$fish['id']) ?></li>
<? endforeach ?>
</ul>
