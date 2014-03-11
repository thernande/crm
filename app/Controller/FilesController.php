<?php
/**
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

class FilesController extends AppController {
public $helpers = array('Html','Form');
    public $components = array('Session');
    public $name='Files';
	
	public function add(){
		if($this->request->is('post')){
			if(!empty($this->request->data)){
				$proffer_id=$this->request->data['File']['proffer_id'];
				$ruta=WWW_ROOT.'files'.DS.$this->request->data['File']['customer'].DS.$this->request->data['File']['file']['name'];
				$this->request->data('File.url','/app/webroot/files/'.$this->request->data['File']['customer'].'/'.$this->request->data['File']['file']['name']);
				$this->File->create();
				$data_base=array('customer_id' => $this->request->data['File']['customer_id'],'proffer_id' => $this->request->data['File']['proffer_id'], 'name' => $this->request->data['File']['name'], 'url' => $this->request->data['File']['url']);
				
				if($this->File->save($data_base)){
					
				
						$this->Session->setFlash(__('se ha guardado el archivo'));
						if(move_uploaded_file($this->request->data['File']['file']['tmp_name'],$ruta)){
						
				
					}
					$this->redirect(array('action' =>'view', $proffer_id));
					}
					else{
						$this->Session->setFlash(__('no se guardo el documento'));
						$this->redirect(array('action' =>'view', $proffer_id));
					}
				
				
			}
		}
	}
	
	
	
	function delete($id=null){
		
		if(!$this->request->is('post')){
			throw new MethodNotAllowedException();
		}
		$this->File->id = $id;
		$proffer_id=$this->File->proffer_id;
		if(!$this->File->exist()){
			throw new NotFoundException(__('archivo invalido'));
		}
		$file=$this->File->url;
		if($this->File->delete()){
			unlink($file);
			$this->Session->setFlash(__('se ha eliminado el archivo'));
			$this->redirect(array('action'=>'view',$proffer_id));
		}
		$this->Session->setFlash(__('no se ha eliminado el archivo'));
		$this->redirect(array('action'=>'view',$proffer_id));
	}
	
	
	
	function index() {
		$this->set('Files', $this->paginate());
        $this->set('Files', $this->File->find('all'));
	}

	function view($id=null) {
		$this->loadModel('Proffer');
		$this->set('Proffer', $this->Proffer->read(null,$id));
		$this->set('Files', $this->File->find('all', array(
		'conditions' => array(
		'proffer_id =' => $id ))));
	}
	

}
?>