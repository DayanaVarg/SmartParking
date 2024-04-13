<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/smartPark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/tabla.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/mobius1/vanilla-Datatables@latest/vanilla-dataTables.min.css">

    <title>Historial Vehículos</title>
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
        <div class="spaceBtn1"></div>
        <div class="spaceBtn2 btnOp">
            <div class="btnElec btnElecT">
                <button class="btnAct"><img src="<?= base_url('./assets/img/tableIconAc.svg') ?>"></a></button>
                <button class="btnDesc"><a href="<?= base_url('vehicle/showHistVehicles') ?>"><img src="<?= base_url('./assets/img/cardIconAc.svg') ?>"></a></button>
            </div>
        </div>
      
        <div class="table">       
        <table class="contT" id="datat">
				<h1 class="titulo">Historial Empleados</h1>
				<thead >
					<tr>
						<th>Placa</th>
						<th>Tipo</th>
						<th>Color</th>
						<th>Fecha Entrada</th>
						<th>Hora Entrada</th>
						<th>Fecha Salida</th>
						<th>Hora Salida</th>
						<th>Total Pago</th>
						<th id="act1">Acciones</th>
					</tr>
				</thead>	
				<tbody>
				<?php if ($vehi){ ?>
					<?php foreach ($vehi as $item): ?>
						<tr>
							<td><?= $item->FK_licensePlate?></td>
							<td><?= $item->type ?></td>
							<td><?= $item->color?></td>
							<td><?= $item->date_Entrance?></td>
							<td><?= $item->time_Entrance?></td>
							<td><?= $item->date_Finish?></td>
							<td><?= $item->time_Finish?></td>
							<td><?= $item->totalCost?></td>
							<td id="act">
								<form action="<?= base_url('user/dropHisE')?>" method="post">
								<input type="hidden" name="id_his" value="<?= $item->idDetails?>">
								<button class="button1" type="submit">Eliminar</button>
								</form>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php }else{?>
					<tr>
						<td colspan="8">No existen registros</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
        </div>   
    </div>
    <?= $footer ?>
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