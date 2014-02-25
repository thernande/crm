<?php
/*

Estados de las oportunidades de negocio


1. En_seguimiento 
2. Vencida
3. Cerrada - Efectiva
4. Cerrada - No efectiva


*/
class Proffer extends AppModel {

    public $name = 'Proffer';
    

     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'user_id',


        ),
           'Customer' => array(
            'className' => 'Customer',
            'dependent' => true,
            'foreignKey' => 'customer_id',

        ),

           'Contact' => array(
            'className' => 'Contact',
            'dependent' => true,
            'foreignKey' => 'contact_id',

        ),



    );

     
    
        public $validate = array(
        'customer_id' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el mombre del cliente'
        ),
        'contact_id' => array(
        'rule' => 'notEmpty',
        'message' => 'Ingrese el numero telefonico de contacto'
        ),
        'description' => array(
        'rule' => 'notEmpty',
        'message' => 'la descripción de la propuesta comercial'
        ),
        'mode' => array(
        'rule' => 'notEmpty',
        'message' => 'Seleccione la modalidad'
        ),

        'line' => array(
        'rule' => 'notEmpty',
        'message' => 'seleccione la linea de negocio'
        )


        );
    
        

}

?>