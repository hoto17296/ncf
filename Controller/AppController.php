<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

  public $components = array('Session');
  
  public function getUser() {
    return $this->Session->read('user');
  }

  public function isLogin() {
    return !!$this->getUser();
  }

  public function checkLogin() {
    if (!$this->isLogin()){
      $this->redirect('/users/login');
    }
  }

  public function setUserInfo() {
    $this->set('is_login', $this->isLogin());
    if ($this->isLogin()) {
      $this->set('user_info', $this->getUser());
    }
  }
}
