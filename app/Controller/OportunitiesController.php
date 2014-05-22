<?php
	class OportunitiesController extends AppController{
		
		 public $helpers = array('Html','Form','Js');
   		 public $components = array('Session','RequestHandler');
   		 public $name = 'Oportunities';
		
		
		
		public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
        
    }


        public function index() {
        

    }



    public function view($id = null) {
    	$this->loadModel('Functionary');
    	$this->loadModel('Line');
    	$this->loadModel('Mode');

        $this->Oportunity->id = $id;
        if (!$this->Oportunity->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        
       
        $this->set('Oportunity', $this->Oportunity->read(null, $id));
            
            $this->Oportunity->recursive=2;
             $customer= $this->Oportunity->read(null,$id);
             $this->set('Funcionality', $this->Functionary->find('all', array('conditions'=>array('customer_id'=>$customer['Customer']['id']))));
             
            $this->set('customer_id',$id);
            $this->set('line', $customer);
            

    }





    public function add() {

    $this->loadModel('Line');
    $this->loadModel('Mode');
    
    $customers = $this->get_customers();
    //$customer_id = 38;
    $customer_id = $this->getRequestValue('customer_id');
    $lines=$this->get_lines();
    $modes=$this->get_modes();
    $this->set('customers', $customers);
    $this->set('customer_id', $customer_id);   
	$this->set('line', $lines);
	$this->set('mode',$modes);
	

       if (!empty($this->request->data)) {


		$this->Line->save($this->request->data['Line']);
		$this->Mode->save($this->request->data['Mode']);
		$lines=$this->Line->find('first', array('fields'=>array('id'), 'order'=>array('id'=>'desc')));
		$modes=$this->Mode->find('first', array('fields'=>array('id'), 'order'=>array('id'=>'desc')));
		$count=count($this->request->data['LineModeOportunity']);	
		$this->request->data['LineModeOportunity'][$count]['line_id']=$lines['Line']['id'];
		$this->request->data['LineModeOportunity'][$count]['mode_id']=$modes['Mode']['id'];
         $this->request->data['Oportunity']['state'] =   'Vigente' ;
         $Oportunity = $this->Oportunity->saveAll($this->request->data);

                 if (!empty($Oportunity)) {

                    $this->Session->setFlash(__('El Registro ha sido salvado'));
                    $this->redirect(array('action' => 'index'));  

                    }
                    else
                   {
                    $this->Session->setFlash(__('El Registro no pudo ser salvado.  Favor, intente nuevamente.'));
                   }     
            }
    
    }    /*end add */



//change state of the Oportunity
	public function state($id=null){
		$this->Oportunity->id=$id;
		if(!$this->Oportunity->exists()){
			throw new NotFoundException(__('registro invalido'));
		}
		if(empty($this->request->data)){
			$this->request->data['Oportunity']['state'] =   'aprobado' ;
        	if($this->Oportunity->save($this->request->data)){

                    $this->Session->setFlash(__('El Registro ha sido salvado'));
                    $this->redirect(array('controller'=>'proffers','action'=>'index'));
                    }
                    else
                   {
                    $this->Session->setFlash(__('El Registro no pudo ser salvado.  Favor, intente nuevamente.'));
                   } 
		
	}
}
//end of the change




    public function edit($id = null) {
        $this->Oportunity->id = $id;

         $this->set('Oportunity', $this->Oportunity->read(null, $id));
          //$this->set('Oportunity_id',$id);
          
          
           $customers = $this->get_customers();
    //$customer_id = 38;
    $customer_id = $this->getRequestValue('customer_id');
    $this->set('customers', $customers);
    $this->set('customer_id', $customer_id);
          
        if (!$this->Oportunity->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
        	if($this->request->data)
            if ($this->Oportunity->save($this->request->data)) {
                $this->Session->setFlash(__('El Registro ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El Registro no pudo ser salvado.  Favor, intente nuevamente.'));
            }
        } else {
            $this->request->data = $this->Oportunity->read(null, $id);
            unset($this->request->data['Oportunity']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Oportunity->id = $id;
        if (!$this->Oportunity->exists()) {
            throw new NotFoundException(__('Registro Invalido'));
        }
        if ($this->Oportunity->deleteAll(array('Oportunity.id'=>$id),true)) {
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
                $this->Session->setFlash(__('Invalid Oportunityname or password, try again'));
            }
        }
    }




    public function logout() {
        $this->redirect($this->Auth->logout());
    }    


 


    public function isAuthorized($user) {
    // All registered users can add Oportunitys
    if ($this->action === 'add') {
        return true;
    }

    // The owner of Oportunity  can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $OportunityId = $this->request->params['pass'][0];
        if ($this->Oportunity->isOwnedBy($OportunityId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
    }
    
    public function upload($id = null){
    	$this->Oportunity->id = $id;
		$this->set('Oportunity', $this->Oportunity->read(null,$id));
		$this->redirect(array('controller' => 'Files', 'action' => 'view'));
	}
   




    /*  functions for dinamic select  ****************************************************************************************************/
private function get_customers() {
    
    $customers = $this->Oportunity->Customer->find('all', array('conditions' => array('customer.state' => 'Activo'), 'recursive' => 0));
    $customersReturn = array();
    foreach ($customers as $customer) {
      $customersReturn[$customer['Customer']['id']] = $customer['Customer']['name'];
    }
    
    return $customersReturn;
    
    
 
  }
  
  private function get_lines() {
    $this->loadModel('Line');
    $lines = $this->Line->find('all', array('recursive' => 0));
    $linesReturn = array();
    foreach ($lines as $line) {
      $linesReturn[$line['Line']['id']] = $line['Line']['line'];
    }
    
    return $linesReturn;
    
    
 
  }
  
  private function get_modes() {
    $this->loadModel('Mode');
    $modes = $this->Mode->find('all', array('recursive' => 0));
    $modesReturn = array();
    foreach ($modes as $mode) {
      $modesReturn[$mode['Mode']['id']] = $mode['Mode']['mode'];
    }
    
    return $modesReturn;
    
    
 
  }



  public function getRequestValue($index) {
    
    if(isset($this->request->data['Oportunity'][$index])) {
      return $this->request->data['Oportunity'][$index];
    }
    
    if(isset($this->request->query[$index])) {
      return $this->request->query[$index];
    }
    
    return '';
  }

  

  public function action(){
    if( $this->request->is('ajax') ) {
     echo $_POST['value_to_send'];
     

     //or debug($this->request->data);
        echo "ok";
      die();
    }



   }



function showGridOpor()
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
            $row=$this->Oportunity->find('count');
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
            $this->Oportunity->recursive=1;
	if(!empty($this->request->query['filters'])){
		$rule=$this->request->query['filters']['rule'];
		$resultado=$this->Oportunity->find('all',array('fields' => array('Oportunity.id','Customer.name', 'Oportunity.description','Oportunity.state','Oportunity.expired'),'ORDER =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array($rule['field'].' LIKE = ' => $rule['data'].'%')));
	}
else{
	$resultado=$this->Oportunity->find('all',array('fields' => array('Oportunity.id','Customer.name', 'Oportunity.description','Oportunity.state','Oportunity.expired'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit));
}


            
          // $resultado=$this->Oportunity->find('all',array('fields' => array('id','name','phone','dress','state','created'),'order' => $sort_range,'limit' => $limit_range)); 

            //setting the response object

            $responce=new stdClass();
            $responce->page=$page;
            $responce->total_pages=$total_pages;
            $responce->records=$count;

			$i=0;
			            
            foreach($resultado as $row)
            {
            	
                $responce->rows[$i]['id']=$row['Oportunity']['id'];
                $responce->rows[$i]['cell']=array($row['Oportunity']['id'],$row['Customer']['name'], $row['Oportunity']['description'],$row['Oportunity']['state'],$row['Oportunity']['expired']);
                
                $i++;
            }

           echo json_encode($responce);

            exit();

        }
	
	}
?>