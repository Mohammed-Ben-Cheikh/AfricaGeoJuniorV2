<?php
require_once __DIR__ . '/../database/Database.php';
class Pays
{
    private $id_pays;
    private $nom;
    private $population;   
    private $langues_officielles;
    private $p_description;
    private $continent;
    private $img_pays;
    private $id_continent_fk;


    public function __construct($id_pays, $nom, $population, $langues_officielles, $p_description, $continent, $img_pays, $id_continent_fk)
    {
        $this->id_pays = $id_pays;
        $this->nom = $nom;
        $this->population = $population;
        $this->langues_officielles = $langues_officielles;
        $this->p_description = $p_description;
        $this->continent = $continent;
        $this->img_pays = $img_pays;
        $this->id_continent_fk = $id_continent_fk;
    }

    // Create - Ajouter un nouveau pays
    public function create()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "INSERT INTO pays (nom, population, langues_officielles, p_description, continent, img_pays, id_continent_fk) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $this->nom,
            $this->population,
            $this->langues_officielles,
            $this->p_description,
            $this->continent,
            $this->img_pays,
            $this->id_continent_fk
        ]);
        $database->disconnect();
        return $db->lastInsertId();
    }

    // Read - Obtenir tous les pays
    public static function getAll()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM pays";
        $stmt = $db->query($sql);
        $database->disconnect();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read - Obtenir un pays par son ID
    public static function getById($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM pays WHERE id_pays = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $database->disconnect();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update - Mettre à jour un pays
    public function update()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "UPDATE pays SET nom = ?, population = ?, langues_officielles = ?, 
                p_description = ?, continent = ?, img_pays = ?, id_continent_fk = ? 
                WHERE id_pays = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([
            $this->nom,
            $this->population,
            $this->langues_officielles,
            $this->p_description,
            $this->continent,
            $this->img_pays,
            $this->id_continent_fk,
            $this->id_pays
        ]);
        $database->disconnect();
        return $result;
    }

    // Delete - Supprimer un pays
    public static function delete($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "DELETE FROM pays WHERE id_pays = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$id]);
        $database->disconnect();
        return $result;
    }
}



