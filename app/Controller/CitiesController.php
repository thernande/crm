<?php
	class CitiesController extends AppController{
		
		public $helpers = array('Html','Form','Js');
    	public $components = array('Session','RequestHandler');
    	public $name = 'Cities';
		
		public function get_cities_by_municipality($id = null) {
    
   		 	$cities = $this->City->find('all', array('conditions' => array('municipality_id =' => $id), 'recursive' => 1));
    		$returnCities = array();
    		foreach ($cities as $city) {
    		 	$returnCities[$city['City']['id']] = "{$city['City']['city']}";
    		}	
    
    		return $returnCities;

  		}
  		
  		public function html_cities_by_municipality($id = null) {
    

   		 	$this->layout = false;
    		$this->autoRender = false;

     
            

    		$cities = $this->get_cities_by_municipality($id);


    		$strReturn = '<option> -- </option>';
    		foreach ($cities as $idCity=> $value) {
      
      			$strReturn = $strReturn . "<option value='{$idCity}'>{$value}</option>";
    		}
    
    		echo $strReturn;
  		}
  		
	}
?>