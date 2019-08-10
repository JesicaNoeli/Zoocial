<?php
class NotificacionesController extends ControladorBase
{
    public $conectar;
    public $adapter;

    public function __construct()
    {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function todas()
    {   session_start();
        $noti = new Notificaciones($this->adapter);
        $notis =$noti->getByMailColumn($_SESSION['mail_us'],"leido");
        $this->view("notificaciones",array("notis"=>$notis));

    }

    public function verNotificacion()
    {session_start();
        $noti= new Notificaciones($this->adapter);
        $post = new Post($this->adapter);
        if ($_POST['id_post'] != 0) {
            $po = $post->getBy("id_post",$_POST['id_post']);
            $noti->delete($_POST['id_noti']);
            $r=new Reacciones($this->adapter);
            $megus=$r->getAllBy("reaccion","le gusta");
            $nogus=$r->getAllBy("reaccion","no le gusta");
            $c=new Comentarios($this->adapter);
            $comen=$c->getAll();
            $notis =$noti->getByMailColumn($_SESSION['mail_us'],"leido");
            $num_noti = sizeof($notis);
            $_SESSION['notis'] = $num_noti;
            $soli= new Solicitud_ami($this->adapter);
            $solis=$soli->getAllByMail($_SESSION['mail_us']);
            $num_soli=sizeof($solis);
            $_SESSION['solis']=$num_soli;
            $this->view("notificacion", array("po" => $po, "megus"=>$megus, "nogus"=>$nogus, "comen"=>$comen));
        }else{
            $noti->delete($_POST['id_noti']);
            $notis =$noti->getByMailColumn($_SESSION['mail_us'],"leido");
            $num_noti = sizeof($notis);
            $_SESSION['notis'] = $num_noti;
            $soli= new Solicitud_ami($this->adapter);
            $solis=$soli->getAllByMail($_SESSION['mail_us']);
            $num_soli=sizeof($solis);
            $_SESSION['solis']=$num_soli;
        }

    }
}