<?php
require_once __DIR__ . '/../database/Database.php';

class villes
{
    private $id_ville;
    private $nom;
    private $v_description;
    private $type;
    private $img_ville;
    private $id_pays_fk;

    public function __construct($id_ville, $nom, $v_description, $type, $img_ville, $id_pays_fk)
    {
        $this->id_ville = $id_ville;
        $this->nom = $nom;
        $this->v_description = $v_description;
        $this->type = $type;
        $this->img_ville = $img_ville;
        $this->id_pays_fk = $id_pays_fk;
    }

    // Create - Ajouter une nouvelle ville
    public function create()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "INSERT INTO villes (nom, v_description, type, img_ville, id_pays_fk) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $this->nom,
            $this->v_description,
            $this->type,
            $this->img_ville,
            $this->id_pays_fk
        ]);
        $database->disconnect();
        return $db->lastInsertId();
    }

    // Read - Obtenir toutes les villes
    public static function getAll()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM villes";
        $stmt = $db->query($sql);
        $database->disconnect();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read - Obtenir une ville par son ID
    public static function getById($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM villes WHERE id_ville = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $database->disconnect();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByVille($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM villes WHERE id_pays_fk = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $database->disconnect();
        return $stmt;
    }

    // Update - Mettre à jour une ville
    public function update()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "UPDATE villes SET nom = ?, v_description = ?, type = ?, 
                img_ville = ?, id_pays_fk = ? WHERE id_ville = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([
            $this->nom,
            $this->v_description,
            $this->type,
            $this->img_ville,
            $this->id_pays_fk,
            $this->id_ville
        ]);
        $database->disconnect();
        return $result;
    }

    // Delete - Supprimer une ville
    public static function delete($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "DELETE FROM villes WHERE id_ville = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$id]);
        $database->disconnect();
        return $result;
    }
}



