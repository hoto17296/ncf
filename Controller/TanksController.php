<?php
App::uses('AppController', 'Controller');

class TanksController extends AppController {

  public $uses = array('Tank', 'Image', 'Fish');

	public function index() {
    $this->set('title_for_layout', 'お絵かきアクアリウム');
  }

  public function my() {
    if (!$this->isLogin()){
      $this->redirect('/');
    }
    $this->set('images', $this->Image->find('all', array('conditions'=>array('user_id'=>$this->getUser('id')))));
  }

  public function view($id = null) {

		if (!$this->Tank->exists($id)) {
			throw new NotFoundException(__('Invalid tank'));
		}
    $options = array(
      'conditions' => array('Tank.' . $this->Tank->primaryKey => $id)
    );
    $tank = $this->Tank->find('first', $options);
    $this->setTitle($tank['Tank']['name']);

    // 水槽の魚のイラスト一覧を取得
    $fishes = $this->Fish->find('list', array('conditions'=>array('Fish.tank_id'=>$id)));
    $lambda = function($fish_id){ return array('Image.fish_id'=>$fish_id); };
    $options = array('conditions' => array('OR' => array_map($lambda, array_keys($fishes))));
    $images = $this->Image->find('all', $options);
    
		$this->set(compact('tank','fishes','images'));
	}

  public function north(){
    $this->setTitle('北館');
		$this->set('tanks', $this->Tank->find('all', array('conditions'=>array('building'=>'north'))));
  }
  public function south(){
    $this->setTitle('南館');
		$this->set('tanks', $this->Tank->find('all', array('conditions'=>array('building'=>'south'))));
  }

}
