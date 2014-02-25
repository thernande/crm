<?php
// app/Model/User.php
class Customer extends AppModel {

    public $name = 'Customer';
    

     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'user_id',


        ),


           'Municipality' => array(
            'className' => 'Municipality',
            'dependent' => true,
            'foreignKey' => 'Municipality_id',

        ),
        

    );

     
       public $hasMany = array(
        'Contact' => array(
            'className' => 'Contact',
            'foreignKey' => 'Customer_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),

        'Proffer' => array(
            'className' => 'Proffer',
        )
    );


       
    
        public $validate = array(
        'name' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el mombre del cliente'
        ),
        'phone_1' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el numero telefonico de contacto'
        ),
        'email' => array(
        'rule' => 'email',
        'message' => 'Ingrese el email'
        ),
        'dress' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese la dirección del cliente'
        ),
        'municipality_id' => array(
        'rule' => 'notEmpty',
        'message' => 'Seleccione el municipio'
        )



        );
    
        

}

?>