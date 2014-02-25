<?php
// app/Model/Count.php
class Count extends AppModel {



    public $validate = array(
        'Countname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A Countname is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
          'email' => 'email',
    );


    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }













}

?>