<?php

	class City extends AppModel{
		public $name='city';
		
		public $belongsTo=array(
			'Municipality'=>array(
				'className'=>'municipality',
				'dependant'=>true,
				'foreignKey'=>'municipality_id'
			)
		);
	}

?>