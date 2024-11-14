<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Dados da Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <script src="js/checkuser.js"></script>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 800px;">
            <div class="card-header text-center">
                <h3>Alterar Dados da Conta</h3>
            </div>
            <div class="card-body">
                <form id="cadastro-form">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required disabled>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('name')">Editar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required disabled>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('email')">Editar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="(XX) XXXXX-XXXX" required disabled>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('phone')">Editar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" required disabled>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('cpf')">Editar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" required disabled>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('city')">Editar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="estate" class="form-label">Estado</label>
                            <select class="form-select" id="estate" name="estate" required disabled>
                                <option value="" disabled selected>Selecione o estado</option>
                            </select>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('estate')">Editar</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Digite uma nova senha (opcional)" disabled>
                            <button type="button" class="btn btn-secondary mt-2" onclick="enableField('password')">Editar</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <small><a href="meus-anuncios.php">Voltar para Meus Anúncios</a></small>
            </div>
        </div>
    </div>

    <script src="js/contaConfig.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>