<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Anúncio</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Cadastro de Novo Anúncio</h2>
    <form id="anuncio-form" action="#">
        <div class="form-group">
            <label for="model">Modelo</label>
            <input type="text" class="form-control" id="model" name="model" placeholder="Digite o modelo do carro" required>
        </div>
        <div class="form-group">
            <label for="value">Valor</label>
            <input type="number" class="form-control" id="value" name="value" placeholder="Digite o valor do carro" required>
        </div>
        <div class="form-group">
            <label for="km">Quilometragem (km)</label>
            <input type="number" class="form-control" id="km" name="km" placeholder="Digite a quilometragem" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Escreva uma breve descrição do carro"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Cadastrar Anúncio</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/anunciar.js"></script>
</body>
</html>
