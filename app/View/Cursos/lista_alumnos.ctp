<?php echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('styles.min.css'); ?>
<h5>Lista de alumnos inscritos en <?php echo $curso['Curso']['nombre'] ?></h5>
<br>

<?php if($user['perfil'] == 1): ?>
    <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Ingresar nuevo alumno al curso
        </button>
    </div>
<?php endif; ?>

<?php if(!empty($alumnos)): ?>
<table id="alumnos" class="table table-bordered">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Correo</th>
            <?php if($user['perfil'] == 1): ?>
                <th>Remover del curso</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($alumnos as $alumno): ?>
            <tr>
                <td><?php echo $alumno['User']['id']; ?></td>
                <td><?php echo $alumno['User']['nombre']; ?></td>
                <td><?php echo $alumno['User']['username']; ?></td>
                <?php if($user['perfil'] == 1): ?>
                    <td><?php echo $this->Form->postLink('Remover Alumno', array('controller' => 'cursos', 'action' => 'removerAlumno', $alumno['CursoUser']['id'], $curso['Curso']['id']), array('confirm' => '¿Está seguro de remover al alumno del curso?')); ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <div class="alert alert-info">No hay alumnos inscritos en el curso</div>
<?php endif; ?>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Inscripción de alumnos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if(empty($alumnosPendientes)): ?>
            <div class="alert alert-danger">No hay alumnos disponibles para inscribir</div>
        <?php else: ?>
            <?php
                echo $this->Form->create('CursoUser', array('url' => array('controller' => 'cursos', 'action' => 'agregarAlumnoCurso')));
                echo $this->Form->input('id_user', array('label' => 'Alumnos habilitados para inscripción', 'class' => 'form-control', 'type' => 'select', 'options' => $alumnosPendientes));
                echo $this->Form->input('id_curso', array('type' => 'hidden', 'value' => $curso['Curso']['id']));
            ?>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <?php if(!empty($alumnosPendientes)): ?>
            <button type="submit" class="btn btn-primary">Inscribir alumno</button>
        <?php endif; ?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>

<script>
    $( document ).ready(function() {
        $('#alumnos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.7/i18n/es-MX.json',
            }
        });
    });
</script>