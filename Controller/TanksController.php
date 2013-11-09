<?php
App::uses('AppController', 'Controller');

class TanksController extends AppController {

  public $uses = array('Tank', 'Image', 'Fish');

	public function index() {
	}

  public function view($id = null) {

		if (!$this->Tank->exists($id)) {
			throw new NotFoundException(__('Invalid tank'));
		}
    $options = array(
      'conditions' => array('Tank.' . $this->Tank->primaryKey => $id)
    );
    $this->set('tank', $this->Tank->find('first', $options));

    // 水槽の魚のイラスト一覧を取得
    $fish = $this->Fish->find('list', array('conditions'=>array('Fish.tank_id'=>$id)));
    $lambda = function($fish_id){ return array('Image.fish_id'=>$fish_id); };
    $options = array('conditions' => array('OR' => array_map($lambda, array_keys($fish))));
		$this->set('images', $this->Image->find('all', $options));
	}

  public function north(){
		$this->set('tanks', $this->Tank->find('all'));
  }
  public function south(){
		$this->set('tanks', $this->Tank->find('all'));
  }

}
