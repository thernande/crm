<?php
// app/Model/User.php
class Area extends AppModel {

    public $name = 'Area';
    

     public $belongsTo = array(
        'Process' => array(
            'className' => 'Process',
          //  'conditions' => array('Process.state' => '0'),  
            'dependent' => true,
            'foreignKey' => 'process_id',


        ),


           'Areastype' => array(
            'className' => 'Areastype',
            'dependent' => true,
            'foreignKey' => 'areastype_id',
        )
    );

	    
  
    


}

?>