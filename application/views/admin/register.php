<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('./assets/css/register.css') ?>">
	<link rel="shortcut icon" href="<?= base_url('./assets/img/smartparking.png') ?>" type="image/x-icon">
    <title>SmartParking .:. Registrarse</title>
</head>
<body>
<div class="container">
        <div class="cont-2">
            <img src="<?= base_url('./assets/img/imgRegister.png')?>">
        </div>
        <div class="cont-1">
            <h1>Registrarse</h1>
            <div class="line"></div>
            <form action="<?= base_url('register/add')?>" method="POST" onsubmit="return comprobarCodigo()">
                <label>Identificación <br>
                    <input type="text" name="iden" placeholder="Ingrese su identificación" required>
                </label>
                <div class="group1">
                    <div class="part">
                        <label>Nombre/s <br>
                            <input type="text" name="name" placeholder="Ingrese su nombre" required>
                        </label>
                    </div>
                    <div  class="part">
                        <label>Apellido/s <br>
                            <input type="text" name="lastname" placeholder="Ingrese su apellido" required>
                        </label>
                    </div>
                </div>
                <div class="group1">
                    <div class="part">
                        <label>Celular<br>
                            <input type="text" name="phone" placeholder="Ingrese su celular" required>
                        </label>
                    </div>
                    <div  class="part">
                        <label>Correo<br>
                            <input type="email" name="email" placeholder="Ingrese su correo" required>
                        </label>
                    </div>
                </div>

                <div class="group1">
                    <div class="part">
                        <label>Contraseña<br>
                            <input type="password" name="pass" placeholder="Ingrese su contraseña"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos, una mayúscula, minúscula y números. Mínimo 8 caracteres" required>
                        </label>
                    </div>
                    <div  class="part">
                        <label>Código de acceso<br>
                            <input type="text" id="cod" placeholder="Ingrese código" required>
                        </label>
                    </div>
                </div>
                <div class="opc">
                    <a href="<?= base_url('login')?>">Iniciar Sesión</a>
                    <button type="submit">Registrarse</button>
                </div>
                <div class="msg">
                    <span><?= isset($msg) ? $msg : '' ?></span>
                    <span id="mensajeError"></span>
                </div>
               
            </form>
        </div>
    </div>
    <script src="<?= base_url('./assets/js/auth.js') ?>"></script>
</body>
</html>