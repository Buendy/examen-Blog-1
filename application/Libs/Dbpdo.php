<?php
namespace Mini\Libs;
use Mini\Core\Database;
use PDO;

class Dbpdo
{
//  private $host = 'mysql';
//  private $user = 'default';
//  private $pass = 'secret';
//  private $dbname = 'alumno03';

  public $errors  = false;
  public $db;
  public $modeDEV = true;
  private $persistent = true;



  public function __construct()
  {
    $this->db = $this->connection();
  }


  private function connection()
  {
    try{
        $instance = Database::getInstance();
        $db = $instance->getDatabase();
        return $db;
    }catch (PDOException $e){
      $e->getLine();
      $e->getMessage();
      exit();
    }


  }


  public function all($table, $limit = 10)
  {
    $prepare = $this->db->prepare('SELECT * FROM ' . $table);
    $prepare->execute();


    return $prepare->fetchAll();
  }

  public function allWithId($table, $id)
  {

    $prepare = $this->db->prepare("SELECT * FROM $table WHERE id = :field");
    $prepare->bindParam(':field', $id, PDO::PARAM_STR);
    $prepare->execute();

    return $prepare->fetchAll();
  }

  public function checkRepeat($table, $campo, $campo2)
  {

    $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo = :field");
    $prepare->bindParam(':field', $campo2, PDO::PARAM_STR);

    $prepare->execute();

    $check = $prepare->fetchall(PDO::FETCH_ASSOC);

    if($check){
      return true;
    } else{
      return false;
    }

  }


    public function checkRepeatUpdate($table, $campo, $campo1, $idCategory)
    {


        $prepare = $this->db->prepare("SELECT * FROM $table WHERE $campo = :field");
        $prepare->bindParam(':field', $campo1, PDO::PARAM_STR);

        $prepare->execute();

        $check = $prepare->fetch(PDO::FETCH_ASSOC);

        $id = $check['id'];

        if ($prepare->rowCount()){
            if($id == $idCategory){
                return true;
            } else {
                return false;
            }
        }else {
            return true;
        }

    }

    public function delete($table, $id)
    {
        $prepare = $this->db->prepare("DELETE FROM $table WHERE id = :field");
        $prepare->bindParam(':field', $id, PDO::PARAM_STR);

        $prepare->execute();

    }





















}


 ?>
