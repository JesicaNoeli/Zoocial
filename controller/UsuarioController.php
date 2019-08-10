<?php
class UsuarioController extends ControladorBase
{
    public $conectar;
    public $adapter;

    public function __construct()
    {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }


    public function index()
    {
        session_start();
        if (isset($_SESSION["id"])) {
            $this->inicio();
        } else
            $this->registrarse();
    }

    public function perfil()
    {
        session_start();
       $this->cargarTodo();
        $post = new Post($this->adapter);
        $posteo = $post->getBy("mail_postea", $_SESSION['mail_us']);
        $this->redirect("post", "misPost");
         $this->view("perfil","");
    }

    public function perfilOtros()
    {
        $this->cargarTodo();
        $usuario=new Usuario($this->adapter);
        $us = $usuario->getAllBy("mail_us", $_POST["mail_amigo"]);
        $post = new Post($this->adapter);
        $posteo = $post->getBy("mail_postea", $_POST["mail_amigo"]);
        $r = new Reacciones($this->adapter);
        $megus = $r->getAllBy("reaccion", "le gusta");
        $nogus = $r->getAllBy("reaccion", "no le gusta");
        $c = new Comentarios($this->adapter);
        $comen = $c->getAll();
        $this->view("perfilotros", array("posteo" => $posteo, "megus" => $megus, "nogus" => $nogus, "comen" => $comen, "us"=>$us));

    }

    public function editarPerfil()
    {
        session_start();
        $this->cargarTodo();
        $this->view("editarPerfil", "");
    }

    public function personas()
    {
        session_start();
        $noti = new Notificaciones($this->adapter);
        $notis = $noti->getByMailColumn($_SESSION['mail_us'], "leido");
        $num_noti = sizeof($notis);
        $_SESSION['notis'] = $num_noti;
        $soli = new Solicitud_ami($this->adapter);
        $solis = $soli->getAllByMail($_SESSION['mail_us']);
        $num_soli = sizeof($solis);
        $ami=new Amigos($this->adapter);
        $amistad=$ami->esAmigo($_SESSION['mail_us']);
        $amistad2=$ami->esAmigo2($_SESSION['mail_us']);
        $_SESSION['solis'] = $num_soli;

        $this->view("personas", array("solis" => $solis, "amistad"=>$amistad, "amistad2"=>$amistad2 ));

    }

    public function registrarse()
    {
        $this->view("registroylogin", "");
    }

    public function crear()
    {

        $mail = isset($_POST['mail_us']) ? $_POST['mail_us'] : "";
        $pass = isset($_POST['password']) ? $_POST['password'] : "";
        $repass = isset($_POST['repassword']) ? $_POST['repassword'] : "";
        $fecnac = isset($_POST['fec_nac']) ? $_POST['fec_nac'] : "";
        $username = isset($_POST['username']) ? $_POST['username'] : "";

        if (strlen($pass) < 8) {
            echo "<script>alert('las contraseña debe tener al menos 8 caracteres'); </script>";
            $this->registrarse();
        } elseif ($pass != $repass) {
            echo "<script> alert('las contraseñas no coinciden'); </script>";
            $this->registrarse();
        } else {
            $usuario = new Usuario($this->adapter);
            $valMail = $usuario->getOneBy("mail_us", $mail);
            $edad = $usuario->edad($fecnac);
            if ($valMail) {
                echo "<script>alert('El mail ya se encuentra registrado'); </script>";
                $this->registrarse();
            } elseif ($edad < 18) {
                echo "<script>alert('Debe ser mayor de 18 para registrarse'); </script>";
                $this->registrarse();
            } else {
                $usuario->setUsername($_POST["username"]);
                $usuario->setPassword(md5($_POST["password"]));
                $usuario->setNombre($_POST["nombre"]);
                $usuario->setApellido($_POST["apellido"]);
                $usuario->setSexo($_POST["sexo"]);
                $usuario->setFecNac($_POST["fec_nac"]);
                $usuario->setMailUs($_POST["mail_us"]);
                date_default_timezone_set("UTC");
                $hoy = strftime("%Y-%m-%d", time());
                $usuario->setFechaAlta($hoy);
                $save = $usuario->save();
                if ($save) {
                    echo "<script>alert('Registro exitoso'); </script>";
                    $this->login();
                } else {
                    echo "<script>alert('no se pudo registrar'); </script>";
                    $this->registrarse();
                }
            }
        }
    }

    public function login()
    {
        $this->view("login", "");
    }


    public function editar()
    {
        session_start();
        if (isset($_POST['editar'])) {
            $usuario = new Usuario($this->adapter);
            $id = $_SESSION["id"];
            $foto = $_FILES['img_perfil'];
            //$fileName=$foto['name'];
            $tmpName = $foto['tmp_name'];
            $fileType = $foto['type'];
            if ($_POST['password'] == "" && $fileType == "") {
                $usuario->setUsername($_POST["username"]);
                $usuario->setNombre($_POST["nombre"]);
                $usuario->setApellido($_POST["apellido"]);
                $usuario->setSexo($_POST["sexo"]);
                $usuario->setFecNac($_POST["fec_nac"]);
                $usuario->setMailUs($_POST["mail_us"]);
                $usuario->update($id);
            }
            if ($fileType != "" && $fileType == "image/jpeg" && $_POST['password'] == "" || $fileType != "" && $fileType == "image/jpg" && $_POST['password'] == "" || $fileType != "" && $fileType == "image/png" && $_POST['password'] == "" || $fileType != "" && $fileType == "image/gif" && $_POST['password'] == "") {
                $imagen = $_SERVER['DOCUMENT_ROOT'] . "/Zoocial/assets/imagenes/img_perfil/";
                $extension = explode("/", $fileType);
                $name = $_SESSION['username'];
                $fileName = $name . '.' . $extension[1];
                $filePath = $imagen . $fileName;
                if ($result = move_uploaded_file($tmpName, $filePath)) {
                    $usuario->setImgPerfil($fileName);
                    $usuario->setUsername($_POST["username"]);
                    $usuario->setNombre($_POST["nombre"]);
                    $usuario->setApellido($_POST["apellido"]);
                    $usuario->setSexo($_POST["sexo"]);
                    $usuario->setFecNac($_POST["fec_nac"]);
                    $usuario->setMailUs($_POST["mail_us"]);
                    $usuario->updateImg($id);
                }

            }
            if ($_POST['password'] != "" && $fileType == "") {
                $usuario->setPassword(md5($_POST["password"]));
                $usuario->setUsername($_POST["username"]);
                $usuario->setNombre($_POST["nombre"]);
                $usuario->setApellido($_POST["apellido"]);
                $usuario->setSexo($_POST["sexo"]);
                $usuario->setFecNac($_POST["fec_nac"]);
                $usuario->setMailUs($_POST["mail_us"]);
                $usuario->updatePass($id);
            }
            if ($fileType != "" && $fileType == "image/jpeg" && $_POST['password'] != "" || $fileType != "" && $fileType == "image/jpg" && $_POST['password'] != "" || $fileType != "" && $fileType == "image/png" && $_POST['password'] != "" || $fileType != "" && $fileType == "image/gif" && $_POST['password'] != "") {
                $imagen = $_SERVER['DOCUMENT_ROOT'] . "/Zoocial/assets/imagenes/img_perfil/";
                $extension = explode("/", $fileType);
                $name = $_SESSION['username'];
                $fileName = $name . '.' . $extension[1];
                $filePath = $imagen . $fileName;
                if ($result = move_uploaded_file($tmpName, $filePath)) {
                    $usuario->setImgPerfil($fileName);
                    $usuario->setUsername($_POST["username"]);
                    $usuario->setNombre($_POST["nombre"]);
                    $usuario->setApellido($_POST["apellido"]);
                    $usuario->setSexo($_POST["sexo"]);
                    $usuario->setFecNac($_POST["fec_nac"]);
                    $usuario->setMailUs($_POST["mail_us"]);
                    $usuario->setPassword(md5($_POST["password"]));
                    $usuario->updateAll($id);
                }
            }

            $us = $usuario->getOneBy("mail_us", $_POST["mail_us"]);
            echo "<script>alert('datos editados'); </script>";
            $_SESSION['id'] = $us['id'];
            $_SESSION['username'] = $us['username'];
            $_SESSION['img_perfil'] = $us['img_perfil'];
            $_SESSION['mail_us'] = $us['mail_us'];
            $_SESSION['fec_nac'] = $us['fec_nac'];
            $_SESSION['fecha_alta'] = $us['fecha_alta'];
            $_SESSION['nombre'] = $us['nombre'];
            $_SESSION['apellido'] = $us['apellido'];
            $_SESSION['password'] = $us['password'];
            $_SESSION['sexo'] = $us['sexo'];
            $this->view("editarPerfil", "");
        } else {
            echo "<script>alert('no se guardaron los cambio'); </script>";
            $this->view("editarPerfil", "");
        }

    }


    public function ingresar()
    {
        $mail = $_POST['mail_us'];
        $pass = (md5($_POST["password"]));
        $usuario = new Usuario($this->adapter);
        $valMail = $usuario->getOneBy("mail_us", $mail);
        if (!$valMail) {
            echo "<script>alert('El mail ingresado no se encuentra registrado'); </script>";
            $this->login();
        } else {
            $valpass = $usuario->getBy2($mail, $pass, "mail_us", "password");
            if (!$valpass) {
                echo "<script>alert('La contraseña es incorrecta'); </script>";
                $this->login();
            } else {
                $us = $usuario->getOneBy("mail_us", $mail);
                echo "<script>alert('bienvenido'); </script>";
                session_start();
                $_SESSION['id'] = $us['id'];
                $_SESSION['username'] = $us['username'];
                $_SESSION['img_perfil'] = $us['img_perfil'];
                $_SESSION['mail_us'] = $us['mail_us'];
                $_SESSION['fec_nac'] = $us['fec_nac'];
                $_SESSION['fecha_alta'] = $us['fecha_alta'];
                $_SESSION['nombre'] = $us['nombre'];
                $_SESSION['apellido'] = $us['apellido'];
                $_SESSION['password'] = $us['password'];
                $_SESSION['sexo'] = $us['sexo'];
                $this->inicio();
                echo "paso inicio";

            }
        }
    }

    public function cargarTodo()
    {
        $noti = new Notificaciones($this->adapter);
        $notis = $noti->getByMailColumn($_SESSION['mail_us'], "leido");
        $num_noti = sizeof($notis);
        $_SESSION['notis'] = $num_noti;
        $soli = new Solicitud_ami($this->adapter);
        $solis = $soli->getAllByMail($_SESSION['mail_us']);
        $num_soli = sizeof($solis);
        $_SESSION['solis'] = $num_soli;

    }
    public function todosPost(){
        $post = new Post($this->adapter);
        $posteo = $post->allPost($_SESSION['mail_us']);
       // if ($posteo) {
            $r = new Reacciones($this->adapter);
            $megus = $r->getAllBy("reaccion", "le gusta");
            $nogus = $r->getAllBy("reaccion", "no le gusta");
            $c = new Comentarios($this->adapter);
            $comen = $c->getAll();
            $this->view("index", array("posteo" => $posteo, "megus" => $megus, "nogus" => $nogus, "comen" => $comen));
           //echo $posteo;
        }
   // }

    public function inicio()
    {
        $this->cargarTodo();
        $this->todosPost();
    }

    public function salir()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        $this->index();
    }
}
?>