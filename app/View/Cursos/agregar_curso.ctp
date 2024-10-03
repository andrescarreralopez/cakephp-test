<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

<?php
    if($user['perfil'] == 1) {
        echo "<h3>Agregar Curso</h3>";
        echo $this->Form->create('Curso');
        echo $this->Form->input('nombre', array('label' => 'Nombre', 'class' => 'form-control'));
        echo $this->Form->input('descripcion', array('label' => 'Descripción', 'class' => 'form-control'));
        echo $this->Form->input('fecha_inicio', array('label' => 'Fecha Inicio Curso', 'type' => 'datetime-local', 'class' => 'form-control'));
        echo $this->Form->input('fecha_fin', array('label' => 'Fecha Término Curso', 'type' => 'datetime-local', 'class' => 'form-control'));
        echo '<button type="submit" class="btn btn-primary">Registrar Curso</button>';
        echo $this->Form->end();
    } else {
        echo '<div class="alert alert-info">Usted no tiene permisos para ver esta página</div>';
    }
?>