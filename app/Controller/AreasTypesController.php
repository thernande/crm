<?php

class AreasTypesController extends AppController {

    public $components = array('RequestHandler', 'Paginator');
    public $helpers = array('Js' => array('Jquery'), 'Paginator'); 
    public $name = 'AreasTypes';

    



    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }


      

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Nombre de usuario  or password errado, intente de nuevo'));
            }
        }
    }




    public function logout() {
        $this->redirect($this->Auth->logout());
    }    






/// administrator module



    public function admin_index() {
    $this->set('AreasTypes', $this->AreasType->find('all'));  
    }




    public function admin_view($id = null) {
    $this->AreasType->id = $id;
    $this->set('AreasType', $this->AreasType->read());
    $this->Session->setFlash('User');
    $this->set('user', $this->Session->read('Auth.User.username'));
    
 
    }





    public function admin_add() {


    if ($this->request->is('post')) {
            $this->AreasType->create();
            if ($this->AreasType->save($this->request->data)) {
                $this->Session->setFlash(__('El tipo de area ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El area  no ha sido salvada. Favor, Intente nuevamente.'));
            }
        }

    
    
    }



    public function admin_edit($id) {

       $this->AreasType->id = $id;
        if ($this->request->is('get')) {
        $this->request->data = $this->AreasType->read();
        } else {
        if ($this->AreasType->save($this->request->data)) {
        $this->Session->setFlash('El tipo de area ha sido actualizado.');
        $this->redirect(array('action' => 'index'));
        }
        }   

           
       
    }



    function admin_delete($id) {


    
    if (!$this->request->is('post')) {
        throw new MethodNotAllowedException();
    }
    if ($this->AreasType->delete($id)) {
        $this->Session->setFlash('El tipo de area ha sido eliminado.');
        $this->redirect(array('action' => 'admin_index'));
    }
    }
 









 



}/* end function controller */
















?>