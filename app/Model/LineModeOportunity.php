<?php
	class LineModeOportunity extends AppModel{
		public $name='LineModeOportunity';
		
		public $belongsTo=array(
			'Line' => array(
            	'className' => 'Line',
            	'foreignKey' => 'line_id'
        	),'Mode' => array(
            'className' => 'Mode',
            'foreignKey' => 'mode_id'
        ),'Oportunity' => array(
            'className' => 'Oportunity',
            'foreignKey' => 'oportunity_id'
        )
		);
	}
?>