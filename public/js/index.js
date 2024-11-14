function updateNavbar() {
    const userID = localStorage.getItem("userID");
    const navbar = document.querySelector('.navbar-nav');

    if (userID) {
        navbar.innerHTML = `
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Perfil
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="perfilDropdown">
                    <a class="dropdown-item" href="anunciar.php">Anunciar</a>
                    <a class="dropdown-item" href="meus-anuncios.php">Meus Anúncios</a>
                    <a class="dropdown-item" href="contaConfig.php">Alterar Dados da Conta</a>
                </div>
            </li>
            <li class="nav-item" id="logoutbtn"><a class="nav-link" href="#">Sair</a></li>
        `;
        document.getElementById('logoutbtn').addEventListener('click', () => {
            localStorage.clear();
            location.reload();
        });
    }
}

async function getUserPhone(userID) {
    const response = await fetch(`/users/${userID}`);

    if (!response.ok) {
        throw new Error(`Erro ao obter usuário ${userID}: ${response.status}`);
    }

    const user = await response.json();
    return user.phone;
}

async function getUserName(userID) {
    const response = await fetch(`/users/${userID}`);

    if (!response.ok) {
        throw new Error(`Erro ao obter usuário ${userID}: ${response.status}`);
    }

    const user = await response.json();
    console.log(user);
    return user.name;
}

async function loadCars() {
    try {
        const response = await fetch('/veicles/notsold');
        if (!response.ok) {
            throw new Error(`Erro ao carregar os carros: ${response.status}`);
        }
        const cars = await response.json();
        const carContainer = document.getElementById('car-container');
        for (const car of cars) {
            const userName = await getUserName(car.userID);
            const userPhone = await getUserPhone(car.userID);
            const carCard = document.createElement('div');
            carCard.className = 'col-md-3 mb-4';
            carCard.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${car.model}</h5>
                                <p class="card-text">Valor: R$${car.value}</p>
                                <p class="card-text">Descrição: ${car.description}</p>
                                <p class="card-text">KM: ${car.km} km</p>
                                <p class="card-text">Proprietário: ${userName}</p>
                                <a href="https://wa.me/${userPhone}" target="_blank" class="btn btn-primary">Entrar em Contato</a>
                            </div>
                        </div>
                    `;

            carContainer.appendChild(carCard);
        }
    } catch (error) {
        console.error("Erro ao carregar os carros:", error);
        alert("Erro ao carregar os carros. Tente novamente mais tarde.");
    }
}

updateNavbar();
loadCars();