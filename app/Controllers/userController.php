<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\models\UserModel;

class UserController {
    private $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function processEntries()
    {
        $entries = $_POST;
    
        $model = new UserModel();
        $success = $model->submitEntries($entries);
    
        if ($success) {
            header('Location: /successView');
            exit();
        } else {
            header('Location: /errorView');
            exit();
        }
    }

    public function deleteUser()
    {
        $userId = $_POST;
        $model = new UserModel();
        $success = $model->deleteUser($userId);
    
        if ($success) {
            header('Location: /successView');
            exit();
        } else {
            header('Location: /errorView');
            exit();
        }
        
    }
    public function userView()
    {
        $users = $this->UserModel->get();
        return View::make('userView', ['users' => $users]);
    }
    public function submitView()
    {
        return View::make('submitView');
    }
    public function successView()
    {
        return View::make('successView');
    }
    public function errorView()
    {
        return View::make('errorView');
    }
    
}   