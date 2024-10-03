<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>

    <h5>Listado de cursos</h5>
    <br>
    <?php
        if($user['perfil'] == 1){
            echo '<div class="d-flex justify-content-end mb-4">';
            echo $this->Html->link('Agregar nuevo curso', array('controller' => 'cursos', 'action' => 'agregarCurso'), array('class' => 'btn btn-primary'));
            echo '</div>';
        }
    ?>
    
    <?php if(!empty($cursos)): ?>
        <table id="cursos" class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Término</th>
                    <?php if($user['perfil'] == 1): ?>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    <?php endif; ?>
                    <th>Listado alumnos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cursos as $curso): ?>
                    <tr>
                        <td><?php echo $curso['Curso']['id']; ?></td>
                        <td><?php echo $curso['Curso']['nombre']; ?></td>
                        <td><?php echo $curso['Curso']['descripcion']; ?></td>
                        <td><?php echo h(date('d-m-Y H:i', strtotime($curso['Curso']['fecha_inicio'])));?></td>
                        <td><?php echo h(date('d-m-Y H:i', strtotime($curso['Curso']['fecha_fin'])));?></td>
                        <?php if($user['perfil'] == 1): ?>
                            <td><?php echo $this->Html->link('Editar', array('controller' => 'cursos', 'action' => 'editarCurso', $curso['Curso']['id'])); ?></td>
                            <td><?php echo $this->Form->postLink('Eliminar', array('controller' => 'cursos', 'action' => 'eliminarCurso', $curso['Curso']['id']), array('confirm' => 'Eliminar el curso '.$curso['Curso']['nombre'].'?')); ?></td>
                        <?php endif; ?>
                        <td><?php echo $this->Form->postLink('Ver listado alumnos', array('controller' => 'cursos', 'action' => 'listaAlumnos', $curso['Curso']['id'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <?php if($user['perfil'] == 1): ?>
            <div class="alert alert-danger">Actualmente no existen cursos registrados en el sistema</div>
        <?php else: ?>
            <div class="alert alert-danger">Acualmente usted no se encuentra inscrito en ningún curso.</div>
        <?php endif; ?>
    <?php endif; ?>

<script>
    $( document ).ready(function() {
        $('#cursos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.7/i18n/es-MX.json',
            }
        });
    });
</script>

