<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<link reel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<link reel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">

	<script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	<script defer src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
	<script defer src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>

	<?php echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'); ?>
	<?php echo $this->Html->css('https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css'); ?>
	<?php echo $this->Html->script('https://code.jquery.com/jquery-3.7.1.js'); ?>
	<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js'); ?>
	<?php echo $this->Html->script('https://cdn.datatables.net/2.1.7/js/dataTables.js'); ?>
	<?php echo $this->Html->script('https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js'); ?>

	<?php echo $this->Html->css('bootstrap.min.css'); ?>
	<?php echo $this->Html->css('styles.min.css'); ?>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
	<?php if ($this->request->params['action'] != 'login'): ?>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo align-items-center justify-content-between text-center mt-4">
			SISTEMA CURSOS
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
			<!-- Sidebar navigation-->
				<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
				<ul id="sidebarnav">
					<li class="nav-small-cap">
						<i class="ti ti-dots nav-small-cap-icon fs-6"></i>
						<span class="hide-menu"></span>
					</li>
					<?php if($user['estado'] == 1): ?>					
						<li class="sidebar-item">
						<a class="sidebar-link" href="/cakephp-test/cursos" aria-expanded="false">
							<span>
							<iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
							</span>
							<span class="hide-menu">Listado cursos</span>
						</a>
						</li>
					<?php if($user['perfil'] == 1): ?>
						<li class="sidebar-item">
						<a class="sidebar-link" href="/cakephp-test/users" aria-expanded="false">
							<span>
							<iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
							</span>
							<span class="hide-menu">Listado usuarios</span>
						</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>
				<li class="sidebar-item">
				<a class="sidebar-link" href="/cakephp-test/users/logout" aria-expanded="false">
					<span>
					<iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
					</span>
					<span class="hide-menu">Cerrar Sesión</span>
				</a>
				</li>
			</nav>
			<!-- End Sidebar navigation -->
		<?php endif; ?>
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        
      </header>
      <!--  Header End -->
      <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
					<div class="card-header pb-0">						
						<?php echo $this->Flash->render(); ?>
					</div>
                    <div class="card-body">
					<div id="content">
						<?php echo $this->fetch('content'); ?>
					</div>
                    </div>
					
                </div>
            </div>
			</div>
      </div>
    </div>
  </div>
  	<?php //echo $this->element('sql_dump'); ?>
	<?php echo $this->Html->script('bootstrap.min.js'); ?>
	<?php echo $this->Html->script('assets/libs/jquery/dist/jquery.min.js'); ?>
	<?php echo $this->Html->script('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>
	<?php echo $this->Html->script('assets/libs/simplebar/dist/simplebar.js'); ?>
	<?php echo $this->Html->script('assets/js/sidebarmenu.js'); ?>
	<?php echo $this->Html->script('assets/js/app.min.js'); ?>

	<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>
</html>
