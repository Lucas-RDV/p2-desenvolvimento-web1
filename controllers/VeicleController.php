<?php
require_once '../models/Veicle.php';

class VeicleController {
    private $veicle;

    public function __construct($db)
    {
        $this->veicle = new Veicle($db);
    }

    public function list()
    {
        $veicles = $this->veicle->list();
        echo json_encode($veicles);
    }

    public function listSold()
    {
        $veicles = $this->veicle->listSold();
        echo json_encode($veicles);
    }

    public function listNotSold()
    {
        $veicles = $this->veicle->listNotSold();
        echo json_encode($veicles);
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $veicle = $this->veicle->getById($id);
                if ($veicle) {
                    echo json_encode($veicle);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Usuário não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o usuário."]);
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
                    echo json_encode(["message" => "Usuário deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o usuário."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->model) && isset($data->descrition) && isset($data->value) && isset($data->km)
         && isset($data->userid) && isset($data->sold)) {
            try {
                $this->veicle->create($data->model,$data->description, $data->value,$data->km,
                $data->userid, $data->sold);

                http_response_code(201);
                echo json_encode(["message" => "Usuário criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar o usuário."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->model) && isset($data->descrition) && isset($data->value) && isset($data->km)
        && isset($data->userid) && isset($data->sold)) {
            try {
                $count = $this->veicle->update($id, $data->model,$data->description, $data->value,$data->km,
                $data->userid, $data->sold);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Usuário atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o usuário."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}