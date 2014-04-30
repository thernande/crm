<?php
	$this->PhpExcel->createWorksheet()->setDefaultFont('Calibri',12);
	$table = array(
    	array('label' => __('NIT'), 'width' => 'auto'),
    	array('label' => __('nombre'), 'width' => 'auto'),
    	array('label' => __('Direccion'), 'width' => 'auto'),
    	array('label' => __('fecha de creacion'), 'width' => 'auto'),
    	array('label' => __('fecha de modificado'), 'width' => 'auto')
	);
	
	$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
	
	foreach ($customer as $d) {
    	$this->PhpExcel->addTableRow(array(
        	$d['Customer']['nit'],
        	$d['Customer']['name'],
        	$d['Customer']['dress'],
        	$d['Customer']['created'],
        	$d['Customer']['modified']
    	));
    	$tableC = array(
    		array('label' => __(' '), 'width' => 'auto'),
    		array('label' => __('nombre'), 'width' => 'auto'),
    		array('label' => __('telefono'), 'width' => 'auto'),
    		array('label' => __('celular'), 'width' => 'auto'),
    		array('label' => __('email'), 'width' => 'auto'),
    		array('label' => __('cargo'), 'width' => 'auto'),
    		array('label' => __('fecha de creacion'), 'width' => 'auto'),
    		array('label' => __('fecha de modificado'), 'width' => 'auto')
		);
		$this->PhpExcel->addTableHeader($tableC, array('name' => 'Cambria', 'bold' => true));
		$Contacts=$d['Contacts'];
		foreach($Contacts as $Contact){
			$this->PhpExcel->addTableRow(array(
				'',
        		$Contact['Contacts']['name'],
        		$Contact['Contacts']['phone'],
        		$Contact['Contacts']['cellphone'],
        		$Contact['Contacts']['email'],
        		$Contact['Contacts']['position'],
        		$Contact['Contacts']['created'],
        		$Contact['Contacts']['modified']
    		));
		}
	}
	
	$this->PhpExcel->addTableFooter()
	->output();
?>