<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 * Class BeastManager
 * @package Model
 */
class BeastManager extends AbstractManager
{

    /**
     *
     */
    const TABLE = 'beast';


    /**
     * BeastManager constructor.
     * @param \PDO $pdo
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectOneByIdwithMovieAndPlanet(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT b.id,b.name,b.size, b.area, m.title, p.name AS planet FROM beast b
            LEFT JOIN movie m ON b.id_movie = m.id
            LEFT JOIN planet p ON b.id_planet = p.id 
            WHERE b.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function editBeast(int $id)
    {
        //$movie=$_POST['movies'];
        $name=$_POST['name'];
        $area=$_POST['area'];
        $picure=$_POST['picture'];
        $size=$_POST['size'];
        //$idplanet=$_POST['planet'];
        
        $statement = $this->pdo->prepare("UPDATE beast 
            SET
            name = '$name',
            area = '$area',
            picture ='$picure',
            size = '$size'
            WHERE id = :id");
       $statement->bindValue('id', $id, \PDO::PARAM_INT);
       $statement->execute();
    }

    public function addBeast()
    {
        $movie=$_POST['movies'];
        $name=$_POST['name'];
        $area=$_POST['area'];
        $picture=$_POST['picture'];
        $size=$_POST['size'];
        $idplanet=$_POST['planet'];

        $statement=$this->pdo->prepare("INSERT INTO beast (name, picture, size, area, id_movie, id_planet) VALUES (:name, :picture, :size, :area, :movie, :idplanet)");

        $statement->bindValue('name', $name, \PDO::PARAM_STR);
        $statement->bindValue('picture', $picture, \PDO::PARAM_STR);
        $statement->bindValue('size', $size, \PDO::PARAM_INT);
        $statement->bindValue('area', $area, \PDO::PARAM_STR);
        $statement->bindValue('movie', $movie, \PDO::PARAM_INT);
        $statement->bindValue('idplanet', $idplanet, \PDO::PARAM_INT);
        $statement->execute();

    }
}
