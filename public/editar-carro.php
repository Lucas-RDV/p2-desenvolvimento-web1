<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anúncio</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .edit-container {
            display: flex;
            align-items: center;
        }

        .edit-container input,
        .edit-container textarea {
            flex: 1;
        }

        .edit-btn {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <script src="js/checkuser.js"></script>
    <div class="container my-5">
        <h2 class="text-center mb-4">Editar Anúncio</h2>
        <form id="editar-anuncio-form" action="#">
            <div class="form-group edit-container">
                <label for="model" class="mr-2">Modelo</label>
                <input type="text" class="form-control" id="model" name="model" required disabled>
                <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="enableField('model')">Editar</button>
            </div>
            <div class="form-group edit-container">
                <label for="value" class="mr-2">Valor</label>
                <input type="number" class="form-control" id="value" name="value" required disabled>
                <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="enableField('value')">Editar</button>
            </div>
            <div class="form-group edit-container">
                <label for="km" class="mr-2">Quilometragem (km)</label>
                <input type="number" class="form-control" id="km" name="km" required disabled>
                <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="enableField('km')">Editar</button>
            </div>
            <div class="form-group edit-container">
                <label for="description" class="mr-2">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="3" disabled></textarea>
                <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="enableField('description')">Editar</button>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="sold" name="sold">
                <label class="form-check-label" for="sold">Vendido</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='meus-anuncios.php'">Voltar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/editarCarro.js"></script>
</body>

</html>