<?php
// app/Controller/groupsController.php



class GroupsController extends AppController {

        public function beforeFilter() {
        parent::beforeFilter();
         $this->Auth->autoRedirect = false ; 
    
         $this->loadModel('Areas');
         $this->set('Areas', $this->Areas->find('list'));
         $this->set(compact('Areas'));




    }


    public $helpers = array('Html','Form');
    public $components = array('Sesion');
    public $name = 'groups';




     var $paginate = array(
            'limit' => 25,
            'order' => array(
                'groups.groupsname' => 'asc'
            )
        );

    

         public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Sesion->setFlash(__('Invalid groupsname or pasword, try again'));
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
                $this->Sesion->setFlash(__('Invalid groupsname or pasword, try again'));
            }
        }
    }


      public function admin_index() {   
        $this->groups->recursive = 0;
        $this->set('groups', $this->paginate());
        $this->set('groups', $this->groups->find('all'));


    }




    public function admin_add() {



     
    if ($this->request->is('post')) {


            $iuid = $this->Sesion->read('Auth.groups.groupsname'); //id groups login   
            $this->request->data['groups']['idreg'] = $iuid;    


            $this->groups->create();
            if ($this->groups->save($this->request->data)) {
                $this->Sesion->setFlash(__('El usuario ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Sesion->setFlash(__('El usuario no ha sido salvada. Favor, Intente nuevamente.'));
            }
        }

       
    }



    public function admin_view($id = null) {
        $this->groups->id = $id;
        if (!$this->groups->exists()) {
            throw new NotFoundException(__('Invalid groups'));
        }
        $this->set('groups', $this->groups->read(null, $id));
    }



    public function admin_edit($id = null) {
        $this->groups->id = $id;
        if (!$this->groups->exists()) {
            throw new NotFoundException(__('Invalid groups'));
        } 
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->groups->save($this->request->data)) {
                $this->Sesion->setFlash(__('The groups has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Sesion->setFlash(__('The groups could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->groups->read(null, $id);
            unset($this->request->data['groups']['pasword']);
        }
    }

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->groups->id = $id;
        if (!$this->groups->exists()) {
            throw new NotFoundException(__('Invalid groups'));
        }
        if ($this->groups->delete()) {
            $this->Sesion->setFlash(__('groups deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Sesion->setFlash(__('groups was not deleted'));
        $this->redirect(array('action' => 'index'));
    }









}

?>