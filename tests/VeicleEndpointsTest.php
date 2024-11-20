<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class VeicleEndpointsTest extends TestCase
{
    public function testCreateVeicle()
    {
        $data = [
            "model" => "veiculo teste",
            "description" => "Veículo teste e testando.",
            "value" => 80000,
            "km" => 60000,
            "userid" => 0,
        ];
        $options = [
            "http" => [
                "method" => "POST",
                "header" => "Accept: application/json\r\n",
                "content" => json_encode($data),
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/veicles", false, $context);
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
            isset($responseData['message']) && $responseData['message'] === "Veiculo cadastrado com sucesso.",
            "Esperado a mensagem 'Veículo cadastrado com sucesso.', mas recebeu " . ($responseData['message'] ?? 'nulo')
        );
    }

    public function testListVeicles()
    {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/veicles", false, $context);
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
        $veicles = json_decode($response, true);
        $this->assertIsArray($veicles, "Esperado um array de veículos.");
        $firstVeicle = $veicles[0];
        $this->assertArrayHasKey('model', $firstVeicle, "O primeiro veículo não contém o campo 'model'.");
        $this->assertArrayHasKey('description', $firstVeicle, "O primeiro veículo não contém o campo 'description'.");
        $this->assertArrayHasKey('value', $firstVeicle, "O primeiro veículo não contém o campo 'value'.");
        $this->assertArrayHasKey('km', $firstVeicle, "O primeiro veículo não contém o campo 'km'.");
        $this->assertArrayHasKey('userID', $firstVeicle, "O primeiro veículo não contém o campo 'userid'.");
    }

    public function testGetVeicleByID()
    {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/veicles", false, $context);
        $veicles = json_decode($response, true);
        foreach ($veicles as $veicle) {
            if ($veicle['model'] === 'veiculo teste') {
                $veicleID = $veicle['VeicleID'];
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
        $response = file_get_contents("http://localhost:8000/veicles/{$veicleID}", false, $context);
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
        $veicleFromAPI = json_decode($response, true);
        assert($veicleFromAPI['model'] === 'veiculo teste');
        assert($veicleFromAPI['description'] === 'Veículo teste e testando.');
        assert($veicleFromAPI['value'] === 80000);
        assert($veicleFromAPI['km'] === 60000);
        assert($veicleFromAPI['userid'] === 0);
    }

    public function testUpdateVeicle()
    {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/veicles", false, $context);
        $veicles = json_decode($response, true);
        foreach ($veicles as $veicle) {
            if ($veicle['model'] === 'veiculo teste') {
                $veicleID = $veicle['VeicleID'];
                break;
            }
        }
        $data = [
            "model" => "veiculo update",
            "description" => "Veículo update.",
            "value" => 80000,
            "km" => 60000,
            "sold" => 1
        ];
        $options = [
            "http" => [
                "method" => "PUT",
                "header" => "Accept: application/json\r\n",
                "content" => json_encode($data),
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/veicles/{$veicleID}", false, $context);
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

        $response = file_get_contents("http://localhost:8000/veicles/{$veicleID}", false, $context);
        $veicleFromAPI = json_decode($response, true);

        assert($veicleFromAPI['model'] === $data['model']);
        assert($veicleFromAPI['description'] === $data['description']);
        assert($veicleFromAPI['value'] === $data['value']);
        assert($veicleFromAPI['km'] === $data['km']);
        assert($veicleFromAPI['sold'] === $data['sold']);
    }

    public function testDeleteVeicle()
    {
        $options = [
            "http" => [
                "method" => "GET",
                "header" => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("http://localhost:8000/veicles", false, $context);
        $veicles = json_decode($response, true);
        foreach ($veicles as $veicle) {
            if ($veicle['model'] === 'veiculo update') {
                $veicleID = $veicle['VeicleID'];
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
        $response = file_get_contents("http://localhost:8000/veicles/{$veicleID}", false, $context);
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

        $response = file_get_contents("http://localhost:8000/veicles", false, $context);
        $veicles = json_decode($response, true);
        $deletedVeicleFound = false;

        foreach ($veicles as $veicle) {
            if ($veicle['VeicleID'] === $veicleID) {
                $deletedVeicleFound = true;
                break;
            }
        }

        assert($deletedVeicleFound === false, "O veículo não foi deletado.");
    }
}
