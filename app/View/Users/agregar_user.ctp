<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

<?php
    if($user['perfil'] == 1) {
        echo "<h3>Agregar Nuevo Usuario</h3>";
        echo $this->Form->create('User');
        echo $this->Form->input('nombre', array('label' => 'Nombre', 'class' => 'form-control'));
        echo $this->Form->input('username', array('label' => 'Correo', 'class' => 'form-control'));
        echo $this->Form->input('password', array('label' => 'Contraseña', 'class' => 'form-control'));
        echo $this->Form->input('perfil', array('label' => 'Tipo Usuario', 'class' => 'form-control', 'type' => 'select', 'options' => array('1' => 'Administrador', '2' => 'Usuario')));
        echo $this->Form->input('estado', array('label' => 'Estado', 'class' => 'form-control', 'type' => 'select', 'options' => array('1' => 'Habilitado', '2' => 'No habilitado')));
        echo '<button type="submit" class="btn btn-primary">Registrar Usuario</button>';
        echo $this->Form->end();
    } else {
        echo '<div class="alert alert-info">Usted no tiene permisos para ver esta página</div>';
    }
?>