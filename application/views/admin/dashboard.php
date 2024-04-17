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
    <title>Principal</title>
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
        <a href="<?= base_url('graphs')?>"><button class="btn">Estadísticas</button></a>
        </div>
        <div class="spaceBtn2">
            <a href="<?= base_url('vehicle/registerFin')?>"><button class="btn btnR">Registrar Salida</button></a>
            <a href="<?= base_url('vehicle/registerEn')?>"><button class="btn btnR">Registrar Entrada</button></a>
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
                                <span>DD/MM/YYYY</span>
                            </div>
                            <div  class="column2">
                                <span>HH/MM</span>
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