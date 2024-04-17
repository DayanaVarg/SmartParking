<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/qr.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title><?= $license ?></title>
</head>
<body>
<div class="invoice-container">
    <div class="space"></div>
        <h1>Smart Parking</h1>
        <p><span>NIT:</span> 111111113 <br>
            Bogotá, Colombia<br>
           <span>Teléfono:</span> 2354125<br>
           www.SmartParking.com
        </p>
        <div class="line"></div>
        <h2>Información Personal</h2>
        <p>
        <span>Licencia:</span><?= $license ?><br>
        <span>Tipo:</span> <?= $type ?><br>
        <span>Color:</span> <?= $color ?>
        </p>
        <div class="line"></div>
        <div>
        <h2>Código QR</h2>
        <img src="<?= base_url($qrCode) ?>" alt="Código QR">
        </div>
        <p>Todos los derechos reservados<br> a SmartParking 2024</p>
        <div class="space"></div>
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
