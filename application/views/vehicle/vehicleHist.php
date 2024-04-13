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
            
            <div class="space-search">
                <form class="formS" action="<?= base_url('vehicle/searchHistVeh') ?>" method="post"><input type="text" name="license" placeholder="Buscar por placa"><button type="submit"><i class="bx bx-search nav__icon"></i></button></form>
            </div>
            <div class="btnElec">
                <button class="btnDesc"><a href="<?= base_url('vehicle/showHistVehiclesT') ?>"><img src="<?= base_url('./assets/img/tableIcon.svg') ?>"></a></button>
                <button class=" btnAct"><img src="<?= base_url('./assets/img/cardIcon.svg') ?>"></button>
            </div>
        </div>
        
        <?php if ($vehi){ ?>
			<?php foreach ($vehi as $item): ?>
                <div class="card">
                    <div class="space1">
                        <h4>SmartParking</h4>
                        <p><?= $item->licensePlate ?></p>
                        <?php if($item->type == "Carro") { ?>
                        <img src="<?= base_url('./assets/img/car.svg')?>">
                        <?php } else if($item->type == "Moto") {?>
                            <img src="<?= base_url('./assets/img/motocycle.svg')?>">
                        <?php } ?>
                    </div>
                    
                    <div class="space2">
                        <div class="columns">
                            <div class="title">
                                <h4 class="details">Detalles</h4>
                                <div class="line"></div>
                            </div>

                            <div class="column1">
                                <p>Tipo:<span> <?= $item->type?></span> </p>
                            </div>

                            <div class="column2">
                                <p>Color:<span> <?= $item->color ?></span> </p>
                            </div>
                        </div>

                        <div  class="columns" >
                            <div class="title">
                                <h4>Entrada<img src="<?=base_url('./assets/img/login.svg') ?>"></h4>
                                <div class="line"></div>
                            </div>
                            <div class="column1">
                                <span><?= $item->date_Entrance ?></span>
                            </div>
                            <div class="column2">
                                <span><?= $item->time_Entrance ?></span>
                            </div>
                        </div>

                        <?php if(!$item->date_Finish == null){?>
                        <div  class="columns">
                            <div class="title">
                                <h4 class="finish">Salida<img  src="<?=base_url('./assets/img/logout.svg') ?>"></h4>
                                <div class="line"></div>
                            </div>
                            <div class="column1">
                                <span><?= $item->date_Finish ?></span>
                            </div>
                            <div  class="column2">
                                <span><?= $item->time_Finish ?></span>
                            </div>
                        </div>
                        <?php }else{ ?>
                            <div  class="columns">
                            <div class="title">
                                <h4 class="finish">Salida<img src="<?=base_url('./assets/img/logout.svg') ?>"></h4>
                                <div class="line"></div>
                            </div>
                                <div class="column1">
                                    <span>No registra salida</span>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php }else{ ?>
            <div class="card">
                <div class="columns">
					<p class="column1a">No hay registros por mostrar</p>
				</div>
            </div>
        <?php }?>
    </div>
    <?= $footer ?>

    <script src="<?= $script_url ?>"></script>
    <script>ajustarMargenes();</script>
</body>
</html>