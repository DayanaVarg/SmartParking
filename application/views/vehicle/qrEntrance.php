<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $license ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; text-align: center; }
        .invoice-container {
            width: 60%; 
            margin: auto;
            padding: 20px;
            background: white; 
        }
        h1 { color: #333; font-size: 30px; }
        h2 { font-size: 25px; }
        p { font-size: 18px; }
        img {
            margin-top: 15px;
            width: 200px; 
        }
        .space {
            width: 150px;
            height: 150px;
        }


        @media print {
            body {
        width: 200mm;  
        height: 140mm;
    }
    .no-print {
        display: none; 
    }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
    <div class="space"></div>
        <h1>Smart Parking</h1>
        <p>Bogotá, Colombia<br>
           Teléfono: 2354125<br>
           Email: empresa@ejemplar.com<br>
           Sitio web: www.empresaEjemplar.com</p>
        <h2>Información Personal</h2>
        <p>Licencia: <?= $license ?><br>
           Tipo: <?= $type ?><br>
           Color: <?= $color ?></p>
        <h2>Código QR</h2>
        <img src="<?= base_url($qrCode) ?>" alt="Código QR">
        <p>Todos los derechos reservados a SmartParking 2024</p>
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
