<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('./assets/css/smartPark.css') ?>">
  <link rel="stylesheet" href="<?= base_url('./assets/css/navbar.css') ?>">
  <link rel="stylesheet" href="<?= base_url('./assets/css/footer.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
  <script src="<?= base_url('./assets/plugins/qrCode.min.js')?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Registrar Salida</title>
</head>
<body>
<?= $navbar ?>
<div class="cont"> 
<div class="btnA">
            <a href="<?= base_url('vehicle/showVehicles')?>"><button>Atrás</button></a>
        </div>
  <div class="row justify-content-center">
    <div class="col-sm-8 shadow p-4">
      <h5 class="text-center">Escanear codigo QR de entrada</h5>
        <div class="row text-center">
            <a id="btn-scan-qr" href="#">
            <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="img-fluid text-center" width="175">
            </a>
            <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
        </div>
        <div class="row mx-3 my-3">
            <button class="btnO mb-2" onclick="encenderCamara()">Registrar Salida</button>
            <button class="bntCa btnO" onclick="cerrarCamara()">Cancelar</button>
        </div>
    </div>
  </div>
</div> 
<?php if(isset($alerta)): ?>
    <script>
        Swal.fire({
            title: 'Error',
            text: '<?= $alerta['mensaje'] ?>',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            confirmButtonColor: '#8E98A8',
        }).then((result) => {
        if (result.isConfirmed) {
          var url = "<?= base_url('vehicle/registerFin')?>";
          window.location.href = url;
        }
        }); 
    </script>
<?php endif; ?>
  <?= $footer ?>
  <audio id="audioScaner" src="<?= base_url('./assets/sonido.mp3')?>"></audio>
  <?php include('./assets/js/script.php'); ?>
</body>
</html>