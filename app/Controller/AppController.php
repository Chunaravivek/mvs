<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('Session','Cookie','RequestHandler','Email', 'Flash');
    
    public function constructClasses() {

        if (Configure::read('debug') >= 1):
            $this->components[] = 'DebugKit.Toolbar';
        endif;
        
        parent::constructClasses();
    }
    
    function beforeFilter() {
        
        parent::beforeFilter();
        $this->chklogin();
    }
    
    function chklogin(){
        if($this->Session->read('admin_id'))
        {
            if(strtolower($this->request->params['controller'])=='admin' && strtolower($this->request->params['action'])=='login'){
                if (isset($this->request->query['returnURL'])) {

                    $controller = $this->request->query['returnURL'];

                    $this->redirect(array('controller'=> $controller));
                }
                $this->redirect(array('controller'=>'Dashboard','action'=>'index'));
            }
        }
        else if(strtolower($this->request->params['controller'])!='admin' || strtolower($this->request->params['action'])!='login')
        {        
//            $controller = isset($this->request->params['controller']) ? $this->request->params['controller'] : 'Dashboard';
            
            $this->redirect(array('controller'=>'Admin', 'action'=>'login', '?' => ['returnURL' => $this->request->params['controller']]));
        }
    }
    
//    public function appError($error) {
//      
//        $this->redirect(array('controller' => 'NotFounds')); 
//    }
}
