<?php
require_once '../models/User.php';

class UserController
{
    private $user;

    public function __construct($db)
    {
        $this->user = new User($db);
    }

    public function list()
    {
        $users = $this->user->list();
        http_response_code(200);
        echo json_encode($users);
    }

    public function create()
    {
         error_log('inicio do create'."\r\n", 3, "error.log");
        $data = json_decode(file_get_contents("php://input"));
        error_log('depois do json_decode'."\r\n", 3, "error.log");
        if (
            isset($data->name) && isset($data->password) && isset($data->email) && isset($data->cpf)
            && isset($data->phone) && isset($data->city) && isset($data->estate)
        ) {
            error_log('dentro do if'."\r\n", 3, "error.log");
            try {
                error_log('dentro do trycatch'."\r\n", 3, "error.log");
                $this->user->create(
                    $data->name,
                    $data->password,
                    $data->email,
                    $data->cpf,
                    $data->phone,
                    $data->city,
                    $data->estate
                );
                error_log('depois do comando sql'."\r\n", 3, "error.log");
                http_response_code(200);
                echo json_encode(["message" => "Usuário criado com sucesso."]);
            }catch (\PDOException $e) {
                error_log($e . "\r\n", 3, "error.log");
                if ($e->getCode() === '23000') {
                    http_response_code(400);
                    echo json_encode(["message" => "Erro: o email fornecido já está em uso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao criar o usuário. " . $e->getMessage()]);
                }
            }catch (\Throwable $th) {
                http_response_code(500);
                error_log($th."\r\n", 3, "error.log");
                echo json_encode(["message" => "Erro ao criar o usuário. ".$th]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $user = $this->user->getById($id);
                if ($user) {
                    http_response_code(201);
                    echo json_encode($user);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Usuário não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o usuário. ".$th]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // public function login($email, $password)
    // {
    //     error_log('dentro da func login'."\r\n", 3, "error.log");   
    //     if (isset($email) && isset($password)) {
    //         try {
    //             error_log('dentro do try catch login'."\r\n", 3, "error.log");
    //             $user = $this->user->login($email, $password);
    //             if ($user) {
    //                 echo json_encode($user);
    //             } else {
    //                 http_response_code(404);
    //                 echo json_encode(["message" => "Usuário não encontrado."]);
    //             }
    //         } catch (\Throwable $th) {
    //             http_response_code(500);
    //             error_log($th."\r\n", 3, "error.log");
    //             echo json_encode(["message" => "Erro ao buscar o usuário. ".$th]);
    //         }
    //     } else {
    //         http_response_code(400);
    //         echo json_encode(["message" => "Dados incompletos."]);
    //     }
    // }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($id) && isset($data->name) && isset($data->password) && isset($data->email)
            && isset($data->cpf) && isset($data->phone) && isset($data->city) && isset($data->estate)
        ) {
            try {
                $count = $this->user->update(
                    $id,
                    $data->name,
                    $data->password,
                    $data->email,
                    $data->cpf,
                    $data->phone,
                    $data->city,
                    $data->estate
                );
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Usuário atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o usuário. ".$th]);
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
                $count = $this->user->delete($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Usuário deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o usuário. ".$th]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
