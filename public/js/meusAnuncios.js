document.getElementById('logoutbtn').addEventListener('click', () => {
    localStorage.clear();
    window.location.href = "login.php";
});

async function loadUserCars() {
    try {
        const userID = localStorage.getItem("userID");
        const response = await fetch('/veicles');
        if (!response.ok) {
            throw new Error(`Erro ao carregar os carros: ${response.status}`);
        }
        const cars = await response.json();
        const carContainer = document.getElementById('car-container');
        carContainer.innerHTML = '';
        const userCars = cars.filter(car => car.userID === parseInt(userID));
        for (const car of userCars) {
            const carCard = document.createElement('div');
            carCard.className = 'col-md-3 mb-4';
            const isSold = car.sold;
            carCard.innerHTML = `
                <div class="card">
                    <button 
                        class="btn btn-settings" 
                        onclick="redirectToEditPage(${car.VeicleID})">
                        <i class="bi bi-gear"></i>
                    </button>
                    <div class="card-body">
                        <h5 class="card-title">${car.model}</h5>
                        <p class="card-text">Valor: R$${car.value}</p>
                        <p class="card-text">Descrição: ${car.description}</p>
                        <p class="card-text">KM: ${car.km} km</p>
                        <button 
                            class="btn ${isSold ? 'btn-secondary' : 'btn-danger'}" 
                            ${isSold ? 'disabled' : ''} 
                            onclick="${isSold ? '' : `markAsSold(${car.VeicleID})`}">
                            ${isSold ? 'Vendido' : 'Marcar como Vendido'}
                        </button>
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


async function markAsSold(id) {
    try {
        const response = await fetch(`/veicles/${id}`);
        if (!response.ok) {
            throw new Error(`Erro ao obter detalhes do veículo: ${response.status}`);
        }
        const car = await response.json();
        const updatedCar = {
            model: car.model,
            value: car.value,
            description: car.description,
            km: car.km,
            sold: true,
        };

        console.log(updatedCar);

        const updateResponse = await fetch(`/veicles/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updatedCar),
        });

        if (!updateResponse.ok) {
            throw new Error(`Erro ao marcar como vendido: ${updateResponse.status}`);
        }
        loadUserCars();
    } catch (error) {
        console.error("Erro ao marcar como vendido:", error);
        alert("Erro ao marcar o carro como vendido. Tente novamente mais tarde.");
    }
}

function redirectToEditPage(carID) {
    window.location.href = `editar-carro.php?id=${carID}`;
}



loadUserCars();
