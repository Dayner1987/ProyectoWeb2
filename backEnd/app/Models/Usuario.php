<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;
use PDOException;

class Usuario {
    private PDO $conn;
    

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // ================================
    // GET ALL USERS
    // ================================
    public function getAll() {
    $sql = "SELECT 
                u.idUsuarios,
                u.ciUsuario,
                u.mailUsuario,
                u.nombreUsuario,
                u.Roles_idRoles,
                r.nombreRol
            FROM Usuarios u
            INNER JOIN Roles r ON u.Roles_idRoles = r.idRoles";

    return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

    // ================================
    // GET BY ID
    // ================================
    public function getById($id) {
        $sql = "SELECT * FROM Usuarios WHERE idUsuarios = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ================================
    // CREATE USER (HASH PASSWORD)
    // ================================
    // Modelo Usuario.php
public function create(string $nombre, string $ci, string $mail, string $passwordHash, int $rolId) {
    try {
        $sql = "INSERT INTO Usuarios (nombreUsuario, ciUsuario, mailUsuario, password, Roles_idRoles)
                VALUES (:nombre, :ci, :mail, :pass, :rol)";
        $stmt = $this->conn->prepare($sql);

        // NO volver a hashear
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':pass', $passwordHash);
        $stmt->bindParam(':rol', $rolId, PDO::PARAM_INT);

        return $stmt->execute();

    } catch (PDOException $e) {
        echo "Error PDO: " . $e->getMessage();
        return false;
    }
}



    // ================================
    // UPDATE USER (HASH SI CAMBIA)
    // ================================
    public function update($id, $data) {

        // Si enviaron una nueva contraseña → hash
        if (!empty($data['password'])) {
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            $sql = "UPDATE Usuarios SET 
                        ciUsuario = :ci,
                        mailUsuario = :mail,
                        nombreUsuario = :nombre,
                        password = :pass,
                        Roles_idRoles = :rol
                    WHERE idUsuarios = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':pass', $hashedPassword);

        } else {
            // Actualizar sin tocar la contraseña
            $sql = "UPDATE Usuarios SET 
                        ciUsuario = :ci,
                        mailUsuario = :mail,
                        nombreUsuario = :nombre,
                        Roles_idRoles = :rol
                    WHERE idUsuarios = :id";

            $stmt = $this->conn->prepare($sql);
        }

        $stmt->bindParam(':ci', $data['ciUsuario']);
        $stmt->bindParam(':mail', $data['mailUsuario']);
        $stmt->bindParam(':nombre', $data['nombreUsuario']);
        $stmt->bindParam(':rol', $data['rol']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // ================================
    // DELETE USER
    // ================================
    public function delete($id) {
        $sql = "DELETE FROM Usuarios WHERE idUsuarios = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

       /* public function createCliente($nombre, $ci, $mail, $password)
{
    try {
        $sql = "INSERT INTO Usuarios (nombreUsuario, ciUsuario, mailUsuario, password, Roles_idRoles)
                VALUES (:nombre, :ci, :mail, :pass, 3)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':pass', $password);

        $stmt->execute();
        return true;

    } catch (PDOException $e) {
        // Muestra el error real de MySQL
        echo "Error PDO: " . $e->getMessage();
        return false;
    }
}*/
// Usuario.php
public function getByUsuario(string $usuario)
{
    $sql = "SELECT * FROM Usuarios WHERE mailUsuario = :usuario OR ciUsuario = :usuario LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


}
