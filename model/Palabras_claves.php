<?php
class Palabras_claves extends EntidadBase
{
    private $id_post;
    private $palabra1;
    private $palabra2;
    private $palabra3;

    public function __construct($adapter)
    {
        $table = "palabras_claves";
        parent::__construct($table, $adapter);
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getPalabra1()
    {
        return $this->palabra1;
    }

    public function setPalabra1($palabra1)
    {
        $this->palabra1 = $palabra1;
    }

    public function getPalabra2()
    {
        return $this->palabra2;
    }

    public function setPalabra2($palabra2)
    {
        $this->palabra2 = $palabra2;
    }

    public function getPalabra3()
    {
        return $this->palabra3;
    }

    public function setPalabra3($palabra3)
    {
        $this->palabra3 = $palabra3;
    }

    public function save()
    {
        $query = "INSERT INTO `palabras_claves`(`id_post`, `palabra_1`, `palabra_2`, `palabra_3`) VALUES ('$this->id_post','$this->palabra1', '$this->palabra2','$this->palabra3')";
          $save = $this->db()->query($query);
        return $save;
    }
}
?>