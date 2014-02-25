<?php
// app/Controller/AreasController.php



class AreasController extends AppController {

   // public $components = array('RequestHandler', 'Paginator','Acl');
   // public $helpers = array('Js' => array('Jquery'), 'Paginator'); // See more at: http://www.devdungeon.com/content/ajax-pagination-and-sorting-cakephp-2x#sthash.5zi3a8Xu.dpuf

    public $helpers = array('Html','Form');
    public $components = array('Session', 'Paginator');
    public $name = 'Areas';

    



    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }


       public function index() {
        $this->Area->recursive = 0;
        $this->set('Areas', $this->paginate());
        $this->set('Areas', $this->Area->find('all'));

    }



        public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid Areaname or password, try again'));
            }
        }
    }




public function logout() {
    $this->redirect($this->Auth->logout());
}    




    public function view($id = null) {
        $this->Area->id = $id;
        if (!$this->Area->exists()) {
            throw new NotFoundException(__('Invalid Area'));
        }
        $this->set('Area', $this->Area->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Area->create();
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash(__('The Area has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Area could not be saved. Please, try again.'));
            }
        }
    }




    public function edit($id = null) {
        $this->Area->id = $id;
        if (!$this->Area->exists()) {
            throw new NotFoundException(__('Invalid Area'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash(__('The Area has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Area could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Area->read(null, $id);
            unset($this->request->data['Area']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Area->id = $id;
        if (!$this->Area->exists()) {
            throw new NotFoundException(__('Invalid Area'));
        }
        if ($this->Area->delete()) {
            $this->Session->setFlash(__('Area deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Area was not deleted'));
        $this->redirect(array('action' => 'index'));
    }   


/// administrator 



    public function admin_index() {

     $this->set('Areas', $this->Area->find('all'));  


       $this->paginate = array(
      'limit' => 2,
      'order' => array(
                'Area.Areaname' => 'asc'
            ),  
       'recursive' => 0
    );
   
    }




    public function admin_view($id = null) {
       

    $this->Area->id = $id;
    $this->set('Area', $this->Area->read());
    

    

   
    }





    public function admin_add() {



     
    if ($this->request->is('post')) {


             // $iuid = $this->Session->read('Auth.User.username'); //id user login   
             //$this->request->data['Area']['id_username'] = $iuid;    
            
            $this->request->data['Area']['user_id'] = $this->Auth->user('id');
            $this->Area->create();
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash(__('El area ha sido salvada'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El area  no ha sido salvada. Favor, Intente nuevamente.'));
            }
        }

       
    $this->loadModel('Process');
    $this->set('Processes', $this->Process->find('list'));
    $this->set(compact('Processes'));


    $this->loadModel('Areastype');
    $this->set('Areastypes', $this->Areastype->find('list'));
    $this->set(compact('Areastypes'));



    }



    public function admin_edit($id) {

       $this->Area->id = $id;
        if ($this->request->is('get')) {
        $this->request->data = $this->Area->read();
        } else {
        if ($this->Area->save($this->request->data)) {

        $iuid = $this->Session->read('Auth.User.username'); //id user login   
        $this->request->data['Area']['id_username'] = $iuid;          
        $this->Session->setFlash('El area ha sido actualizada.');
        $this->redirect(array('action' => 'index'));
        }
        }   

            $this->loadModel('Process');

            $this->set('Processes', $this->Process->find('list'));
            $this->set(compact('Processes'));


            $this->loadModel('Areastype');
            $this->set('Areastypes', $this->Areastype->find('list'));
            $this->set(compact('Areastypes'));


       
    }



    function admin_delete($id) {


    
    if (!$this->request->is('post')) {
        throw new MethodNotAllowedException();
    }
    if ($this->Area->delete($id)) {
        $this->Session->setFlash('El Area ha sido eliminado.');
        $this->redirect(array('action' => 'admin_index'));
    }
    }
 




/////// control users 



    public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of area  can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $areaId = $this->request->params['pass'][0];
        if ($this->Area->isOwnedBy($areaId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}







 



}/* end function controller */
















?>