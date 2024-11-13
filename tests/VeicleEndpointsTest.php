<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertJson;

class VeicleEndpointsTest extends TestCase
{
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
        assertJson($response);
    }

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
        assertJson($response);
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
        $veicle = json_decode($response);
        assert($veicle['model'] === 'veiculo teste');
        assertJson($response);
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
            "userID" => 0,
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
        assertJson($response);
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
        assertJson($response);
    }
}
