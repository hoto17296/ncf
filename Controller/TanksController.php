<?php
App::uses('AppController', 'Controller');
/**
 * Tanks Controller
 *
 * @property Tank $Tank
 * @property PaginatorComponent $Paginator
 */
class TanksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Tank->recursive = 0;
		$this->set('tanks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tank->exists($id)) {
			throw new NotFoundException(__('Invalid tank'));
		}
		$options = array('conditions' => array('Tank.' . $this->Tank->primaryKey => $id));
		$this->set('tank', $this->Tank->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tank->create();
			if ($this->Tank->save($this->request->data)) {
				$this->Session->setFlash(__('The tank has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tank could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tank->exists($id)) {
			throw new NotFoundException(__('Invalid tank'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tank->save($this->request->data)) {
				$this->Session->setFlash(__('The tank has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tank could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tank.' . $this->Tank->primaryKey => $id));
			$this->request->data = $this->Tank->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tank->id = $id;
		if (!$this->Tank->exists()) {
			throw new NotFoundException(__('Invalid tank'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tank->delete()) {
			$this->Session->setFlash(__('The tank has been deleted.'));
		} else {
			$this->Session->setFlash(__('The tank could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
