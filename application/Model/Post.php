<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/01/19
 * Time: 16:12
 */

namespace Mini\Model;
use Mini\Libs\Dbpdo;
use PDO;

class Post extends Dbpdo
{


    public function allWithCategory($limit = 10)
    {
        $prepare = $this->db->prepare('SELECT p.*, c.nombre FROM posts p INNER JOIN categorias c on p.categoria_id = c.id;');
        $prepare->execute();

        return $prepare->fetchAll();
    }


    public function insert($fields)
    {
        $prepare = $this->db->prepare("INSERT INTO posts(titulo, slug, resumen, contenido, categoria_id, palabras, privado, fecha)
                  VALUES(:titulo, :slug, :resumen, :contenido, :categoria_id, :palabras, :privado, CURRENT_TIME())");

        $prepare->bindParam(':titulo', $fields['titulo'], PDO::PARAM_STR);
        $prepare->bindParam(':slug', $fields['slug'], PDO::PARAM_STR);
        $prepare->bindParam(':resumen', $fields['resumen'], PDO::PARAM_STR);
        $prepare->bindParam(':contenido', $fields['contenido'], PDO::PARAM_STR);
        $prepare->bindParam(':categoria_id', $fields['categoria'], PDO::PARAM_STR);
        $prepare->bindParam(':palabras', $fields['palabras'], PDO::PARAM_STR);
        $prepare->bindParam(':privado', $fields['privado'], PDO::PARAM_STR);
        d($prepare);
        $prepare->execute();
    }

    public function update($table, $data)
    {

        if(isset($table) || isset($data)){


            $prepare = $this->db->prepare("UPDATE $table SET titulo=:titulo, slug=:slug, resumen=:resumen, contenido=:contenido,
                      categoria_id=:categoria_id, palabras=:palabras, privado=:privado WHERE id = :id");

            $prepare->bindParam(':titulo', $data['titulo'], PDO::PARAM_STR);
            $prepare->bindParam(':slug', $data['slug'], PDO::PARAM_STR);
            $prepare->bindParam(':resumen', $data['resumen'], PDO::PARAM_STR);
            $prepare->bindParam(':contenido', $data['contenido'], PDO::PARAM_STR);
            $prepare->bindParam(':categoria_id', $data['categoria'], PDO::PARAM_STR);
            $prepare->bindParam(':palabras', $data['palabras'], PDO::PARAM_STR);
            $prepare->bindParam(':privado', $data['privado'], PDO::PARAM_STR);
            $prepare->bindParam(':id', $data['id'], PDO::PARAM_STR);

            $prepare->execute();


        }else {
            throw new Exception('A ocurrido un error con la base de datos');
        }


    }

    public function search($palabra)
    {
        $palabra = "%$palabra%";

        $prepare = $this->db->prepare("SELECT p.*, c.nombre FROM posts p INNER JOIN categorias c on p.categoria_id = c.id WHERE p.palabras LIKE :palabra");
        $prepare->bindParam(':palabra', $palabra, PDO::PARAM_STR);
        $prepare->execute();

        if($prepare->rowCount()){
            return $prepare->fetchAll();
        }else{
            return null;
        }


    }


}