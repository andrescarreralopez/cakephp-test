<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

<?php
    if($user['perfil'] == 1):{
            echo "<h5>Listado de usuarios registrados</h5><br>";
            echo '<div class="d-flex justify-content-end mb-4">';
            echo $this->Html->link('Agregar nuevo usuario', array('controller' => 'users', 'action' => 'agregarUser'), array('class' => 'btn btn-primary'));
            echo '</div>';
    ?>
<table id="usuarios" class="table table-bordered">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo Usuario</th>
            <th>Estado</th>
            <th>Estado</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($usuarios as $usuario): ?>
            <?php
                if($usuario['User']['perfil'] == 1)
                    $perfil = "Administrador";
                else
                    $perfil = "Usuario";
                    
                if($usuario['User']['estado'] == 1)
                    $estado = "Habilitado";
                else
                    $estado = "No habilitado";   
            ?>
            <tr>
                <td><?php echo $usuario['User']['id']; ?></td>
                <td><?php echo $usuario['User']['nombre']; ?></td>
                <td><?php echo $usuario['User']['username']; ?></td>
                <td><?php echo $perfil; ?></td>
                <td><?php echo $estado; ?></td>
                <td><?php echo $this->Html->link('Editar', array('controller' => 'users', 'action' => 'editarUser', $usuario['User']['id'])); ?></td>
                <td><?php echo $this->Form->postLink('Eliminar', array('controller' => 'users', 'action' => 'eliminarUser', $usuario['User']['id']), array('confirm' => 'Eliminar el usuario '.$usuario['User']['nombre'].'?')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php } 
else:
{
    echo '<div class="alert alert-info">Usted no tiene permisos para ver esta página</div>';
}
endif;
?>

<script>
    $( document ).ready(function() {
        $('#usuarios').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.7/i18n/es-MX.json',
            }
        });
    });
</script>
