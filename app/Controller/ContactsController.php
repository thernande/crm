<?php
// app/Controller/ContactsController.php



class ContactsController extends AppController {


    public $helpers = array('Html','Form');
    public $components = array('Session');
    public $name = 'Contacts';



     var $paginate = array(
            'limit' => 25,
            'order' => array(
                'Contact.Contactname' => 'asc'
            )
        );

    
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }


       public function index() {
        $this->Contact->recursive = 0;
        $this->set('Contacts', $this->paginate());
        $this->set('Contacts', $this->Contact->find('all'));

    }


        public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid Contactname or password, try again'));
            }
        }
        }


        public function logout() {
            $this->redirect($this->Auth->logout());
        }    



    public function view($id = null) {
        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException(__('Invalid Contact'));
        }
        $this->set('Contact', $this->Contact->read(null, $id));
    }

    public function add() {
    

        if ($this->request->is('post')) {

            $id_customer = $this->request->data['Contact']['customer_id'];
            $this->request->data['Contact']['state'] =   'Activo' ;
            
            $this->Contact->create();
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash(__('El contacto ha sido creado con exito !'));
      
                $this->redirect(array('controller'=>'customers','action'=>'view',$customer_id));

            } else {
                $this->Session->setFlash(__('No es posible registrar el contacto. favor, intente nuevamente.'));
                $this->redirect(array('controller'=>'customers','action'=>'view',$customer_id));
            }
        }
    }



    public function edit($id = null) {
        $this->Contact->id = $id;
        if ($this->request->is('post')) {
        $this->request->data = $this->Contact->read();
        } else {
        if ($this->Contact->save($this->request->data)) {
        $this->Session->setFlash('El contacto ha sido actualizado.');
         $this->redirect(array('action' => 'index'));
        

      
        }
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Contact->id = $id;

        $this->request->data['Contact']['state'] = 'Inactivo';  
        

        if (!$this->Contact->exists()) {
            throw new NotFoundException(__('Invalid Contact'));
        }

        if ($this->Contact->save($this->request->data)) {
            $this->Session->setFlash(__('El contacto ha sido eliminado !'.print_r($id_customer[0])));

            $this->redirect(array('controller' => 'Customers', 'action'=>'index'));            
            //$this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash(__('No es posible registrar el contacto. favor, intente nuevamente.'));
        $this->redirect(array('controller' => 'Customers', 'action'=>'index'));
        



    }


     
 public function get_contacts_by_customer($id = null) {
    $this->loadModel('Contact');
    
    $contacts = $this->Contact->find('all', array('conditions' => array('contact.customer_id =' => $id), 'recursive' => 3));
    $returnContacts = array();
    foreach ($contacts as $contact) {
      $returnContacts[$contact['Contact']['id']] = "{$contact['Contact']['name']}";
    }
    
    return $returnContacts;


  }
  
  
  
  public function html_contacts_by_customer($id = null) {
    

    $this->layout = false;
    $this->autoRender = false;

     
            

    $contacts = $this->get_contacts_by_customer($id);


    $strReturn = '<option> -- </option>';
    foreach ($contacts as $idContact=> $value) {
      
      $strReturn = $strReturn . "<option value='{$idContact}'>{$value}</option>";
    }
    
    echo $strReturn;
  }

  
  

}



 


?>