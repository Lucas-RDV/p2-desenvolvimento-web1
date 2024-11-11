
        // pega o contato do anunciante
        async function getUserPhone(userID) {
            const response = await fetch(`/users/${userID}`);
            
            if (!response.ok) {
                throw new Error(`Erro ao obter usuário ${userID}: ${response.status}`);
            }

            const user = await response.json();
            return user[0].phone; 
        }

        // pega nome do dono do anuncio
        async function getUserName(userID) {
            const response = await fetch(`/users/${userID}`);
            
            if (!response.ok) {
                throw new Error(`Erro ao obter usuário ${userID}: ${response.status}`);
            }

            const user = await response.json();
            console.log(user);
            return user[0].name;
        }

        // cria os cards dos anuncios
        async function loadCars() {
            try {
                const response = await fetch('/veicles');
                if (!response.ok) {
                    throw new Error(`Erro ao carregar os carros: ${response.status}`);
                }
                
                const cars = await response.json();
                const carContainer = document.getElementById('car-container');

                for (const car of cars) {
                    //pega dados
                    const userName = await getUserName(car.userID);
                    const userPhone = await getUserPhone(car.userID);

                    // cria card
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

        // roda a funcao ao ler o script
        loadCars();