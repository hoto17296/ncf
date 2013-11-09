<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

  public $helpers = array(
    'Session',
    'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
    'Form' => array('className' => 'BoostCake.BoostCakeForm'),
    'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
  );

  public function beforeFilter(){
    $this->set('is_login', $this->isLogin());
    if ($this->isLogin()){
      $this->set('user', $this->getUser());
    }
  }

  public function setTitle($title) {
    return $this->set('title_for_layout', $title . ' | お絵かきアクアリウム');
  }

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
