<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

  public $components = array('OAuthConsumer');

  public function login() {
    $requestTokenUrl = 'https://api.twitter.com/oauth/request_token';
    $authorizeUrl = 'https://api.twitter.com/oauth/authorize';
    $callbackUrl = Router::url('/users/callback', true);
    $requestToken = $this->OAuthConsumer->getRequestToken('Twitter', $requestTokenUrl, $callbackUrl);
    
    if ($requestToken) {
      $this->Session->write('twitter_request_token', $requestToken);
      $this->redirect($authorizeUrl . '?oauth_token=' . $requestToken->key);
    } else {
      // an error occured when obtaining a request token
    }
  }
 
  public function callback() {
    $this->autoRender = false;
    $accessTokenUrl = 'https://api.twitter.com/oauth/access_token';
    $verifyCredentialsUrl = 'http://api.twitter.com/1.1/account/verify_credentials.json';
    $requestToken = $this->Session->read('twitter_request_token');
    $accessToken = $this->OAuthConsumer->getAccessToken('Twitter', $accessTokenUrl, $requestToken);
    if ($accessToken) {
      $profile = json_decode($this->OAuthConsumer->get('Twitter',$accessToken->key, $accessToken->secret, $verifyCredentialsUrl)); 
      $user = array(
        'id'      => $profile->id,
        'twitter' => $profile->screen_name,
        'name'    => $profile->name,
        'access_token' => $accessToken->key,
        'access_token_secret' => $accessToken->secret
      );
      $this->User->save(array('User' => $user));
      $this->Session->write('user', $user);
    }
    if ($callback = $this->Session->read('callback')){
      $this->Session->delete('callback');
      $this->redirect('/'.$callback);
    } else {
      $this->redirect('/');
    }
  }

  public function logout() {
    $this->Session->delete('user');
    $this->setFlash('ログアウトしました');
    $this->redirect('/');
  }

  public function index() {
    $this->setUserInfo();
  }
}
