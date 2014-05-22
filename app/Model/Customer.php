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


           'Department' => array(
            'className' => 'Department',
            'dependent' => true,
            'foreignKey' => 'department_id',

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
        ),
        'Functionary' => array(
            'className' => 'Functionary',
        )
    );


       
    
        public $validate = array(
        'name' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el mombre del cliente'
        ),
        'dress' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese la dirección del cliente'
        ),
        'department_id' => array(
        'rule' => 'notEmpty',
        'message' => 'Seleccione el municipio'
        )



        );
    
        

}

?>