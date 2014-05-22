<?php
	class Line extends AppModel{
		
		public $name='Line';
		
		public $hasMany = array(
        'LineModeOportunity' => array(
        	'className' => 'LineModeOportunity',
        	'foreignKey'=> 'line_id'
        ));
        
    }
?>