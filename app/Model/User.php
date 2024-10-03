<?php
    class User extends AppModel {
        public $validate = array(
            'nombre' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar un nombre'
                )
            ),
            'username' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar un correo'
                )
            ),
            'password' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Se requiere una contraseña',
                    'on' => 'create'
                )
            )
        );

        public function beforeSave($options = array()) {
            // Ciframos la contraseña antes de guardarla
            if (isset($this->data[$this->alias]['password'])) {
                $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            }
            return true;
        }
    }
?>