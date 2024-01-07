<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use PDOException;
use dotenv;
use App\DB;
use App\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
class UserModel {

    protected DB $db;
    protected PDO $dbConnection;

    public function __construct()
    {
        $this->db = App::db();
        $this->dbConnection = DB::getConnection();
        
    }

    public function submitEntries($entries) {
        if (empty($entries['name'])) {
            return false;
        }
    
        if (empty($entries['email']) || !filter_var($entries['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
    
        if (empty($entries['phone'])) {
            return false;
        }

        $registerQuery = 'INSERT INTO users (name, email, phone)
        VALUES (:name, :email, :phone)';
        try {
            $this->dbConnection->beginTransaction();
            $newInputStmt = $this->dbConnection->prepare($registerQuery);
            $newInputStmt->execute([
                'name' => $entries['name'],
                'phone' => $entries['phone'],
                'email' => $entries['email'],
            ]);
    
            $this->dbConnection->commit();
    
            return true;
    
        } catch (PDOException $e) {
            if ($this->dbConnection->inTransaction()) {
                $this->dbConnection->rollBack();
            }
            return false;
        }
    }

    public function deleteUser($userId) {

        $deleteUserQuery = 'DELETE FROM users WHERE id = :id';
        try {
            $this->dbConnection->beginTransaction();
            $deleteStmt = $this->dbConnection->prepare($deleteUserQuery);
            $deleteStmt->execute([
                'id' => $userId['id'],
            ]);
            $rowCount = $deleteStmt->rowCount();
        if ($rowCount === 0) {

        return false;
        }
            $this->dbConnection->commit();
        
            return true;
        
        } catch (PDOException $e) {
            if ($this->dbConnection->inTransaction()) {
                $this->dbConnection->rollBack();
            }
            return false;
        }

    }
    public function getUsers(): array
    {
        $getQuery = 'SELECT * FROM users';
        $users = [];

        foreach ($this->dbConnection->query($getQuery) as $user){
            $users[] = $user;
       }
       
       return $users;
    }
}