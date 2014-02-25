<?php

class ProcessesController extends AppController {


    public $helpers = array('Html','Form');
    public $components = array('Session');
    public $name = 'Processes';



       public function index() {
        
        $this->set('processes', $this->Process->find('all'));

         }

        public function logout() {
            $this->redirect($this->Auth->logout());
        }    




    public function view($id = null) {
        $this->Process->id = $id;
        if (!$this->Process->exists()) {
            throw new NotFoundException(__('Invalid Process'));
        }
        $this->set('Process', $this->Process->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Process->create();
            if ($this->Process->save($this->request->data)) {
                $this->Session->setFlash(__('The Process has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Process could not be saved. Please, try again.'));
            }
        }
    }



     
   public function edit($id = null) {
        $this->Process->id = $id;
        if ($this->request->is('get')) {
        $this->request->data = $this->Process->read();
        } else {
        if ($this->Process->save($this->request->data)) {
        $this->Session->setFlash('Your process has been updated.');
        $this->redirect(array('action' => 'index'));
        }
        }
    }


/// administrator 



    public function admin_index() {

    $this->set('processes', $this->Process->find('all'));   


    }


    public function admin_add() {


     if ($this->request->is('post')) {
            $this->Process->create();
            if ($this->Process->save($this->request->data)) {
                $this->Session->setFlash(__('The Process has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Process could not be saved. Please, try again.'));
            }
        }
       }



    public function admin_edit($id) {

        $this->Process->id = $id;
        if ($this->request->is('get')) {
        $this->request->data = $this->Process->read();
        } else {
        if ($this->Process->save($this->request->data)) {
        $this->Session->setFlash('El Proceso ha sido actualizado.');
        $this->redirect(array('action' => 'index'));
        }
        }

       
    }




    public function admin_view($id = null) {
       

    $this->Process->id = $id;
    $this->set('process', $this->Process->read());
   
    }



    function admin_delete($id) {

    if (!$this->request->is('post')) {
        throw new MethodNotAllowedException();
    }
    if ($this->Process->delete($id)) {
        $this->Session->setFlash('El proceso ha sido eliminado.');
        $this->redirect(array('action' => 'admin_index'));
    }
}
 





 



}
















?>