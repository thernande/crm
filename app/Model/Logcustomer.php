<?php
	class Logcustomer extends AppModel{
		public $name='Logcustomer';
		
		public $belongsTo=array(
			'Customer'=>array(
				'className'=>'Customer',
				'foreignKey'=>'customer_id'
			)
		);
	}
?>