<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/smartPark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title>Actualizar Vehículo</title>
</head>
<body>
    <?= $navbar ?>
    <div class="cont"> 
        <div class="btnA">
            <a href="<?= base_url('vehicle/showVehiclesL')?>"><button>Atrás</button></a>
        </div>

        <div class="formC">
            <form class="form" action="<?= base_url('vehicle/updateV') ?>" method="POST">
            <?php if ($vehi){ ?>
					<?php foreach ($vehi as $item): ?>
                <div class="titleF">
                    <h2>Actualizar Vehículo </h2>
                    <div class="line lineF"></div>
                </div>
                <div class="contenedorFor">
                    <div class="spaceF1">
                        <label>Placa <br>
                            <input name="license" value="<?=$item->licensePlate ?>" readonly>
                        </label> <br>
                        <label>Tipo <br>
                            <input  value="<?=$item->type ?>" disabled>
                        </label> <br>
                        <label>Color  <br>
                            <input name="color" value="<?=$item->color ?>" required>
                        </label>
                    </div>
                    <div class="spaceF2">
                        <?php if($item->type == "Moto") {?>
                            <img src="<?= base_url('./assets/img/motocycle.svg')?>">
                        <?php } else if($item->type == "Carro"){ ?>
                            <img src="<?= base_url('./assets/img/car.svg')?>">
                        <?php } ?>
                    </div>
                </div>
                <div class="btnForm">
                    <button type="submit">Actualizar</button>
                </div>
                <?php endforeach; ?>
			<?php } ?>
            </form>
        </div>
    </div>
    <?= $footer ?>
</body>
</html>