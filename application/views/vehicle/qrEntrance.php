<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/smartPark.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title><?= $license ?></title>
</head>
<body class="contB">
    <div class="contQr">
        <?php if (isset($qrCode)) : ?>
            <h4>SmartParking</h4>
            <img src="<?= base_url($qrCode)?>" alt="Código QR">
            <h4><?= $license ?></h4>
        <?php endif; ?>
    </div>
        <script>
            window.onload = function() {
                function printPage() {
                    window.print();
                }
                printPage();
                window.addEventListener('afterprint', function(event) {
                    window.location.href = '<?= base_url('vehicle/showVehicles')?>';
                });
            };
        </script>
</body>

</html>