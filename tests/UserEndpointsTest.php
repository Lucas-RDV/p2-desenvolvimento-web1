<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class UserEndpointsTest extends TestCase
{

    public function testCreateUser()
    {
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
        $status_code = null;
        if (isset($http_response_header)) {
            foreach ($http_response_header as $header) {
                if (preg_match('{HTTP/\S+\s+(\d{3})}', $header, $matches)) {
                    $status_code = $matches[1];
                    break;
                }
            }
        }
        assertEquals($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        $responseData = json_decode($response, true);
        assertEquals(
            isset($responseData['message']) && $responseData['message'] === "Usuário criado com sucesso.",
            "Esperado a mensagem 'Usuário criado com sucesso.', mas recebeu " . ($responseData['message'] ?? 'nulo')
        );
    }

    public function testListUsers()
    {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $status_code = null;
        if (isset($http_response_header)) {
            foreach ($http_response_header as $header) {
                if (preg_match('{HTTP/\S+\s+(\d{3})}', $header, $matches)) {
                    $status_code = $matches[1];
                    break;
                }
            }
        }
        assertEquals($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        $users = json_decode($response, true);
        $this->assertIsArray($users, "Esperado um array de usuários.");
        // foreach ($users as $user) {
        //     $this->assertArrayHasKey('name', $user, "Usuário não contém o campo 'name'.");
        //     $this->assertArrayHasKey('password', $user, "Usuário não contém o campo 'password'.");
        //     $this->assertArrayHasKey('email', $user, "Usuário não contém o campo 'email'.");
        //     $this->assertArrayHasKey('cpf', $user, "Usuário não contém o campo 'cpf'.");
        //     $this->assertArrayHasKey('phone', $user, "Usuário não contém o campo 'phone'.");
        //     $this->assertArrayHasKey('city', $user, "Usuário não contém o campo 'city'.");
        //     $this->assertArrayHasKey('estate', $user, "Usuário não contém o campo 'estate'.");
        // }
        $firstUser = $users[0]; // Acessa o primeiro usuário
        $this->assertArrayHasKey('name', $firstUser, "O primeiro usuário não contém o campo 'name'.");
        $this->assertArrayHasKey('password', $firstUser, "O primeiro usuário não contém o campo 'password'.");
        $this->assertArrayHasKey('email', $firstUser, "O primeiro usuário não contém o campo 'email'.");
        $this->assertArrayHasKey('cpf', $firstUser, "O primeiro usuário não contém o campo 'cpf'.");
        $this->assertArrayHasKey('phone', $firstUser, "O primeiro usuário não contém o campo 'phone'.");
        $this->assertArrayHasKey('city', $firstUser, "O primeiro usuário não contém o campo 'city'.");
        $this->assertArrayHasKey('estate', $firstUser, "O primeiro usuário não contém o campo 'estate'.");
    }

    public function testGetUserByID()
    {
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
        $createdUser = json_decode($response, true);

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
            if ($user['name'] === $createdUser['name']) {
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
        $status_code = null;
        if (isset($http_response_header)) {
            foreach ($http_response_header as $header) {
                if (preg_match('{HTTP/\S+\s+(\d{3})}', $header, $matches)) {
                    $status_code = $matches[1];
                    break;
                }
            }
        }
        assertEquals($status_code === '200', "Esperado código 200, mas recebeu código $status_code");
        $userFromAPI = json_decode($response, true);

        assert($userFromAPI['name'] === $createdUser['name']);
        assert($userFromAPI['password'] === $createdUser['password']);
        assert($userFromAPI['email'] === $createdUser['email']);
        assert($userFromAPI['cpf'] === $createdUser['cpf']);
        assert($userFromAPI['phone'] === $createdUser['phone']);
        assert($userFromAPI['city'] === $createdUser['city']);
        assert($userFromAPI['estate'] === $createdUser['estate']);
    }


    public function testUpdateUser()
    {
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
        $status_code = null;

        if (isset($http_response_header)) {
            foreach ($http_response_header as $header) {
                if (preg_match('{HTTP/\S+\s+(\d{3})}', $header, $matches)) {
                    $status_code = $matches[1];
                    break;
                }
            }
        }
        assertEquals($status_code === '200', "Esperado código 200, mas recebeu código $status_code");

        $response = file_get_contents("http://localhost:8000/users/{$userID}", false, $context);
        $userFromAPI = json_decode($response, true);

        assert($userFromAPI['name'] === $data['name']);
        assert($userFromAPI['password'] === $data['password']);
        assert($userFromAPI['email'] === $data['email']);
        assert($userFromAPI['cpf'] === $data['cpf']);
        assert($userFromAPI['phone'] === $data['phone']);
        assert($userFromAPI['city'] === $data['city']);
        assert($userFromAPI['estate'] === $data['estate']);
    }


    public function testDeleteUser()
    {
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
        $status_code = null;

        if (isset($http_response_header)) {
            foreach ($http_response_header as $header) {
                if (preg_match('{HTTP/\S+\s+(\d{3})}', $header, $matches)) {
                    $status_code = $matches[1];
                    break;
                }
            }
        }

        assertEquals($status_code === '200', "Esperado código 200, mas recebeu código $status_code");

        $response = file_get_contents("http://localhost:8000/users", false, $context);
        $users = json_decode($response, true);
        $deletedUserFound = false;

        foreach ($users as $user) {
            if ($user['userID'] === $userID) {
                $deletedUserFound = true;
                break;
            }
        }

        assert($deletedUserFound === false, "O usuário não foi deletado corretamente.");
    }
}
