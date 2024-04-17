<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="<?= base_url('./assets/css/smartPark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?= base_url('./assets/css/graphs.css') ?>">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="<?= base_url('./assets/js/graphs.php') ?>"></script>
	<title>Estadísticas</title>
</head>
<body>
	<?= $navbar ?>
	<?php include('./assets/js/graphs.php'); ?>

	<div class="containerG">
		<div class="cardG cardE">
			<div class="div1">
				<div class="circle">
					<span><?= $cars?></span>
				</div>
				<img src="<?= base_url('./assets/img/carlogo.svg') ?>">
			</div>
			<div class="div2">
				<span>Carros</span>
			</div>
		</div>
		<div class="cardG cardV">
			<div class="div1 ">
				<div class="circle v">
					<span><?= $mot ?></span>
				</div>
				<img src="<?= base_url('./assets/img/motologo.svg') ?>">
			</div>
			<div class="div2 v">
				<span>Motos</span>
			</div>
		</div>
		<div class="cardG cardT">
			<div class="div1">
				<div class="circle t">
					<span><?= $total?></span>
				</div>
				<img src="<?= base_url('./assets/img/total.svg') ?>">
			</div>
			<div class="div2 t">
				<span>Total</span>
			</div>
		</div>

		<div class="grap">
			<div id="chart_div"></div>
			<div id="fech_div"></div>
		</div> 
	</div>
	
	<?= $footer ?>
</body>
</html>