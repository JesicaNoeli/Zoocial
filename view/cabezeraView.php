<?php
ini_get('register_globals');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

    <title>Zoocial</title>
</head>
<body>

<table bgcolor="#ffe4c4" style="border-collapse: collapse" width="100%">
    <tr><td>
            <table cellpadding="10" cellspacing="20">
                <tr align="center"><td width="100px"><img src="assets/imagenes/zoocial_icon.png" align="right"></td><td width="700px"><a href="<?php echo $helper->url("usuario","index"); ?>" title="Inicio" style="text-decoration: none"><h1 align="left" class="text-success display-4 font-weight-bold" >Zoocial</h1></a></td></tr>
            </table>
        </td>
        <td align="center"><a href="<?php echo $helper->url("usuario","personas"); ?>" title="Buscar Personas"><img src="assets/imagenes/boy.png"><?php if($_SESSION['solis']!=0){echo '&nbsp&nbsp<span class="badge badge-danger">'.$_SESSION['solis'].'<span>'; }?></a></td>
        <td align="center"><a href="<?php echo $helper->url("post","posteos"); ?>" title="Buscar Posts"><img src="assets/imagenes/deseado.png"></a></td>
         <td>
             <a class="nav-link" href="<?php echo $helper->url("notificaciones","todas"); ?>" title="Notificaciones"><img src="assets/imagenes/notis.png"><?php if($_SESSION['notis']!=0){echo '&nbsp&nbsp<span class="badge badge-danger">'.$_SESSION['notis'].'<span>'; }?></a>
            </td>
        <td align="center"> <a href="<?php echo $helper->url("usuario","perfil"); ?>" class="nav-link text-success font-weight-bolder" title="Perfil"><?php echo $_SESSION['username']?><img src="assets/imagenes/img_perfil/<?php echo $_SESSION['img_perfil']?>" style="border-radius:50%; width:70px; height:70px;"></a></td>
    </tr>
</table>
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>