<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Cursos</title>
  <?php echo $this->Html->css('bootstrap.min.css'); ?>
  <?php echo $this->Html->css('styles.min.css'); ?>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <h4 class="text-center">Sistema Cursos</h4>
                
                <?php echo $this->Form->create('User'); ?>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                    <?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => false)); ?>
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => false)); ?>
                  </div>
                  <?php
                   echo $this->Flash->render();
                  ?>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4" type="submit">Iniciar Sesión</button>
                  
                <?php $this->Form->end(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>