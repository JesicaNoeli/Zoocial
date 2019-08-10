<?php


class Solicitud_ami  extends EntidadBase
{
    private $mail_us;
    private $mail_envia;

    public function __construct($adapter)
    {
        $table = "solicitud_ami";
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

    public function getMailEnvia()
    {
        return $this->mail_envia;
    }

    public function setMailEnvia($mail_envia)
    {
        $this->mail_envia = $mail_envia;
    }

    public function save()
    {
        $query = "INSERT INTO `solicitud_ami`(`mail_us`, `mail_envia`) VALUES ('$this->mail_us','$this->mail_envia')";
        $save = $this->db()->query($query);
        return $save;
    }

    public function delete($mail)
    {
        $query = "DELETE FROM `solicitud_ami` WHERE `mail_envia`='$mail'";
        $delete = $this->db()->query($query);
        return $delete;
    }

    public function cancel($mail)
    {
        $query = "DELETE FROM `solicitud_ami` WHERE `mail_us`='$mail'";
        $cancel = $this->db()->query($query);
        return $cancel;
    }
}