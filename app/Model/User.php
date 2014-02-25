<?php
// app/Model/User.php
class User extends AppModel {

    public $name = 'user';

     public $belongsTo = array(
        'Area' => array(
            'className' => 'Area',
            'dependent' => true,
            'foreignKey' => 'area_id',
        ),
        'Group' => array(
            'className' => 'Group',
            'dependent' => true,
            'foreignKey' => 'group_id',
        )


        );

   /*     
     public $actsAs = array('Acl' => array('type' => 'requester'));

     public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

*/
 
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El nombre de usuario es requerido'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'la contraseña es requireda'
            )
        ),
           'group_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El grupo de usuario es requerido'
            )
        )



    );


    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }













}

?>