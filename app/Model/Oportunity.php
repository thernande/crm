<?php
	class Oportunity extends AppModel{
		public $name = 'Oportunity';
		
		public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'dependent' => true,
            'foreignKey' => 'customer_id'
        ));
        
        public $hasMany = array(
        'LineModeOportunity' => array(
        	'className' => 'LineModeOportunity',
        	'foreignKey'=> 'oportunity_id',
        	'dependent' => true
        ));
	}
?>