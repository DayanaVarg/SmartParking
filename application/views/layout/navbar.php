
<header class="header">
	<div class="header__container">
		<div class="space-img">
			<img class="img" src="<?= base_url('./assets/img/smartparking.png') ?>" alt=""/>
		</div>
	</div>
</header>


<div class="nav" id="navbar">

	<nav class="nav__container">
		<div>
			<div class="nav__list">
				<div class="nav__items">

					<a href="<?= base_url('vehicle/showVehicles') ?>"  class="nav__link">
						<i class="bx bx-home nav__icon"></i>
						<span class="nav__name">Inicio</span>
					</a>

				</div>
				<div class="nav__items">
					<h3 class="nav__subtitle">Menu</h3>

					<div class="nav__dropdown">
						<a href="#" class="nav__link">
							<i class="bx bx-user nav__icon"></i>
							<span class="nav__name">Vehiculos</span>
							<i class="bx bx-chevron-down nav__icon nav__dropdown-icon"></i>
						</a>
						<div class="nav__dropdown-collapse">
							<div class="nav__dropdown-content">
								<a href="<?= base_url('vehicle/showHistVehicles') ?>" class="nav__dropdown-item">Historial</a>
							</div>
							<div class="nav__dropdown-content">
								<a href="<?= base_url('vehicle/showVehiclesL') ?>" class="nav__dropdown-item">Listado</a>
							</div>
							<div class="nav__dropdown-content">
								<a href="<?= base_url('vehicle/registerEn') ?>" class="nav__dropdown-item">Registrar Entrada</a>
							</div>
							<div class="nav__dropdown-content">
								<a href="<?= base_url('vehicle/registerFin') ?>" class="nav__dropdown-item">Registrar Salida</a>
							</div>
						</div>
						
					</div>
					
					<div class="nav__dropdown">
						<a href="<?= base_url('login/logout')?>" class="nav__link ">
							<i class="bx bx-log-out nav__icon"></i>
							<span class="nav__name">Cerrar sesión</span>
						</a>
					</div>

				</div>
			</div>

		</div>
	</nav>
</div>