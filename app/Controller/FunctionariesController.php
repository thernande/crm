<?php
	class FunctionaryController extends AppController{
			 public function get_functionary_by_customer($id = null) {
    $this->loadModel('Functionary');
    
    $functionaries = $this->Functionary->find('all', array('conditions' => array('functionary.customer_id =' => $id), 'recursive' => 3));
    $returnFunctionaries = array();
    foreach ($functionaries as $functionary) {
      $returnFunctionaries[$functionary['Functionary']['id']] = "{$functionary['Functionary']['name']}";
    }
    
    return $returnFunctionaries;


  }
  
  
  
  public function html_functionary_by_customer($id = null) {
    

    $this->layout = false;
    $this->autoRender = false;

     
            

    $functionaries = $this->get_functionary_by_customer($id);


    $strReturn = '<option> -- </option>';
    foreach ($functionaries as $idFunctionary=> $value) {
      
      $strReturn = $strReturn . "<option value='{$idFunctionary}'>{$value}</option>";
    }
    
    echo $strReturn;
  }
	}
?>