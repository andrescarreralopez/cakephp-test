<?php
    class Curso extends AppModel {
        public $validate = array(
            'nombre' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar el nombre del curso'
                )
            ),
            'descripcion' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar una descripción del curso'
                )
            ),
            'fecha_inicio' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar una fecha de inicio para el curso'
                )
            ),
            'fecha_fin' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Debe ingresar una fecha de término para curso'
                )
            )
        );
    }
?>