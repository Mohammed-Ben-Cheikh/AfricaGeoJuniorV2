<?php
require_once __DIR__ . '/../database/Database.php';
class continents
{
    private $id_continent;
    private $nom;
    private $c_description;
    private $img_continent;

    public function __construct($id_continent, $nom, $c_description, $img_continent)
    {
        $this->id_continent = $id_continent;
        $this->nom = $nom;
        $this->c_description = $c_description;
        $this->img_continent = $img_continent;
    }

    // Create - Ajouter un nouveau continent
    public function create()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "INSERT INTO continents (nom, c_description, img_continent) 
                VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $this->nom,
            $this->c_description,
            $this->img_continent
        ]);
        $database->disconnect();
        return $db->lastInsertId();
    }

    // Read - Obtenir tous les continents
    public static function getAll()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM continents";
        $stmt = $db->query($sql);
        $database->disconnect();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read - Obtenir un continent par son ID
    public static function getById($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM continents WHERE id_continent = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $database->disconnect();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update - Mettre à jour un continent
    public function update()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "UPDATE continents SET nom = ?, c_description = ?, img_continent = ? 
                WHERE id_continent = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([
            $this->nom,
            $this->c_description,
            $this->img_continent,
            $this->id_continent
        ]);
        $database->disconnect();
        return $result;
    }

    // Delete - Supprimer un continent
    public static function delete($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "DELETE FROM continents WHERE id_continent = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$id]);
        $database->disconnect();
        return $result;
    }
}



