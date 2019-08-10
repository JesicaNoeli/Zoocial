<?php
class Post extends EntidadBase
{
private $id_post;
private $foto;
private $titulo;
private $descripcion;
private $fecha;
private $mail_postea;
private $tag1;
    private $tag2;
    private $tag3;



    public function __construct($adapter) {
        $table="post";
        parent::__construct($table,$adapter);
    }

    public function getIdPost()
    {
        return $this->id_post;
    }

    public function setIdPost($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getMailPostea()
    {
        return $this->mail_postea;
    }

    public function setMailPostea($mail_postea)
    {
        $this->mail_postea = $mail_postea;
    }


    public function getTag1()
    {
        return $this->tag1;
    }


    public function setTag1($tag1)
    {
        $this->tag1 = $tag1;
    }

    /**
     * @return mixed
     */
    public function getTag2()
    {
        return $this->tag2;
    }

    /**
     * @param mixed $tag2
     */
    public function setTag2($tag2)
    {
        $this->tag2 = $tag2;
    }

    public function getTag3()
    {
        return $this->tag3;
    }


    public function setTag3($tag3)
    {
        $this->tag3 = $tag3;
    }


    public function save()
    {
        $query = "INSERT INTO `post`(`id_post`, `mail_postea`, `titulo`, `foto`, `descripcion`, `fecha`, `tag1`, `tag2`, `tag3`) VALUES (NULL ,'$this->mail_postea','$this->titulo','$this->foto','$this->descripcion','$this->fecha','$this->tag1','$this->tag2','$this->tag3')";
        $save = $this->db()->query($query);
        return $save;
    }

}
?>