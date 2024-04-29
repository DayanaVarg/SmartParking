<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/cod.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title><?= $license ?></title>
</head>
<body>
<div class="invoice-container">
    <div class="space"></div>
        <h1>Smart Parking</h1>
        <p>
            <span>NIT:</span> 111111113 <br>
            Bogotá, Colombia<br>
           <span>Teléfono:</span> 2354125<br>
           www.SmartParking.com
        </p>
        <div class="line"></div>
        <div class="space2"></div>
        <h2>Información Personal</h2>
        <div class="info">
            <p><span>Licencia:</span> <?= $license ?></p>
            <p><span>Tipo:</span> <?= $type ?></p>
            <p><span>Color:</span> <?= $color ?></p>
        </div>
        <div class="space2"></div>
        <div class="line"></div>
        <div>
        <img class="barcode" src="<?= base_url($barcodeImage); ?>" alt="Código de Barras">
        </div>
        <p class="cod"><?= $cod ?></p>
        <p class="info2">Todos los derechos reservados<br> a SmartParking 2024</p>
        
    </div>
<script>
        window.onload = function() {
            window.print();
            window.addEventListener('afterprint', function(event) {
                window.location.href = '<?= base_url('vehicle/showVehicles') ?>';
            });
        };
    </script> 



</body>
</html>
