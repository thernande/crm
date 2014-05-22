<?php
	$this->PhpExcel->createWorksheet();
	$table = array(
    	array('label' => __('NIT'), 'width' => 'auto'),
    	array('label' => __('nombre'), 'width' => 'auto'),
    	array('label' => __('Direccion'), 'width' => 'auto'),
    	array('label' => __('fecha de creacion'), 'width' => 'auto'),
    	array('label' => __('fecha de modificado'), 'width' => 'auto')
	);
	utf8_decode($table);
	$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));
	foreach ($customer as $d) {
    	$this->PhpExcel->addTableRow(array(
        	utf8_decode($d['Customer']['nit']),
        	utf8_decode($d['Customer']['name']),
        	utf8_decode($d['Customer']['dress']),
        	utf8_decode($d['Customer']['created']),
        	utf8_decode($d['Customer']['modified'])
    	));
	}
	
	$this->PhpExcel->addTableFooter()
	->output();
?>