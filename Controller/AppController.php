<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

  public $components = array(
    'Session',
/*    'Auth' => array(
      'flash' => array(
        'element' => 'alert',
        'key' => 'auth',
        'params' => array(
          'plugin' => 'BoostCake',
          'class' => 'alert-error'
        )
      )
    )*/
  );

  public $helpers = array(
    'Session',
    'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
    'Form' => array('className' => 'BoostCake.BoostCakeForm'),
    'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
  );

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
