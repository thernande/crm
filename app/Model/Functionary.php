<?php
	class Functionary extends AppModel{
		public $name='Functionary';
		
		public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'dependent' => true,
            'foreignKey' => 'customer_id'
        ));
	}
?>