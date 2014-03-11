<?php
/**
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

class File extends AppModel {

public $name = 'File';
	
	public $belongsTo=array('Customer' => 
	array('className' => 'Customer', 
	'dependant' => TRUE, 
	'foreign_key' => 'customer_id'),
	'Proffer' => array(
		'className' => 'Proffer',
		'dependant' => true,
		'foreign_key' => 'customer_id'
	)
	);
	
	public $validate = array(
		'name' => array('rule' => 'notEmpty', 'message' => 'complete this field')
	);
	
	public function isUploadedFile($params) {
    		$val = array_shift($params);
    		if ((isset($val['error']) && $val['error'] == 0) ||
      		   (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')
   			 ) {
    	    	return is_uploaded_file($val['tmp_name']);
  			}
   			return false;
}
	
}
?>