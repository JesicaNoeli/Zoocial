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

    <title>Notificaciones</title>
</head>
<body>
<br><br>
<ul>
<form action="<?php echo $helper->url("notificaciones","verNotificacion"); ?>" method="post" name="formu">
    <?php if(isset($notis)) {
        foreach ($notis as $n){ ?>
            <li><input type="submit" value="<?php echo $n->descripcion ?>"><input type="text" name="id_post" value="<?php echo $_POST['id_post']=$n->id_post ?>" readonly hidden><input type="text" name="id_noti" value="<?php echo $_POST['id_noti']=$n->id_noti ?>" readonly hidden></li>
        <?php }
    }?>
</form>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<footer style="text-align: center;" class="text-success" >
    <hr><p style="display: inline">Zoocial 2019</p>&nbsp&nbsp&nbsp<a href="<?php echo $helper->url("usuario","salir"); ?>" title="Cerrar Sesion"><img src="assets/imagenes/exit.jpg"></a>
</footer>
</body>
</html>
