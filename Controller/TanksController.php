<?php
App::uses('AppController', 'Controller');

class TanksController extends AppController {

	public function index() {
	}

	public function view($id = null) {
		if (!$this->Tank->exists($id)) {
			throw new NotFoundException(__('Invalid tank'));
		}
		$options = array('conditions' => array('Tank.' . $this->Tank->primaryKey => $id));
		$this->set('tank', $this->Tank->find('first', $options));
	}

  public function north(){
		$this->set('tanks', $this->Tank->find('all'));
  }
  public function south(){
		$this->set('tanks', $this->Tank->find('all'));
  }

}
