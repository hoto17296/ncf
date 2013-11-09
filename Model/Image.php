<?php
App::uses('AppModel', 'Model');

class Image extends AppModel {

	public $validate = array(
		'fish_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
  );

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fish' => array(
			'className' => 'Fish',
			'foreignKey' => 'fish_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
  );

	public function upload($image, $image_id){
    $image = base64_decode(str_replace('data:image/jpeg;base64,', '', $image));
    $filepath = WWW_ROOT . 'img/upload/' . $image_id . '.jpg';
    return file_put_contents($filepath, $image);
  }
}
