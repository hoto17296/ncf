<?php
App::uses('AppController', 'Controller');

class ImagesController extends AppController {

  public function add($fish_id) {
    $this->setTitle('お絵かきページ');

    $this->loadModel('Fish');
    if (!$this->Fish->exists($fish_id)) {
      throw new NotFoundException(__('Invalid fish'));
    }
    $this->set('fish', $this->Fish->findById($fish_id));

		if ($this->request->is('post')) {
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
				$this->Session->setFlash(__('The image has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The image could not be saved. Please, try again.'));
			}
		}

    $this->layout = false;
  }

	public function delete($id = null) {
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Image->delete()) {
			$this->Session->setFlash(__('The image has been deleted.'));
		} else {
			$this->Session->setFlash(__('The image could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
  }
}
