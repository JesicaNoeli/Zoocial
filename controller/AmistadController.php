<?php


class AmistadController extends ControladorBase
{
    public $conectar;
    public $adapter;

    public function __construct()
    {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function buscarAmigo()
    {
        session_start();
        $user = new Usuario($this->adapter);
        $persona = $user->buscar($_POST["busqueda"]);
        if ($persona) {
           $this->view("personas", array("persona" => $persona));
        }else{
                echo "<script>alert('no hay resultados'); </script>";
            }
        $this->view("personas","");
        }

    public function eliminar(){
         $a=new Amigos($this->adapter);
         $a->delete($_SESSION['mail_us'],$_POST['mail']);
        echo "<script>alert('este usuario y tu ya no son amigos'); </script>";

    }

    public function solicitudAmistad(){
        session_start();
        if (isset($_POST['enviar'])){
            if($_POST['mail_us']== $_SESSION['mail_us']){
                echo "<script>alert('No puedes enviarte solicitud a ti mismo'); </script>";
                $this->view("personas","");
            }
        $soli=new Solicitud_ami($this->adapter);
        $enviada=$soli->getByMail($_POST['mail_us']);//ver si a este usuario ya le envie solictud
        $recibida=$soli->getOneBy("mail_envia",$_POST['mail_us']);//ver si este usuario ya me envio solcitud
        $amigo=new Amigos($this->adapter);
            $ami=new Amigos($this->adapter);
            $amistad=$ami->esAmigo($_SESSION['mail_us']);
            $amistad2=$ami->esAmigo2($_SESSION['mail_us']);
            if(!$enviada && !$recibida && !$amistad && !$amistad2){
        $soli->setMailEnvia($_SESSION["mail_us"]);
        $soli->setMailUs($_POST["mail_us"]);
       $soli->save();
       echo "<script>alert('Se envio la solicitud'); </script>";
            $this->view("personas","");
    }else{
            echo "<script>alert('Este usuario ya tiene una solicitud pendiente o ya es tu amigo'); </script>";
            $this->view("personas","");
        }

        }if (isset($_POST['cancelar'])) {
            $soli=new Solicitud_ami($this->adapter);
            $enviada=$soli->getByMail($_POST['mail_us']);
            if($enviada){
                $soli->cancel($_POST['mail_us']);
            echo "<script>alert('solicitud cancelada'); </script>";
                $this->view("personas","");
            }else{
                echo "<script>alert('No enviaste una solicitud a este usuario o ya es tu amigo'); </script>";
                $this->view("personas","");
            }
        }
        }



    public function gestionSolicitud(){
        session_start();
        if (isset($_POST['aceptar'])) {
           $amigo=new Amigos($this->adapter);
           $amigo->setMailAmigo($_POST['mail_envia']);
           $amigo->setMailUsuario($_SESSION['mail_us']);
           $amigo->save();
            $soli=new Solicitud_ami($this->adapter);
            $soli->delete($_POST['mail_envia']);
           $noti=new Notificaciones($this->adapter);
           $noti->setMailAmigo($_SESSION['mail_us']);
           $noti->setMailUs($_POST['mail_envia']);
           $desc= $_SESSION['username'].' '.'acepto tu solictud de amistad';
           $noti->setDescripcion($desc);
          $noti->setLeido(0) ;
          $noti->save();
            echo "<script>alert('tienes un nuevo amigo'); </script>";
            $this->view("personas","");
        } if (isset($_POST['rechazar'])) {
            $soli=new Solicitud_ami($this->adapter);
            $soli->delete($_POST['mail_envia']);
            echo "<script>alert('Rechazaste la solicitud'); </script>";
            $this->view("personas","");
        }
    }
}

