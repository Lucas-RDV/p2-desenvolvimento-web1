<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertJson;

class UserEndpointsTest extends TestCase
{
    public function testListUsers() {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $headers = get_headers("http://localhost:8000/users", 1);
        $status_code = substr($headers[0], 9, 3);
        assert($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        assertJson($response);
    }

    public function testCreateUser() {
        $data = [
            "name" => "Teste User",
            "password" => "123456",
            "email" => "test@example.com",
            "cpf" => "12345678900",
            "phone" => "999999999",
            "city" => "Teste City",
            "estate" => "TC"
        ];
        $options = [
            "http" => [
                "method" => "POST",
                "header" => "Accept: application/json\r\n",
                "content" => json_encode($data),
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $headers = get_headers("http://localhost:8000/users", 1, $context);
        $status_code = substr($headers[0], 9, 3);
        assert($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        assertJson($response);
    }

    public function testGetUserByID() {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $users = json_decode($response, true);
        foreach ($users as $user) {
            if ($user['name'] === 'Teste User') {
                $userID = $user['userID'];
                break;
            }
        }
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users/{$userID}", false, $context);
        $headers = get_headers("http://localhost:8000/users/{$userID}", 1);
        $status_code = substr($headers[0], 9, 3);
        assert($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        $user = json_decode($response);
        assert($user['name'] === 'Test User');
        assertJson($response);
    }
    
    public function testUpdateUser() {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $users = json_decode($response, true);
        foreach ($users as $user) {
            if ($user['name'] === 'Teste User') {
                $userID = $user['userID'];
                break;
            }
        }
        $data = [
            "name" => "Updated User",
            "password" => "654321",
            "email" => "update@example.com",
            "cpf" => "12345678900",
            "phone" => "999999999",
            "city" => "Update City",
            "estate" => "UC"
        ];
        $options = [
            "http" => [
                "method" => "PUT",
                "header" => "Accept: application/json\r\n",
                "content" => json_encode($data),
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users/{$userID}", false, $context);
        $headers = get_headers("http://localhost:8000/users/{$userID}", 1, $context);
        $status_code = substr($headers[0], 9, 3);
        assert($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        assertJson($response);
    }

    public function testDeleteUser() {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $users = json_decode($response, true);
        foreach ($users as $user) {
            if ($user['name'] === 'Updated User') {
                $userID = $user['userID'];
                break;
            }
        }
        $options = [
            "http" => [
                "method" => "DELETE",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users/{$userID}", false, $context);
        $headers = get_headers("http://localhost:8000/users/{$userID}", 1);
        $status_code = substr($headers[0], 9, 3);
        assert($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        assertJson($response);
    }
}
