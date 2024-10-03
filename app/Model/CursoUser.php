<?php
    class CursoUser extends AppModel {

        public $belongsTo = array(
            'Curso' => array(
                'className' => 'Curso',
                'foreignKey' => 'curso_id'
            ),
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )
        );
    }
?>