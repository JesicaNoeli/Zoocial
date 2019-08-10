<?php


class Amigos extends EntidadBase
{
    private $mail_us;
    private $mail_amigo;


    public function __construct($adapter)
    {
        $table = "amigos";
        parent::__construct($table, $adapter);
    }

    public function setMailUsuario($mail_us)
    {
        $this->mail_us = $mail_us;
    }

    public function getMailAmigo()
    {
        return $this->mail_amigo;
    }

    public function setMailAmigo($mail_amigo)
    {
        $this->mail_amigo = $mail_amigo;
    }

    public function save()
    {
        $query = "INSERT INTO `amigos`(`mail_us`, `mail_amigo`) VALUES ('$this->mail_us','$this->mail_amigo')";
        $save = $this->db()->query($query);
        return $save;
    }

    public function delete($mail, $mail2)
    {
        $query = "DELETE FROM `amigos` WHERE `mail_amigo`= '$mail2' and `mail_us` = '$mail' || `mail_us`= '$mail2' and `mail_amigo` = '$mail';)";
        $delete = $this->db()->query($query);
        return $delete;
    }
}
?>