## Endpoints

### Usuários

| Método | Endpoint       | Descrição                   |
|--------|----------------|-----------------------------|
| GET    | `/users`       | Lista todos os usuários     |
| GET    | `/users/{id}`  | Retorna um usuário específico com base no `id` |
| POST   | `/users`       | Cria um novo usuário        |
| PUT    | `/users/{id}`  | Atualiza as informações de um usuário com base no `id` |
| DELETE | `/users/{id}`  | Deleta um usuário com base no `id` |

#### Exemplo de requisição para criação de usuário (`POST /users`)

- **Body** (JSON):
    ```json
    {
      "name": "John Doe",
      "password": "password123",
      "email": "johndoe@example.com",
      "cpf": "12345678900",
      "phone": "5511999999999",
      "city": "São Paulo",
      "estate": "SP"
    }
    ```
- **Resposta**:
    - `201 Created`: Usuário criado com sucesso.
    - `400 Bad Request`: Dados incompletos.
    - `500 Internal Server Error`: Erro ao criar o usuário.

### Veículos

| Método | Endpoint             | Descrição                               |
|--------|-----------------------|-----------------------------------------|
| GET    | `/veicles`           | Lista todos os veículos                 |
| GET    | `/veicles/sold`      | Lista todos os veículos vendidos        |
| GET    | `/veicles/notsold`   | Lista todos os veículos disponíveis (não vendidos) |
| GET    | `/veicles/{id}`      | Retorna um veículo específico com base no `id` |
| POST   | `/veicles`           | Cria um novo registro de veículo        |
| PUT    | `/veicles/{id}`      | Atualiza as informações de um veículo com base no `id` |
| DELETE | `/veicles/{id}`      | Deleta um veículo com base no `id`      |

#### Exemplo de requisição para criação de veículo (`POST /veicles`)

- **Body** (JSON):
    ```json
    {
      "model": "Sedan XYZ",
      "description": "Veículo confortável e econômico.",
      "value": 55000,
      "km": 30000,
      "userid": 1,
    }
    ```
- **Resposta**:
    - `201 Created`: Veículo criado com sucesso.
    - `400 Bad Request`: Dados incompletos.
    - `500 Internal Server Error`: Erro ao criar o veículo.

### Códigos de Resposta

- `200 OK`: Requisição bem-sucedida.
- `201 Created`: Recurso criado com sucesso.
- `400 Bad Request`: Dados incompletos ou inválidos.
- `404 Not Found`: Recurso não encontrado.
- `500 Internal Server Error`: Erro no servidor ao processar a requisição.