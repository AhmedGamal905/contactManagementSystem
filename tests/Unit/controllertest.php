<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use App\Controllers\UserController;

class controllerTest extends TestCase
{
    /**@test */
    
    public function testProcessEntriesRedirectsUser() {
       
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load(); 
    //Given we controller object
    $userController = new UserController();
    //when the return from the model is true
    $success = true;
    //Calling the processEntries method
    $userController->processEntries();

    $response = $this->output();

    // Assert that the response contains a Location header
    $this->assertStringContainsString('Location: /successView', $response);

    // Assert that the response contains an exit() call
    $this->assertStringContainsString('exit();', $response);
    }
}
//./vendor/bin/phpunit --testdox tests/Unit/controllertest.php