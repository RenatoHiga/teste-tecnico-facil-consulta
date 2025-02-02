<?php

namespace Tests\Unit;

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_successful_login(): void
    {
        $authController = new AuthController();

        request()->merge([
            'email' => 'christian.ramires@example.com',
            'password' => 'password'
        ]);

        $result = json_decode($authController->login()->getContent());
        $result_exists = !empty($result);
        $result_has_token = isset($result->access_token) && !empty($result->access_token);

        $this->assertTrue($result_exists);
        $this->assertTrue($result_has_token);
    }

    public function test_failed_login(): void {
        $authController = new AuthController();

        request()->merge([
            'email' => 'christian.ramires@example',
            'password' => '123'
        ]);

        $result = json_decode($authController->login()->getContent());
        $error_message_exists = isset($result->error);

        $this->assertTrue($error_message_exists);
    }
}
