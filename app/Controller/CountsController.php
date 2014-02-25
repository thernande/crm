<?php
// app/Controller/CountsController.php



class CountsController extends AppController {


    public $helpers = array('Html','Form');
    public $components = array('Session');
    public $name = 'Counts';



     var $paginate = array(
            'limit' => 25,
            'order' => array(
                'Count.Countname' => 'asc'
            )
        );

    

    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }


       public function index() {
        $this->Count->recursive = 0;
        $this->set('Counts', $this->paginate());
        $this->set('Counts', $this->Count->find('all'));

    }



        public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid Countname or password, try again'));
            }
        }
    }




public function logout() {
    $this->redirect($this->Auth->logout());
}    



 

    public function view($id = null) {
        $this->Count->id = $id;
        if (!$this->Count->exists()) {
            throw new NotFoundException(__('Invalid Count'));
        }
        $this->set('Count', $this->Count->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Count->create();
            if ($this->Count->save($this->request->data)) {
                $this->Session->setFlash(__('The Count has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Count could not be saved. Please, try again.'));
            }
        }
    }









    public function edit($id = null) {
        $this->Count->id = $id;
        if (!$this->Count->exists()) {
            throw new NotFoundException(__('Invalid Count'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Count->save($this->request->data)) {
                $this->Session->setFlash(__('The Count has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Count could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Count->read(null, $id);
            unset($this->request->data['Count']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Count->id = $id;
        if (!$this->Count->exists()) {
            throw new NotFoundException(__('Invalid Count'));
        }
        if ($this->Count->delete()) {
            $this->Session->setFlash(__('Count deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Count was not deleted'));
        $this->redirect(array('action' => 'index'));
    }



// admin 
   

    public function admin_login() {

    if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid Countname or password, try again'));
            }
        }
    }














}

?>