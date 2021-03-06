<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'tanks', 'action' => 'index'));
	Router::connect('/north', array('controller' => 'tanks', 'action' => 'north'));
	Router::connect('/south', array('controller' => 'tanks', 'action' => 'south'));
	Router::connect('/tank/:id', array('controller' => 'tanks', 'action' => 'view'), array('pass'=>array('id'), 'id'=>'[0-9]+'));
	Router::connect('/paint/:id', array('controller' => 'images', 'action' => 'paint'), array('pass'=>array('id'), 'id'=>'[0-9]+'));
	Router::connect('/my', array('controller' => 'tanks', 'action' => 'my'));
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/twitter', array('controller' => 'users', 'action' => 'twitter'));
	Router::connect('/anonymous', array('controller' => 'users', 'action' => 'anonymous'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
  
  Router::parseExtensions();

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
