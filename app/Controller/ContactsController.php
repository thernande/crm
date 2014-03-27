<?php
// app/Controller/ContactsController.php



class ContactsController extends AppController {


    public $helpers = array('Html','Form','Js');
    public $components = array('Session','RequestHandler');
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

            $customer_id = $this->request->data['Contact']['customer_id'];

            $Contact=$this->request->data;
           
            $this->Contact->create();
            
            if ($this->Contact->save($Contact)) {
                $this->Session->setFlash(__('El contacto ha sido creado con exito !'));
      			
                $this->redirect(array('controller'=>'customers','action'=>'view',$customer_id));

            } else {
                $this->Session->setFlash(__('No es posible registrar el contacto. favor, intente nuevamente.'));
                $this->redirect(array('controller'=>'customers','action'=>'view',$customer_id));
            }
        }
    }



    public function edit() {
        $this->Contact->id = $this->request->data['id'];
        	
       		 if ($this->Contact->save($this->request->data)) {
        		$this->Session->setFlash('El contacto ha sido actualizado.');
        		exit();
         		$this->redirect(array('controller'=>'customers','action' => 'index'));
        	}
       else {

        	$this->Session->setFlash('El contacto no se ha actualizado.');
         	$this->redirect(array('controller'=>'customers','action' => 'index'));
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

  
  
function showGridContact($id=null)
        {

    // get how many rows we want to have into the grid - rowNum parameter in the grid
   
    $limit = $this->request->query['rows'];

    // get index row - i.e. user click to sort. At first time sortname parameter -
    // after that the index from colModel
    $sidx = $this->request->query['sidx'];

    // sorting order - at first time sortorder
    $sord = $this->request->query['sord'];

    $page = $this->request->query['page'];


    // if we not pass at first time index use the first column for the index or what you want
    if( !$sidx ) $sidx = 1;
            //calculate no of rows from query
            $row=$this->Contact->find('count', array('conditions' => array('customer_id' => $id)));
            $count = $row;

    // calculate the total pages for the query
    if( $count > 0 )
    {
        $total_pages = ceil($count / $limit);
    }
    else
    {
        $total_pages = 0;
    }

    // if for some reasons the requested page is greater than the total
    // set the requested page to total page
    if( $page > $total_pages ) $page = $total_pages;

    // calculate the starting position of the rows
    $start = $limit * $page - $limit;

    // if for some reasons start position is negative set it to 0
    // typical case is that the user type 0 for the requested page
    if( $start < 0 ) $start = 0;
	
    //fetch only pure data avoiding unnecessay loading of related/associated data
            $this->Contact->recursive=-1;
	if(!empty($this->request->query['filters'])){
		$rule=$this->request->query['filters']['rule'];
		$resultado=$this->Contact->find('all',array('fields' => array('id','name','phone','email','state','created'),'ORDER =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array($rule['field'].' LIKE = ' => $rule['data'].'%', 'customer_id' => $id)));
	}
else{
	$resultado=$this->Contact->find('all',array('fields' => array('id','name','phone','email','state','created'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array('customer_id' => $id)));
}


            
          // $resultado=$this->Customer->find('all',array('fields' => array('id','name','phone','dress','state','created'),'order' => $sort_range,'limit' => $limit_range)); 

            //setting the response object

            $responce=new stdClass();
            $responce->page=$page;
            $responce->total_pages=$total_pages;
            $responce->records=$count;

			$i=0;
			            
            foreach($resultado as $row)
            {
            	
                $responce->rows[$i]['id']=$row['Contact']['id'];
                $responce->rows[$i]['cell']=array($row['Contact']['id'],$row['Contact']['name'],$row['Contact']['phone'],$row['Contact']['email'],$row['Contact']['state'],$row['Contact']['created']);
                
                $i++;
            }

           echo json_encode($responce);

            exit();

        }
  

}



 


?>