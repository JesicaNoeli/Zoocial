<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <title>Bienvenido a Zoocial</title>
  </head>
  <body>
  <table>
      <tr><td width="30px"></td>
  <td>
  <table cellpadding="10" cellspacing="20">
      <tr align="center"><td width="200px"><img src="assets/imagenes/zoocial_icon_grande.png" align="right"></td><td width="300px"><h1 align="left" class="text-success display-3 font-weight-bold" >Zoocial</h1></td></tr>
      <tr><td colspan="2" ><p align="center" class="text-secondary">Una red social dedicada especialmente a la comunidad </p><p align="center" class="text-secondary"> amante de los animales.</p></td></tr>
      <tr><td colspan="2"><h3 class="text-dark" align="center">Inicia Sesion</h3></td></tr>
      <form action="<?php echo $helper->url("usuario","ingresar"); ?>" enctype="multipart/form-data" method="post">
       <tr><td colspan="2" class="table-warning"><input type="text" class="form-control" name="mail_us" placeholder="Correo electronico"  value="<?php if(isset($_POST['mail_us'])){echo $_POST['mail_us'];} ?>" required></td></tr>
      <tr><td colspan="2" class="table-warning"><input type="password" class="form-control" name="password" placeholder="Contraseña" pattern="[A-Za-z_-0-9]{1,20}" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>" required></td></tr>
      <tr><td colspan="2" class="table-warning" align="center"><button type="submit" name="login" class="btn btn-success">Entrar</button></td></tr>
      </form>

  </table>
  </td><td width="40px"></td>
<td><h3 class="text-dark">Registrate</h3>
  <table class="table-success"  cellpadding="10">
  <form method="POST" action="<?php echo $helper->url("usuario","crear"); ?>">
      <tr><td><input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php if(isset($_POST['nombre'])){echo $_POST['nombre'];} ?>" required></td>
        <td><input type="text" name="apellido" class="form-control" placeholder="Apellido"  value="<?php if(isset($_POST['apellido'])){echo $_POST['apellido'];} ?>" required></td></tr>
      <tr><td colspan="2"><input type="text" name="username" class="form-control" placeholder="Usuario" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" required></td>
      <tr><td colspan="2"><input type="email" name="mail_us" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Ingresa tu correo electronico" value="<?php if(isset($_POST['mail_us'])){echo $_POST['mail_us'];} ?>" required>
          <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tu direccion de correo electronico con nadie.</small></td></tr>
        <tr><td colspan="2"><input type="password" name="password" class="form-control" id="inputPassword1" placeholder="Contraseña" pattern="[A-Za-z_-0-9]{1,20}" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>" required>
          <small id="passHelp" class="form-text text-muted">La contraseña debe contener al menos 8 (ocho) caracteres.</small></td></tr>
         <tr><td colspan="2"><input type="password" name="repassword" class="form-control" id="inputRePassword1" placeholder="Confirmar contraseña" pattern="[A-Za-z_-0-9]{1,20}" value="<?php if(isset($_POST['repassword'])){echo $_POST['repassword'];} ?>" required>
          <tr><td><label for="inputDate1" class="text-secondary">Fecha de nacimiento</label></td><td><input type="date" name="fec_nac" class="form-control" id="inputDate1" placeholder="Fecha de nacimiento"  value="<?php if(isset($_POST['fec_nac'])){echo $_POST['fec_nac'];} ?>" required></td></tr>

          <tr><td colspan="2"><table cellpadding="12">
              <tr><td><label for="sexo" class="text-secondary">Genero:</label></td><td><label for="hombre" class="text-secondary">Hombre</label></td>
                  <td><input type="radio" class="form-check" value="Hombre" id="hombre" name="sexo" checked <?php if(isset($_POST['sexo'])&&$_POST['sexo']=='Hombre' ){echo "checked";} ?>></td><td><label for="Mujer" class="text-secondary">Mujer</label></td>
                  <td><input type="radio" class="form-check" value="Mujer" id="mujer" name="sexo"<?php if(isset($_POST['sexo'])&&$_POST['sexo']=='Mujer' ){echo "checked";}?>></td><td><label for="Otro" class="text-secondary">Otro</label></td>
                  <td><input type="radio" class="form-check" value="Otro" id="Otro" name="sexo"<?php if(isset($_POST['sexo'])&&$_POST['sexo']=='Otro' ){echo "checked";}?>></td></tr>
          </table></td></tr>

            <tr><td colspan="2"> <div class="form-group form-check">
               <input type="checkbox" class="form-check-input" id="check1" required>
                <a class="form-check-label; text-secondary" for="check1" href="assets/html/terminos_y_condiciones.html" target="_blank">Acepto los terminos y condiciones</a></td></tr>
      <tr><td align="center" colspan="2"><button type="submit" class="btn btn-success" >Registrarme</button></td></tr>
  </form>

  </table></td></tr>
  </table>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>