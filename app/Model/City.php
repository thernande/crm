<?php

	class City extends AppModel{
		public $name='city';
		
		public $belongsTo=array(
			'Department'=>array(
				'className'=>'Department',
				'dependant'=>true,
				'foreignKey'=>'department_id'
			)
		);
	}

?>