<?php
ini_get('register_globals');
include 'view/cabezeraView.php';
$u=new Usuario($this->adapter);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <title>Editar Perfil</title>
</head>
<body>
<br><br>
<table>
<form method="post" enctype="multipart/form-data" action="<?php echo $helper->url("usuario","editar"); ?>">
    <tr><td><label for="username">Nombre de Usuario</label></td><td><input type="text" name="username" value="<?php echo $_SESSION['username']?>"></td></tr>
    <tr><td><label for="nombre">Nombre</label></td><td><input type="text" name="nombre" value="<?php echo $_SESSION['nombre']?>"></td></tr>
    <tr><td><label for="apellido">Apellido</label></td><td><input type="text" name="apellido" value="<?php echo $_SESSION['apellido']?>"></td></tr>
    <tr><td><label for="mail_us">Email</label></td><td><input type="text" name="mail_us" value="<?php echo $_SESSION['mail_us']?>"></td></tr>
    <tr><td><label for="password">Contraseña</label></td><td><input type="password" name="password" ></td></tr>
    <tr><td><label for="sexo">Genero</label></td><td><input type="text" name="sexo" value="<?php echo $_SESSION['sexo']?>"></td></tr>
    <tr><td><label for="fec_nac">Fecha Nacimiento</label></td><td><input type="text" name="fec_nac" value="<?php echo $_SESSION['fec_nac']?>"></td></tr>
    <tr><td><img src="assets/imagenes/img_perfil/<?php echo $_SESSION['img_perfil']?>" style="width:100px; height:100px"></td><td><input type="file" name="img_perfil" accept="image/jpg, image/png, image/jpeg, image/gif"></td></tr>
    <tr><td></td></tr>
    <tr align="center"><td><button class="btn-sm btn-success" type="submit" name="editar" value="editar">Editar</button></td><td><button class="btn-sm btn-danger" type="submit" name="cancelar" value="cancelar">Cancelar</button></td></tr>

</form>
</table>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<footer style="text-align: center;" class="text-success" >
    <hr><p style="display: inline">Zoocial 2019</p>&nbsp&nbsp&nbsp<a href="<?php echo $helper->url("usuario","salir"); ?>" title="Cerrar Sesion"><img src="assets/imagenes/exit.jpg"></a>
</footer>
</body>
</html>