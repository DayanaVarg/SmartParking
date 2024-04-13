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
    <title>Registrar Salida</title>
</head>
<body>
    <?= $navbar ?>
        <div class="formC2">
            <form action="<?= base_url('vehicle/registerFins') ?>" method="POST">
            <?php if ($vehi){ ?>
					<?php foreach ($vehi as $item): ?>
                <div class="titleF">
                    <h2>Registrar Salida </h2>
                    <div class="line lineF"></div>
                </div>
                <div class="contenedorFor">
                    <div class="spaceF1">
                        <label>Placa <br>
                            <input  value="<?= $item->licensePlate ?>" readonly>
                        </label> <br>
                        <label>Tipo <br>
                            <input value="<?= $item->type ?>" readonly>
                        </label> <br>
                        <label>Color  <br>
                            <input value="<?= $item->color ?>" readonly>
                        </label>
                    </div>
                    <div class="spaceF1">
                        <div class="groups">
                            <div class="group">
                                <label>Fecha Entrada <br>
                                    <input value="<?= $item->date_Entrance ?>" readonly>
                                </label> <br>
                            </div>
                            <div class="group">
                                <label>Hora Entrada <br>
                                    <input  value="<?= $item->time_Entrance ?>" readonly>
                                </label> <br>
                            </div>
                        </div>
                        <div class="groups">
                            <div class="group">
                                <label>Fecha Salida <br>
                                    <input name="date_Finish" value="<?= $fecha_actual?>" readonly>
                                </label> <br>
                            </div>
                            
                            <div class="group">
                            <label>Hora Salida <br>
                                <input name="time_Finish" value="<?= $hora_actual?>" readonly>
                            </label> <br>
                            </div>
                        </div>
                        
                        <label>Valor a pagar<br>
                            <input type="number" class="inputP" name="totalCos"  required>
                        </label> <br>
                    </div>
                </div>
                <input type="hidden" name="idDetails" value="<?= $item->idDetails?>">

                <div class="btnForm">
                    <button type="submit">Registrar</button>
                </div>
                <?php endforeach; ?>
				<?php } ?>
            </form>
        </div>
    <?= $footer ?>
    
<script src="<?= base_url('./assets/js/script.js') ?>"></script>
</body>
</html>