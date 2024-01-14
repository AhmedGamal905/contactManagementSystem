<?php

declare(strict_types=1);

namespace Tests\Unit;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use App\Controllers\UserController;
use App\Models\UserModel;

/** @test */
class ControllerTest extends TestCase
{

    public function testProcessEntriesRedirectsUser()
    {
        define('PHPUnit_MAIN_METHOD', true);
        $_SERVER['REQUEST_URI'] = '/processEntries';
        $_SERVER['REQUEST_METHOD'] = 'post';
        $_POST = [
            'name' => 'ahmed',
            'phone' => '0101266262',
            'email' => 'AHmed@ahmed.com',
        ];

        $app = require __DIR__ . '/../../public/index.php';



        //$userController = new UserController();````

        //$success = true;

        //$userController->processEntries();
        $user = new UserModel();
        //var_dump($user->getUsers());
        $users = $user->getUsers();
        $this->assertTrue(end($users)['name'] == 'ahmed');


        //   $response = $this->getActualOutput();

    }
}

// ./vendor/bin/phpunit --filter ControllerTest tests/Unit/controllertest.php