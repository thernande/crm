<?php
// app/Model/User.php
class Process extends AppModel {

    public $name = 'Process';
    



    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'target' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A target is required'
            )
        ),
        'type' => array(
          'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A type is required'
           

             )
        )
    );
    

}

?>  