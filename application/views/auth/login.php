<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/login.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title>SmartParking .:. Login</title>
</head>
<body>
    <div class="container">
        <div class="cont-1">
            <h1>Iniciar Sesion</h1>
            <div class="line"></div>
            <form action="<?= base_url('login/validation')?>" method="POST">
                <label>Identificación <br>
                    <input type="text" name="iden" placeholder="Ingrese su identificación" required>
                </label>
                <label>Contraseña <br>
                    <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
                </label>
                <div class="opc">
                    <a href="<?= base_url('register')?>">Registrarse</a>
                    <button type="submit">Ingresar</button>
                </div>
                
                <?php if ($mnsg = $this->session->flashdata('mnsg')): ?>
                    <div class="msgS">
                        <span><?= $mnsg ?></span>
                    </div>
                <?php endif; ?>
                <div class="msg">
                    <span><?= isset($msg) ? $msg : '' ?></span>
                    <span id="mensajeError"></span>
                </div>
            </form>
        </div>

        <div class="cont-2">
            <img src="<?= base_url('./assets/img/imgLogin.png')?>">
        </div>
    </div>
</body>
</html>