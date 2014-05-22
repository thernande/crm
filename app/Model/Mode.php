<?php
	class Mode extends AppModel{
		
		public $name="Mode";
		
		public $hasMany = array(
        'LineModeOportunity' => array(
        	'className' => 'LineModeOportunity',
        	'foreignKey'=> 'mode_id'
        ));
	}

?>