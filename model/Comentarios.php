<?php

class Comentarios extends EntidadBase
{
  private $id_comentario;
  private $mail_comenta;
  private $fecha;
  private $comentario;
  private $id_post;

    public function __construct($adapter)
    {
        $table = "comentarios";
        parent::__construct($table, $adapter);
    }


    public function getIdComentario()
    {
        return $this->id_comentario;
    }

    public function setIdComentario($id_comentario)
    {
        $this->id_comentario = $id_comentario;
    }

    public function getMailComenta()
    {
        return $this->mail_comenta;
    }

    public function setMailComenta($mail_comenta)
    {
        $this->mail_comenta = $mail_comenta;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }


    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function save()
    {
        $query = "INSERT INTO `comentarios`(`id_comentario`, `id_post`, `mail_comenta`, `comentario`, `fecha`) VALUES (NULL ,'$this->id_post','$this->mail_comenta','$this->comentario','$this->fecha')";
        $save = $this->db()->query($query);
        return $save;
    }
}
?>