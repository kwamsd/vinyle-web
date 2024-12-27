<?php

namespace Src\Models;

use Src\Utils\Database;
use PDO;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function createUser($username, $email, $password)
    {
        if ($this->emailExists($email)) {
            throw new \Exception('L\'email est déjà utilisé.');
        }

        $query = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        return $query->execute([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    public function getUserByEmail($email)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists($email)
    {
        $query = $this->db->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $query->execute(['email' => $email]);
        return $query->fetchColumn() > 0;
    }
}
