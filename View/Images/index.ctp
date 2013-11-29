<? foreach($images as $image): ?>
<?= $this->Html->image('upload/'.$image['Image']['id'].'.png', array('title'=>$image['Fish']['name'].' by '.$image['User']['name'], 'style'=>'width:100px')) ?>
<? endforeach ?>
