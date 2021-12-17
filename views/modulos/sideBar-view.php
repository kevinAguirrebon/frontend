<a href="<?php echo SERVERURL ?>home/" class="brand-link navbar-Success" style="font-weight: bold;">
	<img src="<?php echo SERVERURL ?>views/assets/dist/img/PrunusApp.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
	<span class="brand-text font-weight-light"><?php echo COMPANY; ?></span>
</a>
<div class="sidebar">
	<div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content: space-between;">
		<div class="image">
			<img src="<?php echo SERVERURL ?>views/assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
		</div>
		<div class="info">
			<a class="d-block">Administrador</a>
		</div>
	</div>
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-header">SERVICIOS</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo SERVERURL ?>home/">
					<i class="nav-icon fas fa-route"></i>
					<p>Control viajes</p>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo SERVERURL ?>alineacion/">
					<i class="nav-icon fas fa-border-all">
					</i>
					<p>Alineación</p>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo SERVERURL ?>lista/">
					<i class="nav-icon fas fa-road"></i>
					<p>Lista de viajes App</p>
				</a>
			</li>
			<li class="nav-item"><a href="!#" class="nav-link">
					<i class="nav-icon fas fa-bus"></i>
					<p>Control de viajes<i class="right fas fa-angle-left">
						</i></p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item"><a class="nav-link" name="" href="<?php echo SERVERURL ?>rutas/"> <i class="far fa-circle nav-icon"></i>
							<p>Crear rutas</p>
						</a></li>
					<li class="nav-item"><a class="nav-link" name="" href="<?php echo SERVERURL ?>viajes/"> <i class="far fa-circle nav-icon"></i>
							<p>Crear viajes</p>
						</a></li>
				</ul>
			</li>
			<li class="nav-item"><a href="!#" class="nav-link"><i class="nav-icon fas fa-users-cog"></i>
					<p>Gestión<i class="right fas fa-angle-left"></i></p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item"><a class="nav-link" name="" href="<?php echo SERVERURL ?>camiones/"> <i class="far fa-circle nav-icon"></i>
							<p>Camiones</p>
						</a></li>
					<li class="nav-item"><a class="nav-link" name="" href="<?php echo SERVERURL ?>conductores/"> <i class="far fa-circle nav-icon"></i>
							<p>Conductores</p>
						</a></li>
				</ul>
			</li>
		</ul>
	</nav>
</div>