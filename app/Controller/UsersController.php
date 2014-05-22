<?php
// app/Controller/UsersController.php


class UsersController extends AppController {

    



        public function beforeFilter() {
        parent::beforeFilter();

        // For CakePHP 2.1 and up
        //$this->Auth->allow();
        $this->Auth->autoRedirect = false ; 
    	$this->Auth->allow('forgetpass','reset');
    	
         $this->loadModel('Areas');
         $this->set('Areas', $this->Areas->find('list'));
         $this->set(compact('Areas'));

         $this->loadModel('Groups');
         $this->set('Groups', $this->Groups->find('list'));
         $this->set(compact('Groups'));




    }


    public $helpers = array('Html','Form');
    public $components = array('Session','Acl','Cookie', 'Email');
    public $name = 'Users';
    




     var $paginate = array(
            'limit' => 25,
            'order' => array(
                'User.username' => 'asc'
            )
        );

    

         public function login() {
        if ($this->request->is('post')) {
        	$this->Cookie->write('user',$this->request->data['User']['username']);
            if ($this->Auth->login()) {
            	
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
            }
        }


        public function logout() {
            $this->redirect($this->Auth->logout());
        }    
		
		
		public function forgetpass(){
        //$this->layout="signup";
        $this->User->recursive=-1;
        if(!empty($this->data))
        {
            if(empty($this->data['User']['email']))
            {
                $this->Session->setFlash('por favor ingresa tu email de la empresa');
            }
            else
            {
                $email=$this->data['User']['email'];
                $fu=$this->User->find('first',array('conditions'=>array('User.email'=>$email)));
                if($fu)
                {
                    //debug($fu);
                    if($fu['User']['state']=='Activo')
                    {
                        $key = Security::hash(String::uuid(),'sha512',true);
                        $hash=sha1($fu['User']['username'].rand(0,100));
                        $url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$key.'#'.$hash;
                        $ms=$url;
                        $ms=wordwrap($ms,1000);
                        //debug($url);
                        $fu['User']['tokenhash']=$key;
                        $this->User->id=$fu['User']['id'];
                        if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){
 
                            //============Email================//
                            /* SMTP Options */
                            $this->Email->smtpOptions = array(
                                'port'=>'25',
                                'timeout'=>'30',
                                'host' => 'hades.esu.com.co',
                                  );
                              $this->Email->template = 'resetpass';
                            $this->Email->from    = 'tulio <thernandez@esu.com.co>';
                            $this->Email->to      = $fu['User']['name'].'<'.$fu['User']['email'].'>';
                            $this->Email->subject = 'recuperar clave del crm';
                            $this->Email->sendAs = 'both';
 
                                $this->Email->delivery = 'smtp';
                                $this->set('ms', $ms);
                                $this->Email->send();
                                $this->set('smtp_errors', $this->Email->smtpError);
                            $this->Session->setFlash(__('revisa tu correo para recuperar tu clave', true));
 
                            //============EndEmail=============//
                        }
                        else{
                            $this->Session->setFlash("Error Generating Reset link");
                        }
                    }
                    else
                    {
                        $this->Session->setFlash('This Account is not Active yet.Check Your mail to activate it');
                    }
                }
                else
                {
                    $this->Session->setFlash('Email does Not Exist');
                }
            }
        }
    }


		 public function reset($token=null){
        //$this->layout="Login";
        $this->User->recursive=-1;
        if(!empty($token)){
            $u=$this->User->findBytokenhash($token);
            if($u){
                $this->User->id=$u['User']['id'];
                if(!empty($this->data)){
                    $this->User->data=$this->data;
                    $this->User->data['User']['username']=$u['User']['username'];
                    $new_hash=sha1($u['User']['username'].rand(0,100));//created token
                    $this->User->data['User']['tokenhash']=$new_hash;
                    if($this->User->validates(array('fieldList'=>array('password','password_confirm')))){
                        if($this->User->save($this->User->data))
                        {
                            $this->Session->setFlash('Tu clave a sido cambiada');
                            $this->redirect(array('controller'=>'users','action'=>'login'));
                        }
 
                    }
                    else{
 
                        $this->set('errors',$this->User->invalidFields());
                    }
                }
            }
            else
            {
                $this->Session->setFlash('Token Corrupted,,Please Retry.the reset link work only for once.');
            }
        }
 
        else{
            $this->redirect('/');
        }
    }


// admin 
   

    public function admin_login() {

    if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }


      public function admin_index() {   
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $this->set('users', $this->User->find('all'));


    }




    public function admin_add() {



     
    if ($this->request->is('post')) {


            $iuid = $this->Session->read('Auth.User.username'); //id user login   
            $this->request->data['User']['idreg'] = $iuid;    


            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido salvado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El usuario no ha sido salvada. Favor, Intente nuevamente.'));
            }
        }

       
    }



    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('User', $this->User->read(null, $id));
    }



    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        } 
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function admin_delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }









}

?>