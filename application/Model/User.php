<?php
namespace Mini\Model;
use Mini\Libs\Dbpdo;
use PDO;
class User extends Dbpdo
{
    public function checkRepeat($table, $campo1, $campo2)
    {

        $prepare = $this->db->prepare("SELECT $campo1 FROM $table WHERE $campo1 = :fields");
        $prepare->bindParam(":fields", $campo2, PDO::PARAM_STR);

        $prepare->execute();
        $check = $prepare->fetchall(PDO::FETCH_ASSOC);

        if($check){
            return true;
        } else{
            return false;
        }

    }


    public function checkRepeatPass($table, $campo1, $campo2, $campo3, $campo4)
    {

        $prepare = $this->db->prepare("SELECT $campo1 FROM $table WHERE $campo1 = :field AND $campo3 = :clave ");

        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);
        $prepare->bindParam(':clave', $campo4, PDO::PARAM_STR);

        $prepare->execute();

        $check = $prepare->fetchall(PDO::FETCH_ASSOC);

        if($check){
            return true;
        } else{
            return false;
        }

    }

    public function allFields($table, $campo1, $campo2)
    {
        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo1 = :field");
        $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);

        $prepare->execute();

        return $prepare->fetch(PDO::FETCH_ASSOC);

    }


}