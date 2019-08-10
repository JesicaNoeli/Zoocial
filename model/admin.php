<?php

class Admin
{
    private $mail_usuario;

    public
    function __construct($mail_usuario)
    {

        $this->$mail_usuario = $mail_usuario;
    }

    public function getMailUsuario()
    {
        return $this->mail_usuario;
    }

    public function setMailUsuario($mail_usuario)
    {
        $this->mail_usuario = $mail_usuario;
    }


}
?>
