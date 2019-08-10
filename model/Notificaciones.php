<?php


class Notificaciones extends EntidadBase
{
    private $mail_us;
    private $id_post;
    private $mail_amigo;
    private $descripcion;
     private $leido;

    public function __construct($adapter)
    {
        $table = "notificaciones";
        parent::__construct($table, $adapter);
    }

    public function getMailUs()
    {
        return $this->mail_us;
    }

    public function setMailUs($mail_us)
    {
        $this->mail_us = $mail_us;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getMailAmigo()
    {
        return $this->mail_amigo;
    }

    public function setMailAmigo($mail_amigo)
    {
        $this->mail_amigo = $mail_amigo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getLeido()
    {
        return $this->leido;
    }

    public function setLeido($leido)
    {
        $this->leido = $leido;
    }

    public function save()
    {
        $query = "INSERT INTO `notificaciones`(`mail_us`,`id_post`, `mail_amigo`, `descripcion`,`leido`) VALUES ('$this->mail_us','$this->id_post','$this->mail_amigo','$this->descripcion','$this->leido')";
        $save = $this->db()->query($query);
        return $save;
}
    public function update($id){
        $query = "UPDATE `notificaciones` SET `leido`='$this->leido' WHERE `id_noti`= '$id';";
        $update = $this->db()->query($query);
        return $update;
    }
    public function delete($id){
        $query ="DELETE FROM `notificaciones` WHERE `id_noti`= '$id';";
        $delete = $this->db()->query($query);
        return $delete;
    }

}