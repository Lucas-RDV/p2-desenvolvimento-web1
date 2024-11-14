<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Anúncios - CarMarketPlace</title>
    <link rel="stylesheet" href="css/meusAnuncios.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">CarMarketPlace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Perfil
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfilDropdown">
                            <li><a class="dropdown-item" href="anunciar.php">Anunciar</a></li>
                            <li><a class="dropdown-item" href="meus-anuncios.php">Meus Anúncios</a></li>
                            <li><a class="dropdown-item" href="contaConfig.php">Alterar Dados da Conta</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" id="logoutbtn">
                        <a class="nav-link" href="#">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2>Meus Anúncios</h2>
        <div class="row" id="car-container">
        </div>
    </div>

    <script src="js/meusAnuncios.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
