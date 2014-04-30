<?php
// app/Controller/UsersController.php


class UsersController extends AppController {

    



        public function beforeFilter() {
        parent::beforeFilter();

        // For CakePHP 2.1 and up
        //$this->Auth->allow();
        $this->Auth->autoRedirect = false ; 
    
         $this->loadModel('Areas');
         $this->set('Areas', $this->Areas->find('list'));
         $this->set(compact('Areas'));

         $this->loadModel('Groups');
         $this->set('Groups', $this->Groups->find('list'));
         $this->set(compact('Groups'));




    }


    public $helpers = array('Html','Form');
    public $components = array('Session','Acl','Cookie');
    public $name = 'Users';




     var $paginate = array(
            'limit' => 25,
            'order' => array(
                'User.username' => 'asc'
            )
        );

    

         public function login() {
        if ($this->request->is('post')) {
        	$this->Cookie->write('user',$this->request->data['User']['username']);
            if ($this->Auth->login()) {
            	
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
            }
        }


        public function logout() {
            $this->redirect($this->Auth->logout());
        }    



// admin 
   

    public function admin_login() {

    if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }


      public function admin_index() {   
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $this->set('users', $this->User->find('all'));


    }




    public function admin_add() {



     
    if ($this->request->is('post')) {


            $iuid = $this->Session->read('Auth.User.username'); //id user login   
            $this->request->data['User']['idreg'] = $iuid;    


            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El usuario no ha sido salvada. Favor, Intente nuevamente.'));
            }
        }

       
    }



    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('User', $this->User->read(null, $id));
    }



    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        } 
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }









}

?>