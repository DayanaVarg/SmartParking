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
    <title>Registrar entrada</title>
</head>
<body>
    <?= $navbar ?>
    <div class="cont"> 
        <div class="btnA">
            <a href="<?= base_url('vehicle/showVehicles')?>"><button>Atrás</button></a>
        </div>

        <div class="formC">
            <form action="<?= base_url('vehicle/registerEnt') ?>" method="POST">
                <div class="titleF">
                    <h2>Registrar Entrada </h2>
                    <div class="line lineF"></div>
                </div>
                <div class="contenedorFor">
                    <div class="spaceF1">
                        <label>Placa <br>
                            <input type="text" name="licenseP" pattern=".{6,6}"  title="Se solicitan 6 caracteres"required>
                        </label> <br>
                        <label>Tipo <br>
                            <select id="type" name="type" required>
                                <option >Seleccione uno</option>
                                <option  value="Carro">Carro</option>
                                <option value="Moto">Moto</option>
                            </select>
                        </label> <br>
                        <label>Color  <br>
                            <input type="text" name="color" required>
                        </label>
                    </div>
                    <div class="spaceF2">
                        <img  id="motoImage" src="<?= base_url('./assets/img/motocycle.svg')?>" style="display: none;">
                        <img id="carImage" src="<?= base_url('./assets/img/car.svg')?>" style="display: none;">
                    </div>
                </div>
                <input type="hidden" name="date_E" value="<?= $fecha_actual?>">
				<input type="hidden"  name="time_E" value="<?= $hora_actual?>">
                <div class="btnForm">
                    <button type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <?= $footer ?>
    
<script src="<?= base_url('./assets/js/script.js') ?>"></script>
</body>
</html>