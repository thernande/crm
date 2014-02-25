<?php

class CustomersController extends AppController {
   
    

    public $helpers = array('Html','Form');
    public $components = array('Session', 'Paginator');
    public $name = 'Customers';
   



    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');



    $this->loadModel('User');
    $this->set('Users', $this->User->find('list',array(
        'conditions' => array('state' => 'Activo'),
        'order' => array('name' => 'asc'))
    ));
    $this->set(compact('Users'));


    $this->loadModel('Municipality');
    $this->set('Municipalities', $this->Municipality->find('list',array(
               'order' => array('name' => 'asc'))
    ));
    $this->set(compact('Municipalities'));


    }


       public function index() {
        $this->Customer->recursive = 0;
        $this->set('Customers', $this->paginate());
        $this->set('Customers', $this->Customer->find('all'));

        //municipalty id = 2 corresponde al id del departamento de antioquia

        $this->set('total_customer', $total_customer = $this->Customer->find('count', array('conditions' => array('Customer.state !=' => 'Inactivo'))));
        $this->set('total_cust_ant', $total_cust_ant = $this->Customer->find('count', array('conditions' => array('Customer.state !=' => 'Inactivo','Customer.municipality_id =' => '2' ))));


    }



    public function view($id = null) {
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Cliente Invalido'));
        }
        $this->set('Customer', $this->Customer->read(null, $id));


            //load datagrid contacts
            $this->loadModel('Contact');
            $this->Contact->recursive = 0;
            $this->set('Contacts', $this->paginate());
            $this->set('Contacts', $this->Contact->find('all',array(
                'conditions' => array('customer_id = ' => $id),
                'order' => array('Contact.name' => 'asc'))
            ));
            $this->set(compact('contacts'));
            
            $this->set('customer_id',$id);



    }



    public function add() {
    if (!empty($this->request->data)) {

         $this->request->data['Customer']['state'] =   'Activo' ;
         $Customer = $this->Customer->save($this->request->data);

       
                    if (!empty($Customer)) {
                    $this->request->data['Contact']['customer_id'] = $this->Customer->id;


                    $phone = $this->request->data['Customer']['phone'];
                    $this->request->data['Contact']['phone'] = $phone;  
                    
                    $email = $this->request->data['Customer']['email'];
                    $this->request->data['Contact']['email'] = $email; 

                    $this->request->data['Contact']['state'] =   'Activo' ;


                    $this->Customer->Contact->save($this->request->data);
                    $this->Session->setFlash(__('El Cliente ha sido salvado'));
                    $this->redirect(array('action' => 'index'));  

                    }
                    else
                   {
                    $this->Session->setFlash(__('El Cliente no pudo ser salvado.  Favor, intente nuevamente.'));
                   }     
            }
        }


    public function edit($id = null) {
        $this->Customer->id = $id;

         //load datagrid contacts
            $this->loadModel('Contact');
            $this->Contact->recursive = 0;
            $this->set('Contacts', $this->paginate());
            $this->set('Contacts', $this->Contact->find('all',array(
                'conditions' => array('customer_id = ' => $id),
                'order' => array('Contact.name' => 'asc'))
            ));
            $this->set(compact('contacts'));
            
            $this->set('customer_id',$id);
            
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Cliente Invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('El Cliente ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El Cliente no pudo ser salvado.  Favor, intente nuevamente.'));
            }
        } else {
            $this->request->data = $this->Customer->read(null, $id);
            unset($this->request->data['Customer']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Cliente Invalido'));
        }
        if ($this->Customer->delete()) {
            $this->Session->setFlash(__('El Cliente ha sido eliminado de la base de datos'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('El cliente no fue eliminado'));
        $this->redirect(array('action' => 'index'));
    }  



        public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid Customername or password, try again'));
            }
        }
    }




    public function logout() {
        $this->redirect($this->Auth->logout());
    }    


 


    public function isAuthorized($user) {
    // All registered users can add customers
    if ($this->action === 'add') {
        return true;
    }

    // The owner of Customer  can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $CustomerId = $this->request->params['pass'][0];
        if ($this->Customer->isOwnedBy($CustomerId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
    }







 



}/* end function controller */
















?>