<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;
    public function __construct($table, $adapter) {
        $this->table=(string) $table;

        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();

        $this->conectar = null;
        $this->db = $adapter;
    }

    public function getConetar(){
        return $this->conectar;
    }

    public function db(){
        return $this->db;
    }

    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table;");
        while ($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id='$id';");
        if($row = $query->fetch_object()) {
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getByMail($mail_us){
        $query=$this->db->query("SELECT * FROM $this->table WHERE mail_us='$mail_us';");
        if($row = $query->fetch_object()) {
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
      public function getByMailColumn($mail_us,$column){
        $query=$this->db->query("SELECT * FROM $this->table WHERE mail_us='$mail_us' AND '$column' = 0;");
          while($row = $query->fetch_object()) {
              $resultSet[]=$row;
          }
          $resultSet=isset($resultSet)?$resultSet:NULL;
          return $resultSet;
      }
        public function getAllByMail($mail_us){
        $query=$this->db->query("SELECT * FROM $this->table WHERE mail_us='$mail_us';");
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value';");

        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }
        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

         public function getByTable($table,$column,$value){
        $query=$this->db->query("SELECT * FROM $table WHERE $column=$value");

        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getAllBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value';");
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getOneBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value';");

        if($row = $query->fetch_assoc()) {
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    public function getUser($column,$value){
        $query=$this->db->query("SELECT `username` FROM $this->table WHERE '$column'='$value';");

        if($row = $query->fetch_assoc()) {
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function getValue($column,$table,$column,$value){
        $query=$this->db->query("SELECT $column FROM $table WHERE $column='$value';");

        if($row = $query->fetch_assoc()) {
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }
    public function get3($column,$value){
        $query=$this->db->query("SELECT `mail_postea` FROM $this->table WHERE $column='$value';");

        if($row = $query->fetch_assoc()) {
            $resultSet=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }



    public function getBy2($value,$value2,$column,$column2){
         $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value' AND $column2='$value2'");
          if($row = $query->fetch_assoc()) {
              $resultSet = $row;
          }
         $resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;
     }

    public function buscar($value){
        $query=$this->db->query("SELECT * FROM `usuario` WHERE `username` LIKE  '$value' OR `nombre` LIKE '$value' OR `apellido` LIKE '$value';");
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function buscarP($mail,$value){
        $query=$this->db->query("SELECT * FROM post p, amigos a WHERE p.mail_postea = a.mail_amigo and a.mail_us='$mail' and `tag3` like '$value'or  p.mail_postea = a.mail_amigo and a.mail_us='$mail' and `tag2` like '$value'or  p.mail_postea = a.mail_amigo and a.mail_us='$mail' and `tag1` like '$value' or p.mail_postea = a.mail_us and a.mail_amigo='$mail' and `tag1`like '$value' or p.mail_postea = a.mail_us and a.mail_amigo='$mail' and `tag2`like '$value' or p.mail_postea = a.mail_us and a.mail_amigo='$mail' and `tag3`like '$value';");
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function esAmigo($mail){
        $query=$this->db->query("SELECT `mail_us` FROM `amigos` WHERE `mail_amigo`= '$mail';");
            while($row = $query->fetch_object()) {
                $resultSet[]=$row;
            }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function esAmigo2($mail){
        $query=$this->db->query("SELECT `mail_amigo` FROM `amigos` WHERE `mail_us`= '$mail';");
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

    public function allPost($mail){
        $query=$this->db->query("SELECT * FROM post p, amigos a WHERE p.mail_postea = a.mail_amigo and a.mail_us='$mail'or p.mail_postea = a.mail_us and a.mail_amigo='$mail';");
        while($row = $query->fetch_object()) {
            $resultSet[]=$row;
        }

        $resultSet=isset($resultSet)?$resultSet:NULL;
        return $resultSet;
    }

     public function obtenerIdR($value,$value2){
         $query=$this->db->query("SELECT `reaccion` FROM $this->table WHERE `id_post`='$value' AND `reaccion`='$value2';");

         while($row = $query->fetch_object()) {
             $resultSet[]=$row;
         }

         $resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;
     }
     public function getBySub($column,$value,$column2,$id){
         $query=$this->db->query("SELECT * FROM `amigos` WHERE $column='$value' and $column2= (SELECT `mail_postea`FROM `post`WHERE `id_post`= '$id');");
         while($row = $query->fetch_object()) {
             $resultSet[]=$row;
         }

         $resultSet=isset($resultSet)?$resultSet:NULL;
         return $resultSet;
     }

}
?>

