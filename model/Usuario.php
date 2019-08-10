<?php
class Usuario extends EntidadBase
{
    private $id;
    private $username;
    private $mail_us;
    private $nombre;
    private $apellido;
    private $password;
    private $fec_nac;
    private $sexo;
    private $fecha_alta;
    private $img_perfil;


    public function __construct($adapter)
    {
        $table = "usuario";
        parent::__construct($table, $adapter);
    }


    public function getId()
    {
        return $this->id;
    }

    public function getImgPerfil()
    {
        return $this->img_perfil;
    }

    public function setImgPerfil($img_perfil)
    {
        $this->img_perfil = $img_perfil;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getMailUs()
    {
        return $this->mail_us;
    }

    public function setMailUs($mail_us)
    {
        $this->mail_us = $mail_us;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getFecNac()
    {
        return $this->fec_nac;
    }


    public function setFecNac($fec_nac)
    {
        $this->fec_nac = $fec_nac;
    }


    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }

    public function setFechaAlta($fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    function edad($fec_nacimiento)
    {
        $dia = date("d");
        $mes = date("m");
        $ano = date("Y");


        $dianac = date("d", strtotime($fec_nacimiento));
        $mesnac = date("m", strtotime($fec_nacimiento));
        $anonac = date("Y", strtotime($fec_nacimiento));

        if (($mesnac == $mes) && ($dianac > $dia)) {
            $ano = ($ano - 1);
        }

        if ($mesnac > $mes) {
            $ano = ($ano - 1);
        }

        $edad = ($ano - $anonac);

        return $edad;
    }

    public function save()
    {
        $query = "INSERT INTO `usuario`(`id`, `mail_us`, `username`, `password`, `nombre`, `apellido`, `fec_nac`, `sexo`, `fecha_alta`, `img_perfil`) VALUES (NULL ,'$this->mail_us','$this->username','$this->password','$this->nombre','$this->apellido','$this->fec_nac','$this->sexo','$this->fecha_alta','default_img.jpg')";
        $save = $this->db()->query($query);
        return $save;
    }

    public function updateImg($id)
    {
        $query = "UPDATE `usuario` SET `mail_us`='$this->mail_us',`username`='$this->username',`nombre`='$this->nombre',`apellido`='$this->apellido',`fec_nac`='$this->fec_nac',`sexo`='$this->sexo',`img_perfil`='$this->img_perfil' WHERE `id`= '$id';";
        $update = $this->db()->query($query);
        return $update;
    }
    public function updatePass($id){
        $query = "UPDATE `usuario` SET `password`= '$this->password',`mail_us`='$this->mail_us',`username`='$this->username',`nombre`='$this->nombre',`apellido`='$this->apellido',`fec_nac`='$this->fec_nac',`sexo`='$this->sexo' WHERE `id`= '$id';";
        $pass = $this->db()->query($query);
        return $pass;
    }

    public function updateAll($id)
    {
        $query = "UPDATE `usuario` SET `password`= '$this->password',`mail_us`='$this->mail_us',`username`='$this->username',`nombre`='$this->nombre',`apellido`='$this->apellido',`fec_nac`='$this->fec_nac',`sexo`='$this->sexo',`img_perfil`='$this->img_perfil' WHERE `id`= '$id';";
        $update = $this->db()->query($query);
        return $update;
    }

    public function update($id)
    {
        $query = "UPDATE `usuario` SET `mail_us`='$this->mail_us',`username`='$this->username',`nombre`='$this->nombre',`apellido`='$this->apellido',`fec_nac`='$this->fec_nac',`sexo`='$this->sexo' WHERE `id`= '$id';";
        $update = $this->db()->query($query);
        return $update;
    }
   public function select($mail_us){
       $query = "SELECT * FROM `usuario` WHERE `mail_us`=$mail_us";
       $select = $this->db()->query($query);
       return $select;
   }

}
?>