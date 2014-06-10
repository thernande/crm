<?php

class CustomersController extends AppController {
   
    

    public $helpers = array('Html','Form', 'Js', 'PhpExcel');
    public $components = array('Session', 'Paginator', 'RequestHandler','Cookie');
    public $name = 'Customers';


    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
        $this->Auth->allow('showGrid');




    


    $this->loadModel('Department');
    $this->set('Departments', $this->Department->find('list',array(
               'order' => array('name' => 'asc'))
    ));
    $this->set(compact('Departments'));
	

    }


       public function index() {
		
        //municipalty id = 2 corresponde al id del departamento de antioquia

        $this->set('total_customer', $total_customer = $this->Customer->find('count', array('conditions' => array('Customer.state !=' => 'Inactivo'))));
        $this->set('total_cust_ant', $total_cust_ant = $this->Customer->find('count', array('conditions' => array('Customer.state !=' => 'Inactivo','Customer.department_id =' => '2' ))));


    }



    public function view($id = null) {
    	$this->loadModel('Functionary');
    	$this->loadModel('User');

        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Cliente Invalido'));
        }
        $this->set('Customer', $this->Customer->read(null, $id));
			$user=$this->get_users();

            $this->set('Funcionality', $this->Functionary->find('all', array('conditions'=>array('customer_id'=>$id))));
            $this->set('Users', $user);
            $this->set('customer_id',$id);



    }



    public function add() {
    if (!empty($this->request->data)) {
		$this->loadModel('Functionary');
         $this->request->data['Customer']['state'] =   'Activo' ;
         
         $Customer = $this->Customer->save($this->request->data);
         $customer = $this->Customer->find('first',array('fields'=>array('id'), 'order'=>array('id'=>'desc')));
         for($i=0;$i<count($this->request->data['Functionary']);$i++){
		$this->request->data['Functionary'][$i]['customer_id']= $customer['Customer']['id'];
		 }
         $Functionary=$this->Functionary->saveAll($this->request->data['Functionary']);
                    if (!empty($Customer)) {
					//crear directorio del cliente
					$serv = WWW_ROOT.'/files/';

					$ruta = $serv . $this->request->data['Customer']['name'];
					if(!is_dir($ruta)){
						mkdir($ruta);
						$this->Session->setFlash('Se ha creado el directorio: '.$ruta);
					}
					//termina la creacion del archivo

                    $this->Session->setFlash(__('El Cliente ha sido salvado'));
                    $this->redirect(array('action' => 'view', $customer['Customer']['id']));
                    
                    }
                    else
                   {
                    $this->Session->setFlash(__('El Cliente no pudo ser salvado.  Favor, intente nuevamente.'));
                   }     
            }
        }


    public function edit($id=null) {
    	$this->loadModel('Logcustomer');
        $this->Customer->id = $id;
        $fecha=date("Y-m-d");
		$this->request->data['modified']= $fecha;
		$user=$this->Cookie->read('user');
		$this->request->data['log']= $user;
		$datos=$this->request->data;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Cliente Invalido'));
        }
        $log=$this->Customer->find("first",array('conditions'=>array('Customer.id'=>$id), 'fields'=>array('Logcustomer.customer_id'=>'Customer.id','Logcustomer.nit'=>'Customer.nit','Logcustomer.name'=>'Customer.name','Logcustomer.state'=>'Customer.state','Logcustomer.dress'=>'Customer.dress')));
       
		
            if ($this->Customer->save($this->request->data)) {
            	$this->Logcustomer->save($log);
                $this->Session->setFlash(__('El Cliente ha sido salvado'));
               
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El Cliente no pudo ser salvado.  Favor, intente nuevamente.'));
               
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

function showGrid()
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
            $row=$this->Customer->find('count');
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
            $this->Customer->recursive=-1;
	if(!empty($this->request->data['filters'])){
		$rule=$this->request->data['filters']['rule'];
		$resultado=$this->Customer->find('all',array('fields' => array('id','nit','name','dress','state','created', 'modified','log'),'ORDER =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array($rule['field'].' LIKE = ' => $rule['data'].'%')));
	}
else{
	$resultado=$this->Customer->find('all',array('fields' => array('id','nit','name', 'dress', 'state','created', 'modified','log'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit));
}


            
          // $resultado=$this->Customer->find('all',array('fields' => array('id','name','phone','dress','state','created'),'order' => $sort_range,'limit' => $limit_range)); 

            //setting the response object
			
            
            $responce->page=$page;
            $responce->total_pages=$total_pages;
            $responce->records=$count;

			$i=0;
			            
            foreach($resultado as $row)
            {
            	
                $responce->rows[$i]['id']=$row['Customer']['id'];
                $responce->rows[$i]['cell']=array($row['Customer']['id'],$row['Customer']['nit'],$row['Customer']['name'],$row['Customer']['dress'],$row['Customer']['state'],$row['Customer']['created'], $row['Customer']['modified'], $row['Customer']['log']);
                
                $i++;
            }
           echo json_encode($responce);

            exit();

        }


		public function export(){

		$limit = $this->request->query['num'];

    	$sidx = $this->request->query['id'];
    	$sord = $this->request->query['or'];
    	$page = $this->request->query['pag'];
    	
    	$start = $limit * $page - $limit;
    	$resultado=$this->Customer->find('all',array('fields' => array('id','nit','name', 'dress', 'state','created', 'modified'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit));
    	$this->set('customer', $resultado);
 
    }




		
		public function get_cities_by_Department($id = null) {
    
   		 	$cities = $this->City->find('all', array('conditions' => array('cities.department_id =' => $id), 'recursive' => 3));
    		$returnCities = array();
    		foreach ($cities as $city) {
    		 	$returnCities[$city['City']['id']] = "{$city['City']['name']}";
    		}	
    
    		return $returnCities;

  		}

public function get_users() {
    		$this->loadModel('User');
    	
    	
   		 	$users =$this->User->find('all',array('conditions' => array('User.state' => 'Activo', 'Area.name' => 'Comercial')));
    		$returnUsers = array();
    		foreach ($users as $user) {
    		 	$returnUsers[$user['User']['id']] = "{$user['User']['name']}";
    		}	
    
    		return $returnUsers;

  		}
 



}/* end function controller */
















?>