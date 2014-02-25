<?php
// app/Model/User.php
class Contact extends AppModel {

    public $name = 'Contact';

    
    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'dependent' => true,
            'foreignKey' => 'customer_id',


        ),                  

    );


     public $validate = array(
        'name' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el mombre del contacto'
        ),
        'phone' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el numero telefonico de contacto'
        ),
        'email' => array(
        'rule' => 'email',
        'message' => 'Ingrese el email'
        )
        
       );
    



}

?>  