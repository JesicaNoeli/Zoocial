<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <title>Iniciar sesion</title>
</head>
<body>
<table cellpadding="10" cellspacing="20" align="center">
    <tr align="center"><td><img src="assets/imagenes/zoocial_icon_grande.png" align="right"></td><td><h1 align="left" class="text-success display-3 font-weight-bold" >Zoocial</h1></td></tr>
    <tr><td colspan="2" ><p align="center" class="text-secondary">Una red social dedicada especialmente a la comunidad </p><p align="center" class="text-secondary"> amante de los animales.</p></td></tr>
    <tr><td colspan="2"><h3 class="text-dark" align="center">Inicia Sesion</h3></td></tr>
    <form action="<?php echo $helper->url("usuario","ingresar"); ?>" enctype="multipart/form-data" method="post">
        <tr><td colspan="2" class="table-warning"><input type="text" class="form-control" name="mail_us" placeholder="Correo electronico"  value="<?php if(isset($_POST['mail_us'])){echo $_POST['mail_us'];} ?>" required></td></tr>
        <tr><td colspan="2" class="table-warning"><input type="password" class="form-control" name="password" placeholder="Contraseña" pattern="[A-Za-z_-0-9]{1,20}" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>" required></td></tr>
        <tr><td colspan="2" class="table-warning" align="center"><button type="submit" name="login" class="btn btn-success">Entrar</button></td></tr>
    </form>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

<?php
