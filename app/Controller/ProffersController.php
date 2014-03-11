<?php

App::uses('AppController', 'Controller');   
class ProffersController extends AppController {
   
    

    public $helpers = array('Html','Form');
    //public $components = array('Session');
    public $name = 'Proffers';
   



    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
        
		$this->loadModel('Municipality');
    $this->set('Municipalities', $this->Municipality->find('list',array(
               'order' => array('name' => 'asc'))
    ));
    $this->set(compact('Municipalities'));
     

     
    
    

    }


        public function index() {
        
        //$this->Customer->recursive = 0;
        $this->set('Proffers', $this->paginate());
        $this->set('Proffers', $this->Proffer->find('all'));
      
        $this->set('total_Proffer', $total_Proffer = $this->Proffer->find('count', array('conditions' => array('Proffer.state !=' => 'Eliminada'))));
        $this->set('total_Opp_seg', $total_Opp_seg= $this->Proffer->find('count', array('conditions' => array('Proffer.state =' => 'En_seguimiento'))));
        $this->set('total_Opp_ven', $total_Opp_ven= $this->Proffer->find('count', array('conditions' => array('Proffer.state =' => 'Vencida'))));
        $this->set('total_Opp_cerrok', $total_Opp_cerrok = $this->Proffer->find('count', array('conditions' => array('Proffer.state =' => 'Cerrada_efectiva'))));
        $this->set('total_Opp_cerr', $total_Opp_cerr= $this->Proffer->find('count', array('conditions' => array('Proffer.state =' => 'Cerrada_no_efectiva'))));


    }



    public function view($id = null) {
        $this->Proffer->id = $id;
        if (!$this->Proffer->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        $this->set('Proffer', $this->Proffer->read(null, $id));
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

           
    $customers = $this->get_customers();
    //$customer_id = 38;
    $customer_id = $this->getRequestValue('customer_id');
    $this->set('customers', $customers);
    $this->set('customer_id', $customer_id);
    

    if( $this->request->is('ajax') ) {
      $datos = $this->request->data; 
      $this->set('datos', $datos);
      
    }else
    {

     $datos = "no hay datos" ; 
     $this->set('datos', $datos);
        

    }    


    




    
    $contacts = array();

    if($customer_id != '') {

      $this->loadModel('contacts');
      $contacts = $this->get_contacts_by_customer($customer_id);
    }
    
    $contact_id = $this->getRequestValue('contact_id');
    $this->set('contacts', $contacts);
    $this->set('contact_id', $contact_id);     
        
       



       if (!empty($this->request->data)) {



         $this->request->data['Proffer']['state'] =   'Vigente' ;
         $Proffer = $this->Proffer->save($this->request->data);

                 if (!empty($Proffer)) {

                    
                    
                    $this->Proffer->Contact->save($this->request->data);
                    $this->Session->setFlash(__('El Registro ha sido salvado'));
                    $this->redirect(array('action' => 'index'));  

                    }
                    else
                   {
                    $this->Session->setFlash(__('El Registro no pudo ser salvado.  Favor, intente nuevamente.'));
                   }     
            }
    
    }    /*end add */



//change state of the proffer
	public function state($id=null){
		$this->Proffer->id=$id;
		if(!$this->Proffer->exists()){
			throw new NotFoundException(__('registro invalido'));
		}
		if(empty($this->request->data)){
			$this->request->data['Proffer']['state'] =   'aprobado' ;
        	if($this->Proffer->save($this->request->data)){

                    $this->Session->setFlash(__('El Registro ha sido salvado'));
                    $this->redirect(array('action'=>'index'));
                    }
                    else
                   {
                    $this->Session->setFlash(__('El Registro no pudo ser salvado.  Favor, intente nuevamente.'));
                   } 
		
	}
}
//end of the change




    public function edit($id = null) {
        $this->Proffer->id = $id;

         $this->set('Proffer', $this->Proffer->read(null, $id));
          //$this->set('Proffer_id',$id);
          
          
           $customers = $this->get_customers();
    //$customer_id = 38;
    $customer_id = $this->getRequestValue('customer_id');
    $this->set('customers', $customers);
    $this->set('customer_id', $customer_id);
    

    if( $this->request->is('ajax') ) {
      $datos = $this->request->data; 
      $this->set('datos', $datos);
      
    }else
    {

     $datos = "no hay datos" ; 
     $this->set('datos', $datos);
        

    }    


    
	
	



    
    $contacts = array();
    if($customer_id != '') {

      $this->loadModel('contacts');
      $contacts = $this->get_contacts_by_customer($customer_id);
      
    }
    $contact_id = $this->getRequestValue('contact_id');
    $this->set('contacts',$contacts);  
   	$this->set('contact_id', $contact_id);
        
       



   
            
        if (!$this->Proffer->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
        	if($this->request->data)
            if ($this->Proffer->save($this->request->data)) {
                $this->Session->setFlash(__('El Registro ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El Registro no pudo ser salvado.  Favor, intente nuevamente.'));
            }
        } else {
            $this->request->data = $this->Proffer->read(null, $id);
            unset($this->request->data['Proffer']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Proffer->id = $id;
        if (!$this->Proffer->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        if ($this->Proffer->delete()) {
            $this->Session->setFlash(__('El Registro ha sido eliminado de la base de datos'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('El Registro no fue eliminado'));
        $this->redirect(array('action' => 'index'));
    }  



        public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid Proffername or password, try again'));
            }
        }
    }




    public function logout() {
        $this->redirect($this->Auth->logout());
    }    


 


    public function isAuthorized($user) {
    // All registered users can add Proffers
    if ($this->action === 'add') {
        return true;
    }

    // The owner of Proffer  can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $ProfferId = $this->request->params['pass'][0];
        if ($this->Proffer->isOwnedBy($ProfferId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
    }
    
    public function upload($id = null){
    	$this->Proffer->id = $id;
		$this->set('Proffer', $this->Proffer->read(null,$id));
		$this->redirect(array('controller' => 'Files', 'action' => 'view'));
	}
   




    /*  functions for dinamic select  ****************************************************************************************************/

    private function get_customers() {
    
    $customers = $this->Proffer->Customer->find('all', array('conditions' => array('customer.state' => 'Activo'), 'recursive' => 0));
    $customersReturn = array();
    foreach ($customers as $customer) {
      $customersReturn[$customer['Customer']['id']] = $customer['Customer']['name'];
    }
    
    return $customersReturn;
    
    
 
  }



  public function getRequestValue($index) {
    
    if(isset($this->request->data['Proffer'][$index])) {
      return $this->request->data['Proffer'][$index];
    }
    
    if(isset($this->request->query[$index])) {
      return $this->request->query[$index];
    }
    
    return '';
  }




 public function get_contacts_by_customer($id = null) {
    
    $this->loadModel('Contact');
    
    $contacts = $this->Contact->find('all', array('conditions' => array('contact.customer_id ' => $id), 'recursive' => 3));
    $returnContacts = array();
    foreach ($contacts as $contact) {
      $returnContacts[$contact['Contact']['id']] = "{$contact['Contact']['name']}";
    }
    
    return $returnContacts;

  }
  

  public function action(){
    if( $this->request->is('ajax') ) {
     echo $_POST['value_to_send'];
     

     //or debug($this->request->data);
        echo "ok";
      die();
    }



   }










}/* end function controller */
















?>