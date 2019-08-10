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

    <title>Perfil</title>
</head>
<body>
<br><br>
<table align="center" >
    <tr align="center"><td colspan="2" align="center"><img src="assets/imagenes/img_perfil/<?php echo $_SESSION['img_perfil']?>" style="width:200px; height:200px"></td></tr>
    <tr align="center"><th  colspan="2"><?php echo $_SESSION['username']?></th></tr>
    <tr align="center"><td colspan="2"> <small id="emailHelp" class="form-text text-muted"> <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']?> </small></td></tr>
    <tr align="center"><td colspan="2"><small id="emailHelp" class="form-text text-muted"> <?php echo "edad"." ",$u->edad($_SESSION['fec_nac'])?> </small></td></tr>
    <tr align="center"><td colspan="2"><small id="emailHelp" class="form-text text-muted">Miembro desde <?php echo date("d-m-Y", strtotime($_SESSION['fecha_alta']))?></small></td></tr>
<tr align="center"><td><a href="<?php echo $helper->url("usuario","editarPerfil"); ?>"><input type="button" name="editar" value="Editar perfil" class="btn-success btn-sm"></a></td></tr>
</table>
<br><br>
<form action="<?php echo $helper->url("post","publicar"); ?>" method="post" enctype="multipart/form-data">
<table align="center">
    <tr><th colspan="3">Hacer una publicacion</th></tr>
    <tr><td colspan="3"><input type="file" name="foto" accept="image/jpg, image/png, image/jpeg, image/gif"></td></tr>
    <tr><td colspan="3"><input type="text" name="titulo" placeholder="titulo" value="<?php if(isset($_POST['titulo'])){echo $_POST['titulo'];} ?>" style="width: 500px"></td></tr>
    <tr><td colspan="3"><textarea name="descripcion"  placeholder="¿Que quieres compartir?" style="width: 500px; height: 100px"></textarea></td></tr>
    <tr><td colspan="3"><small id="emailHelp" class="form-text text-muted">Añade hasta 3(tres) palabras claves para que tu publicacion sea facil de encontrar</small></td></tr>
    <tr><td><input type="text" placeholder="etiqueta 1" name="tag1" value="<?php if(isset($_POST['tag1'])){echo $_POST['tag1'];} ?>"></td><td><input type="text" placeholder="etiqueta 2" name="tag2" value="<?php if(isset($_POST['tag2'])){echo $_POST['tag2'];} ?>"></td><td><input type="text" placeholder="etiqueta 3" name="tag3" value="<?php if(isset($_POST['tag3'])){echo $_POST['tag3'];} ?>"></td></tr>
    <tr align="center"><td><button type="submit" name="postear" class="btn btn-success btn-sm" style="text-decoration: none">Publicar</button></td><td></td><td><button type="submit" name="cancelar" class="btn btn-danger btn-sm" style="text-decoration: none">Cancelar</button></td></tr>
</table>
    <br><br>
</form>
<?php if(isset($posteo)){
    $megusta=array();
    $nogusta=array();
    foreach($posteo as $pos) {?>
        <form method="post" action="<?php echo $helper->url("post","gestionPost"); ?>">
            <table align="center">
                <tr><td colspan="2"><?php echo $_SESSION['username']." el".$pos->fecha ." publico:" ?></td></tr>
                <tr><th colspan="2"><?php echo $pos->titulo ?></th><input type="text" name="mail_postea" value="<?php echo $_POST['mail_postea']=$pos->mail_postea ?>" readonly hidden></tr>
                <tr><td colspan="2"><img src="assets/imagenes/img_post/<?php echo $pos->foto ?>" style="width:400px; height:300px"></td></tr>
                <tr><td colspan="2"><?php echo $pos->descripcion ?></td><td><input type="text" name="id_post" value="<?php echo $_POST['id_post']=$pos->id_post ?>" readonly hidden></td></tr>
                <tr><td><button type="submit" name="megusta" class="btn btn-sm" value="Me gusta" title="Me gusta">
                            <?php if(isset($megus)){
                                foreach ($megus as $mg){
                                    if($mg->id_post==$pos->id_post){$megusta[]=$mg->reaccion;} }?>
                            <img src="assets/imagenes/gusta.png" ><?php if (sizeof($megusta)!=0){ echo '&nbsp&nbsp<span class="badge badge-danger">'.sizeof($megusta).'<span>'; }}?></button></td>

        <td><button type="submit" name="nomegusta" class="btn btn-sm" value="No me gusta" title="No me gusta">
                <?php if(isset($nogus)){
                foreach ($nogus as $ng){
                if($ng->id_post==$pos->id_post){$nogusta[]=$ng->reaccion; } }?>
                            <img src="assets/imagenes/no-gusta.png" ><?php if (sizeof($nogusta)!=0){echo '&nbsp&nbsp<span class="badge badge-danger">'.sizeof($nogusta).'<span>';} }?></button></td></tr></form>

        <tr><td><input type="text" name="mail_postea" value="<?php echo $_POST['mail_postea']=$pos->mail_postea ?>" readonly hidden></td><td><input type="text" name="id_post" value="<?php echo $_POST['id_post']=$pos->id_post ?>" readonly hidden></td></tr>
        <tr><td><input type="text" name="comentario" placeholder="deja tu comentario" value="<?php if(isset($_POST['comentario'])){echo $_POST['comentario'];} ?>"></td><td><button type="submit" name="comentar" class="btn btn-success btn-sm" style="text-decoration: none" >Comentar</button></td></tr>
<?php if(isset($comen)){
                foreach ($comen as $co){
                    if ($co->id_post==$pos->id_post){ ?>
            <tr><td colspan="2"><?php  echo $co->comentario; }?></td></tr>
                    <?php }} ?>
            </table><br><br>

    <?php }}?>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<footer style="text-align: center;" class="text-success" >
    <hr><p style="display: inline">Zoocial 2019</p>&nbsp&nbsp&nbsp<a href="<?php echo $helper->url("usuario","salir"); ?>" title="Cerrar Sesion"><img src="assets/imagenes/exit.jpg"></a>
</footer>
</body>
</html>