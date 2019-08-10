<?php
ini_get('register_globals');
include 'view/cabezeraView.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <title>Encontrar Personas</title>
</head>
<body>
<br><br>
<?php if(isset($solis)){
foreach($solis as $s){
    $mail=$s->mail_envia;
$perso= new Usuario($this->adapter);
$pe=$perso->getByMail($mail)?>
<form action="<?php echo $helper->url("amistad","gestionSolicitud"); ?>" method="post">
<table>
    <tr><th colspan="2"><?php echo $pe->username." "."te envio una solcitud de amistad" ?></th></tr>
    <tr><td><img src="assets/imagenes/img_perfil/<?php echo $pe->img_perfil ?>" style="width:100px; height:100px"></td><td> <?php echo $pe->nombre." ".$pe->apellido; ?></td></tr>
    <tr><td><?php echo "edad"." ".$perso->edad($pe->fec_nac) ?></td><td><?php echo $pe->sexo ?></td></tr>
    <tr><td colspan="2"><input type="text" name="mail_envia" value="<?php echo $_POST['mail_envia']=$pe->mail_us ?>" readonly hidden></td></tr>
    <tr><td><button type="submit" name="aceptar" class="btn btn-success btn-sm" style="text-decoration: none">Aceptar</button></td><td><button type="submit" name="rechazar" class="btn btn-danger btn-sm" style="text-decoration: none">Rechazar</button></td></tr>
</table></form><br><br>
<?php }}?>
<table>
    <ul><h4>Mis Amigos</h4>
        <form action="<?php echo $helper->url("usuario","perfilOtros"); ?>" method="post" name="formu">
        <?php if(isset($amistad)){
            foreach($amistad as $a){
                $mail=$a->mail_us;
                $perso= new Usuario($this->adapter);
                $pe=$perso->getByMail($mail)?>
                <tr><td><li><input type="submit" value="<?php echo $pe->username ?>"></li></td><td><input type="text" name="mail_amigo" value="<?php echo $_POST['mail_amigo']=$mail ?>" readonly hidden></td></tr>
            <?php }}?>
        <?php if(isset($amistad2)){
            foreach($amistad2 as $a2){
                $mail=$a2->mail_amigo;
                $pers= new Usuario($this->adapter);
                $p=$pers->getByMail($mail)?>
                <tr><td><li><input type="submit" value="<?php echo $p->username ?>"></li></td><td><input type="text" name="mail_amigo" value="<?php echo $_POST['mail_amigo']=$mail ?>" readonly hidden ></td></tr>
            <?php }}?>
        </form>
    </ul>
</table>
<br><br>
<br><br>
<table align="center"><tr><td colspan="2"><h4 class="text-success">Encuentra a tus amigos</h4></td></tr><tr>
<td><form method="post" action="<?php echo $helper->url("amistad","buscarAmigo"); ?>">
        <input type="search" placeholder="Buscar" name="busqueda" class="form-control"  value="<?php if(isset($_POST['busqueda'])){echo $_POST['busqueda'];} ?>" required></td>
   <td> <button type="submit" name="buscar" class="form-control">
        <img src="assets/imagenes/buscar.png" height="30">
    </button>
</form></td></tr>
    <tr><td colspan="2> <small id="emailHelp" class="form-text text-muted"> Puedes buscar por usuario, nombre o apellido </small></td></tr>
</table>
<br><br>

<?php if(isset($persona)){
foreach($persona as $per){
$p= new Usuario($this->adapter);
if ($per->mail_us != $_SESSION{'mail_us'}){?>
    <form action="<?php echo $helper->url("amistad","solicitudAmistad"); ?>" method="post">
<table cellpadding="10" cellspacing="10" align="center" width="30%">
<tr>
  <td>
      <img src="assets/imagenes/img_perfil/<?php echo $per->img_perfil ?>" style="width:100px; height:100px"> </td><td><?php echo $per->username ?></td></tr>
      <tr><td> <?php echo $per->nombre." ".$per->apellido; ?></td><td><input type="text" name="mail_us" value="<?php echo $_POST['mail_us']=$per->mail_us ?>" readonly hidden></td></tr>
    <tr><td><?php echo "edad"." ".$p->edad($per->fec_nac) ?></td><td><?php echo $per->sexo ?></td></tr>
    <tr><td align="center"><button type="submit" name="enviar" class="btn btn-success btn-sm" style="text-decoration: none">Enviar Solicitud de Amistad</button><td align="center"><button type="submit" name="cancelar" class="btn btn-danger btn-sm" style="text-decoration: none">Cancelar Solicitud de Amistad</button></form></td></tr>
<?php }} }?>
</table>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<footer style="text-align: center;" class="text-success" >
    <hr><p style="display: inline">Zoocial 2019</p>&nbsp&nbsp&nbsp<a href="<?php echo $helper->url("usuario","salir"); ?>" title="Cerrar Sesion"><img src="assets/imagenes/exit.jpg"></a>
</footer>
</body>
</html>
