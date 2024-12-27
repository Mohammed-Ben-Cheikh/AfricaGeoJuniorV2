<?php
require_once __DIR__ . '/../database/Database.php';

class User
{
    private $id_user;
    private $email;
    private $password;
    private $type;

    public function __construct($id_user, $email, $password, $type = 'user')
    {
        $this->id_user = $id_user;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
    }

    // Create - Ajouter un nouvel utilisateur
    public function create()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "INSERT INTO user (email, password, type) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $this->email,
            $this->password,
            $this->type
        ]);
        $database->disconnect();
        return $db->lastInsertId();
    }

    // Read - Obtenir tous les utilisateurs
    public static function getAll()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM user";
        $stmt = $db->query($sql);
        $database->disconnect();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read - Obtenir un utilisateur par son ID
    public static function getById($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM user WHERE id_user = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $database->disconnect();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read - Obtenir un utilisateur par email
    public static function getByEmail($email)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        $database->disconnect();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update - Mettre à jour un utilisateur
    public function update()
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "UPDATE user SET email = ?, password = ?, type = ? WHERE id_user = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([
            $this->email,
            $this->password,
            $this->type,
            $this->id_user
        ]);
        $database->disconnect();
        return $result;
    }

    // Delete - Supprimer un utilisateur
    public static function delete($id)
    {
        $database = new Database();
        $db = $database->connect();
        $sql = "DELETE FROM user WHERE id_user = ?";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute([$id]);
        $database->disconnect();
        return $result;
    }
}
