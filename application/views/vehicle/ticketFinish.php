<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/fact.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title>Factura <?= $licensePlate ?></title>
</head>
<body>
<div class="invoice-container">
    <?php if($vehi){ ?>
        <?php foreach($vehi as $item): ?>
        <div class="space"></div>
        <h1>Smart Parking</h1>
        <p>
            <span>NIT:</span> 111111113 <br>
            Bogotá, Colombia<br>
            <span>Teléfono:</span> 2354125<br>
            www.SmartParking.com
        </p>
        <div class="line"></div>
        <h2>Información Personal</h2>
        <div class="info">
            <p><span>Licencia:</span> <?=$item->licensePlate?></p>
            <p><span>Tipo:</span> <?=$item->type?></p>
            <p><span>Color:</span> <?=$item->color?></p>
            <div class="columns">
                <div class="column1"><p><span>Entrada: </span><?= str_replace('-', '/', $item->date_Entrance) ?></p></div>
                <div class="column2"><p><span>Hora: </span><?=$item->time_Entrance?></p></div>
            </div>
            <div class="columns">
                <div class="column1"><p><span>Salida: </span><?= str_replace('-', '/', $item->date_Finish)?></p></div>
                <div class="column2"><p><span>Hora: </span><?=$item->time_Finish?></p></div>
            </div>
            
        </div>
        <div class="line"></div>
        <div>
            <div class="columns c2">
                <div class="column1 C1"><p><span>Descripcion</span></p></div>
                <div class="column2"><p><span>P.Total</span></p></div>
            </div>
        </div>
        <div class="line li2"></div>
        <div class="columns">
                <div class="column1 C1"><p>SubTotal</p></div>
                <div class="column2"><p>$<?= $subtotal?></p></div>
        </div>
        <div class="columns">
            <div class="column1 C1"><p>IVA 19%</p></div>
            <div class="column2"><p>$<?= $IVA?></p></div>
        </div>
        <div class="line li2"></div>
        <div class="columns">
            <div class="column1 C1"><p>Total</p></div>
            <div class="column2"><p>$<?= $item->totalCost?></p></div>
        </div>
        <div class="line l1"></div>
        <p class="C1">Todos los derechos reservados<br> a SmartParking 2024</p>
        <p class="C1">Gracias por preferirnos</p>
        <div class="space"></div>
        <?php endforeach ?>
    <?php } ?>
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
