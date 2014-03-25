<?php

class CustomersController extends AppController {
   
    

    public $helpers = array('Html','Form', 'Js');
    public $components = array('Session', 'Paginator', 'RequestHandler');
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
					//crear directorio del cliente
					$serv = WWW_ROOT.'/files/';

					$ruta = $serv . $this->request->data['Customer']['name'];
					if(!is_dir($ruta)){
						mkdir($ruta);
						$this->Session->setFlash('Se ha creado el directorio: '.$ruta);
					}
					//termina la creacion del archivo

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
		$resultado=$this->Customer->find('all',array('fields' => array('id','name','phone','dress','state','created'),'ORDER =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array($rule['field'].' LIKE = ' => $rule['data'].'%')));
	}
else{
	$resultado=$this->Customer->find('all',array('fields' => array('id','name','phone','dress','state','created'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit));
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
            	
                $responce->rows[$i]['id']=$row['Customer']['id'];
                $responce->rows[$i]['cell']=array($row['Customer']['id'],$row['Customer']['name'],$row['Customer']['phone'],$row['Customer']['dress'],$row['Customer']['state'],$row['Customer']['created']);
                
                $i++;
            }

           echo json_encode($responce);

            exit();

        }





 



}/* end function controller */
















?>