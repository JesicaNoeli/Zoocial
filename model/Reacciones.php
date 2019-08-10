<?php

class Reacciones extends EntidadBase
{
    private $mail_reacciona;
    private $id_post;
    private $reaccion;

    public function __construct($adapter)
    {
        $table = "reacciones";
        parent::__construct($table, $adapter);
    }

    public function getMailReacciona()
    {
        return $this->mail_reacciona;
    }

    public function setMailReacciona($mail_reacciona)
    {
        $this->mail_reacciona = $mail_reacciona;
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getReaccion()
    {
        return $this->reaccion;
    }

    public function setReaccion($reaccion)
    {
        $this->reaccion = $reaccion;
    }

     public function save()
     {
         $query = "INSERT INTO `reacciones`(`mail_reacciona`, `id_post`, `reaccion`) VALUES ('$this->mail_reacciona','$this->id_post','$this->reaccion')";
         $save = $this->db()->query($query);
         return $save;
        }

}
?>
