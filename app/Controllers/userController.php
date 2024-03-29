<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\models\UserModel;

class UserController
{
    public $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function processEntries()
    {
        $entries = $_POST;
        $model = new UserModel();
        $success = $model->submitEntries($entries);
        $location = $success ? '/successView' : '/errorView';

        return $location;
    }

    public function deleteUser()
    {
        $userId = $_POST;
        $model = new UserModel();
        $success = $model->deleteUser($userId);

        $location = $success ? '/successView' : '/errorView';

        return $location;
    }

    public function userView()
    {
        $users = $this->UserModel->getUsers();
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
