<?php
// app/Model/User.php
class AreasType extends AppModel {

    public $name = 'AreasType';
    

     public $belongsTo = array(
        'Area' => array(
            'className' => 'Area',
          //  'conditions' => array('Process.state' => '0'),  
            'dependent' => true,
            'foreignKey' => 'id',


        )
    );

    

    
    


}

?>