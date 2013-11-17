<?php
App::uses('AppController', 'Controller');

class ImagesController extends AppController {

  public $uses = array('Image', 'Fish');

  public function paint($fish_id){
    $this->layout = false;
    $this->checkLogin();
    $this->setTitle('お絵かきページ');

    if (!$this->Fish->exists($fish_id)) {
      throw new NotFoundException(__('Invalid fish'));
    }

    $this->set('fish', $this->Fish->findById($fish_id));
  }

  public function upload() {
    $this->autoRender = false;
    $this->checkLogin();

    $data = array(
      'Image' => array(
        'user_id' => $this->getUser('id'),
        'fish_id' => $this->request->data['fish_id']
      )
    );
    if ($this->Image->save($data) &&
      $this->Image->upload($this->request->data['image'], $this->Image->getLastInsertID())){
      $res = array(
        'Status' => 'Success',
        'Message' => 'Upload Succeed!'
      );
    }
    else {
      $res = array(
        'Status' => 'Error',
        'Message' => 'Upload Failed...'
      );
    }
    header('Content-Type: text/javascript; charset=utf-8');
    echo json_encode($res);
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
