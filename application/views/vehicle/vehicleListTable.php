<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/smartPark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/tabla.css') ?>">
	<link rel="stylesheet" href="<?= base_url('./assets/css/modal.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.css">

    <title>Vehículos</title>
</head>
<body>
    <?= $navbar ?>
    <div class="container">
        <?php if ($error = $this->session->flashdata('error')): ?>
            <div id="errorAlert" class="alert ">
                <div class="alert-danger">
				    <span><?= $error?></span>
			    </div>
            </div>
	    <?php endif; ?>
	    <?php if ($msg = $this->session->flashdata('msg')): ?>
            <div id="successAlert"  class="alert ">
                <div class="alert-success">
				    <span><?= $msg ?></span>
			    </div>
            </div>
	    <?php endif; ?>
        <div class="spaceBtn1">
			<div class="botonespace">
        		<button id="buttonR" class="buttonR">Importar</button>
    		</div>
			<div class="Container-modal">
				<form class="formModal" action="<?= base_url('vehicle/importV') ?>" method="POST" enctype="multipart/form-data">
					<div class="closeB">+</div>
					<p class="title">Seleccionar archivo</p>

					<div class="flex">
						<label>
							<input class="input" type="file" name="file"  accept="csv/*" required>
							<span>Archivo CSV</span>                
						</label>
					</div>
					<button class="submit">Importar</button>
				</form>
				<div class="colorlibcopy-agile"></div>
    		</div>
		</div>

        <div class="spaceBtn2 btnOp">
			<div class="btnD">
				<button id="exportButton">Exportar</button>
			</div>
            <div class="btnElec btnElecT">
                <button class="btnAct"><img src="<?= base_url('./assets/img/tableIconAc.svg') ?>"></a></button>
                <button class="btnDesc"><a href="<?= base_url('vehicle/showVehiclesL') ?>"><img src="<?= base_url('./assets/img/cardIconAc.svg') ?>"></a></button>
            </div>
        </div>
      
        <div class="table tableV">       
        <table class="contT contTa" id="datat">
				<h1 class="titulo">Vehículos</h1>
				<thead >
					<tr>
						<th>Placa</th>
						<th>Tipo</th>
						<th>Color</th>
						<th>Estado</th>
						<th id="act1" colspan="2">Acciones</th>
					</tr>
				</thead>	
				<tbody>
				<?php if ($vehi){ ?>
					<?php foreach ($vehi as $item): ?>
						<tr>
							<td><?= $item->licensePlate?></td>
							<td><?= $item->type ?></td>
							<td><?= $item->color?></td>
							<?php if($item->state == 1){?>
								<td>Activo</td>
							<?php }else{?>
								<td>Inactivo</td>
							<?php } ?>
							<td id="act">
								<form action="<?= base_url('vehicle/dropHisV')?>" method="post">
									<input type="hidden" name="idDetails" value="<?= $item->licensePlate?>">
									<button class="button2 btnActu" type="submit">Actualizar</button>
								</form>
							</td>
							<?php if($item->state == 1){?>
							<td id="act">
								<form action="<?= base_url('vehicle/inactVeh')?>" method="post">
									<input type="hidden" name="license" value="<?= $item->licensePlate?>">
									<button class="button2 btnelm" type="submit">Inactivar</button>
								</form>
							</td>
							<?php }else{?>
								<td id="act">
								<form action="<?= base_url('vehicle/actVeh')?>" method="post">
									<input type="hidden" name="license" value="<?= $item->licensePlate?>">
									<button class="button2 btnActu" type="submit">Activar</button>
								</form>
							</td>
							<?php } ?>
						</tr>
					<?php endforeach; ?>
				<?php }else{?>
					<tr>
						<td colspan="9">No existen registros</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
        </div>   
    </div>
    <?= $footer ?>
	<script src="<?= $script_url?>"></script>
	<script src="<?= base_url('assets/js/modal.js') ?>"></script>
    <script>
		var datat=document.querySelector("#datat");
		var dataTable=new DataTable("#datat",{
			labels: {
				placeholder: "Busca por un campo...",
				noRows: "No se encontraron registros",
				perPage: "Motrar {select} registros por página",
				info: "Mostrando {start} a {end} de {rows} registros",
			}

		} ) ;
	</script>
</body>
</html>