<?php

declare(strict_types=1);

namespace Tests\Unit;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophet;
use App\Controllers\UserController;
use App\Models\UserModel;

require_once __DIR__ . '/../vendor/autoload.php';
/**
 * @runInSeparateProcess
 */
class ControllerTest extends TestCase
{
    private Prophet $prophet;

    protected function setUp(): void
    {
        parent::setUp();
        $this->prophet = new Prophet();
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
        parent::tearDown();
    }

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

        $userController = new UserController();
        $location = $userController->processEntries();

        $user = new UserModel();
        $users = $user->getUsers();
        $this->assertTrue(end($users)['name'] == 'ahmed');

        $this->assertEquals('/successView', $location);
    }
}
