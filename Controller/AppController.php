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

  public function setFlash($message, $class='success'){
    return $this->Session->setFlash($message, 'alert', array(
      'plugin' => 'BoostCake',
      'class' => 'alert-' . $class
    ));
  }

  public function getUser($key=NULL) {
    $user = $this->Session->read('user');
    return (is_null($key) || !array_key_exists($key, $user))
      ? $user
      : $user[$key];
  }

  public function isLogin() {
    return !!$this->getUser();
  }

  public function checkLogin() {
    if (!$this->isLogin()){
      $this->Session->write('callback', $this->request->url);
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
