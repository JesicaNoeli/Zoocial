<?php
class PostController extends ControladorBase
{
    public $conectar;
    public $adapter;

    public function __construct()
    {
        parent::__construct();

        $this->conectar = new Conectar();
        $this->adapter = $this->conectar->conexion();
    }

    public function posteos()
    {
        session_start();
        $noti = new Notificaciones($this->adapter);
        $notis = $noti->getByMailColumn($_SESSION['mail_us'], "leido");
        $num_noti = sizeof($notis);
        $_SESSION['notis'] = $num_noti;
        $soli = new Solicitud_ami($this->adapter);
        $solis = $soli->getAllByMail($_SESSION['mail_us']);
        $num_soli = sizeof($solis);
        $_SESSION['solis'] = $num_soli;
        $this->view("post", "");
    }

    public function verPosts()
    {
        session_start();
        $post = new Post($this->adapter);
        $busqueda = $_POST['busqueda'];
        $posteo = $post->buscarP($_SESSION['mail_us'], $busqueda);
        if ($posteo) {
            $r = new Reacciones($this->adapter);
            $megus = $r->getAllBy("reaccion", "le gusta");
            $nogus = $r->getAllBy("reaccion", "no le gusta");
            $c = new Comentarios($this->adapter);
            $comen = $c->getAll();
            $this->view("post", array("posteo" => $posteo, "megus" => $megus, "nogus" => $nogus, "comen" => $comen));
        } else {
            echo "<script>alert('no hay resultados'); </script>";
            $this->view("post", "");
        }
    }



    public function publicar()
    {
        session_start();
        if (isset($_POST['postear'])) {
            $id = $_SESSION['id'];
            $mail = $_SESSION["mail_us"];
            $post = new Post($this->adapter);
            $post->setDescripcion($_POST["descripcion"]);
            date_default_timezone_set("UTC");
            $hoy = strftime("%Y-%m-%d", time());
            $post->setFecha($hoy);
            $post->setTitulo($_POST["titulo"]);
            $post->setMailPostea($mail);
            $post->setTag1($_POST["tag1"]);
            $post->setTag2($_POST["tag2"]);
            $post->setTag3($_POST["tag3"]);
            $foto = $_FILES['foto'];
            //$fileName=$foto['name'];
            $tmpName = $foto['tmp_name'];
            $fileType = $foto['type'];
            if ($fileType == "image/jpeg" || $fileType == "image/jpg" || $fileType == "image/png" || $fileType == "image/gif") {
                $imagen = $_SERVER['DOCUMENT_ROOT'] . "/Zoocial/assets/imagenes/img_post/";
                $extension = explode("/", $fileType);
                $name = preg_replace("/[[:space:]]/", "", trim($_POST['titulo']));
                $fileName = $name . '.' . $extension[1];
                $filePath = $imagen . $fileName;
                if ($result = move_uploaded_file($tmpName, $filePath)) {
                    $post->setFoto($fileName);
                    $post->save();
                    $this->misPost();
                } else {
                    echo "<script>alert('no se pudo cargar la imagen'); </script>";
                    $this->misPost();
                }
            } else {
                echo "<script>alert('tipo de imagen no permitida'); </script>";
                $this->misPost();
            }
        }
        if (isset($_POST['cancelar'])) {
            $this->misPost();
        }
    }

    public function misPost()
    {
        session_start();
        $post = new Post($this->adapter);
        $posteo = $post->getBy("mail_postea", $_SESSION['mail_us']);
        $r = new Reacciones($this->adapter);
        $megus = $r->getAllBy("reaccion", "le gusta");
        $nogus = $r->getAllBy("reaccion", "no le gusta");
        $c = new Comentarios($this->adapter);
        $comen = $c->getAll();
        $this->view("perfil", array("posteo" => $posteo, "megus" => $megus, "nogus" => $nogus, "comen" => $comen));

    }

    public function otrosPost()
    {
        session_start();
        $post = new Post($this->adapter);
        $posteo = $post->getBy("mail_postea", $_SESSION['mail_amigo']);
        $r = new Reacciones($this->adapter);
        $megus = $r->getAllBy("reaccion", "le gusta");
        $nogus = $r->getAllBy("reaccion", "no le gusta");
        $c = new Comentarios($this->adapter);
        $comen = $c->getAll();
        $this->view("perfilotros", array("posteo" => $posteo, "megus" => $megus, "nogus" => $nogus, "comen" => $comen));

    }

    public function gestionPost()
    {
        if (isset($_POST['comentar'])) {
            $this->comentar();
        } else {
            $this->reaccionar();
        }
    }

    public function comentar()
    {
        session_start();
        $com = new Comentarios($this->adapter);
        $mail_com = $_SESSION["mail_us"];
        date_default_timezone_set("UTC");
        $hoy = strftime("%Y-%m-%d", time());
        $com->setFecha($hoy);
        $id_post = $_POST['id_post'];
        $com->setIdPost($id_post);
        $com->setComentario($_POST["comentario"]);
        $com->setMailComenta($mail_com);
        $com->save();
        $noti = new Notificaciones($this->adapter);
        $noti->setMailAmigo($mail_com);
        $noti->setMailUs($_POST['mail_postea']);
        $noti->setIdPost($_POST['id_post']);
        $descripcion = $_SESSION['username'] . ' ' . 'comento' . ' ' . 'tu' . ' ' . 'post';
        $noti->setDescripcion($descripcion);
        $noti->setLeido(0);
        $noti->save();
        $this->misPost();

    }

    public function reaccionar()
    {
        session_start();
        if (isset($_POST['megusta'])) {
            $reac = new Reacciones($this->adapter);
            $mail_reac = $_SESSION["mail_us"];
            $id_post = $_POST['id_post'];
            $reac->setIdPost($id_post);
            $reac->setMailReacciona($mail_reac);
            $reac->setReaccion("le gusta");
            $reac->save();
            $mg = $reac->obtenerIdR($_POST['id_post'], "le gusta");
            $num_mg = sizeof($mg);
            $noti = new Notificaciones($this->adapter);
            $noti->setMailAmigo($_SESSION["mail_us"]);
            $noti->setMailUs($_POST['mail_postea']);
            $descripcion = 'a ' . $_SESSION['username'] . ' le gusta tu post';
            $noti->setDescripcion($descripcion);
            $noti->setLeido(0);
            $noti->setIdPost($id_post);
            $noti->save();
            $this->misPost();
        }
        if (isset($_POST['nomegusta'])) {
            $reac = new Reacciones($this->adapter);
            $post = new Post($this->adapter);
            $posteo = $post->getBy("mail_postea", $_SESSION['mail_us']);
            $mail_reac = $_SESSION["mail_us"];
            $id_post = $_POST['id_post'];
            $reac->setIdPost($id_post);
            $reac->setMailReacciona($mail_reac);
            $reac->setReaccion("no le gusta");
            $reac->save();
            $noti = new Notificaciones($this->adapter);
            $noti->setMailAmigo($_SESSION["mail_us"]);
            $noti->setMailUs($_POST['mail_postea']);
            $descripcion = 'a ' . $_SESSION['username'] . ' no le gusta tu post';
            $noti->setDescripcion($descripcion);
            $noti->setIdPost($id_post);
            $noti->setLeido(0);
            $noti->save();
            $this->misPost();
        }
    }
}

?>