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
				$address='/app/webroot/files/'.$this->request->data['File']['customer'].'/'.$this->request->data['File']['file']['name'];
				//si existe el archivo se vuelve a subir cambiandole la version
				if(file_exists($ruta)){
					$file=$this->File->find('first',array('conditions' => array('url' => $address)));
					$ver=$file['File']['version'];
					$ver++;
					unlink(ROOT.$address);
					$data_base=array('version'=> $ver);
					$id_file=$file['File']['id'];
					$this->File->id = $id_file;
				}
				//si el archivo no existe se sube y empieza con la version 1
				else{
					$this->request->data('File.url',$address);
					$this->File->create();
					$data_base=array('customer_id' => $this->request->data['File']['customer_id'],'proffer_id' => $this->request->data['File']['proffer_id'], 'name' => $this->request->data['File']['file']['name'], 'description' => $this->request->data['File']['description'], 'url' => $address,'version' => '1');
				
				
				}
				//independiente de si existe o no el archivo, se guarda el contenido de data_base y se guarda el archivo en $ruta
				if($this->File->save($data_base)){
					
				
						$this->Session->setFlash(__('se ha guardado el archivo'));
						move_uploaded_file($this->request->data['File']['file']['tmp_name'],$ruta);
						$this->redirect(array('controller' => 'Proffers','action' =>'view', $proffer_id));
					}
					else{
						$this->Session->setFlash(__('no se guardo el documento'));
						$this->redirect(array('controller' => 'Proffers', 'action' =>'view', $proffer_id));
					}
			}
		}
	}
	
	
	
	function delete($id=null){
		
		if(!$this->request->is('post')){
			throw new MethodNotAllowedException();
		}
		$this->File->id = $id;
		$file=$this->File->read(null,$id);
		$proffer_id=$file['File']['proffer_id'];
		if(!$this->File->exists()){
			throw new NotFoundException(__('archivo invalido'));
		}
		$url=ROOT.$file['File']['url'];//ruta del archivo a borrar
		if($this->File->delete()){
			unlink($url);
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
	
function showGridFile($id=null)
        {

    // get how many rows we want to have into the grid - rowNum parameter in the grid
   
    $limit = $this->request->data['rows'];

    // get index row - i.e. user click to sort. At first time sortname parameter -
    // after that the index from colModel
    $sidx = $this->request->data['sidx'];

    // sorting order - at first time sortorder
    $sord = $this->request->data['sord'];

    $page = $this->request->data['page'];


    // if we not pass at first time index use the first column for the index or what you want
    if( !$sidx ) $sidx = 1;
            //calculate no of rows from query
            $row=$this->File->find('count', array('conditions' => array('proffer_id' => $id)));
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
            $this->File->recursive=-1;
	

	$resultado=$this->File->find('all',array('fields' => array('id','name', 'url', 'description','version'),'ORDER BY =' => $sidx.' '.$sord, 'limit' => $start,$limit, 'conditions' => array('proffer_id' => $id)));



            
          // $resultado=$this->Customer->find('all',array('fields' => array('id','name','phone','dress','state','created'),'order' => $sort_range,'limit' => $limit_range)); 

            //setting the response object

            $responce=new stdClass();
            $responce->page=$page;
            $responce->total_pages=$total_pages;
            $responce->records=$count;

			$i=0;
			            
            foreach($resultado as $row)
            {
            	
                $responce->rows[$i]['id']=$row['File']['id'];
                $responce->rows[$i]['cell']=array($row['File']['id'],$row['File']['url'], $row['File']['name'],$row['File']['description'],$row['File']['version']);
                
                $i++;
            }

           echo json_encode($responce);

            exit();

        }
        
        
        
        function showUrl(){
			$req=$this->request->data;
			echo $req;
			exit();
		}
}
?>