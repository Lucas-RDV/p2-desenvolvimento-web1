<?php
require_once '../models/Veicle.php';

class VeicleController
{
    private $veicle;

    public function __construct($db)
    {
        $this->veicle = new Veicle($db);
    }

    public function list()
    {
        $veicles = $this->veicle->list();
        http_response_code(200);
        echo json_encode($veicles);
    }

    public function listSold()
    {
        $veicles = $this->veicle->listSold();
        http_response_code(200);
        echo json_encode($veicles);
    }

    public function listNotSold()
    {
        $veicles = $this->veicle->listNotSold();
        http_response_code(200);
        echo json_encode($veicles);
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $veicle = $this->veicle->getById($id);
                if ($veicle) {
                    http_response_code(200);
                    echo json_encode($veicle);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "veiculo não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar veiculo."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id)) {
            try {
                $count = $this->veicle->delete($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "anuncio deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar anuncio."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar anuncio."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function create()
    {

        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->model) && isset($data->description) && isset($data->value) && isset($data->km)
            && isset($data->userid)
        ) {
            try {
                $this->veicle->create(
                    $data->model,
                    $data->description,
                    $data->value,
                    $data->km,
                    $data->userid
                );

                http_response_code(200);
                echo json_encode(["message" => "Veiculo cadastrado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao cadastrar veiculo."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($id) && isset($data->model) && isset($data->description) && isset($data->value) && isset($data->km)
            && isset($data->sold)
        ) {
            try {
                $count = $this->veicle->update(
                    $id,
                    $data->model,
                    $data->description,
                    $data->value,
                    $data->km,
                    $data->sold
                );
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "anuncio atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o anuncio."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o anuncio."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
