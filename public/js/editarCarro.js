const params = new URLSearchParams(window.location.search);
const carId = params.get('id');

if (!carId) {
    window.location.href = "meus-anuncios.php";
}

async function loadCarData() {
    try {
        const response = await fetch(`/veicles/${carId}`);
        if (!response.ok) {
            throw new Error('Erro ao carregar os dados do veículo.');
        }
        const car = await response.json();

        document.getElementById('model').value = car.model;
        document.getElementById('value').value = car.value;
        document.getElementById('km').value = car.km;
        document.getElementById('description').value = car.description;
        document.getElementById('sold').checked = car.sold;

        originalCarData = {
            model: car.model,
            value: car.value,
            km: car.km,
            description: car.description,
            sold: car.sold
        };
    } catch (error) {
        console.error(error);
        alert('Erro ao carregar os dados do veículo. Tente novamente mais tarde.');
        window.location.href = "meus-anuncios.php";
    }
}

loadCarData();

window.enableField = function (fieldId) {
    document.getElementById(fieldId).disabled = false;
};

document.getElementById('editar-anuncio-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    const carId = new URLSearchParams(window.location.search).get('id');
    const updatedCar = {
        model: document.getElementById('model').value,
        value: document.getElementById('value').value,
        km: document.getElementById('km').value,
        description: document.getElementById('description').value,
        sold: document.getElementById('sold').checked
    };
    let dataChanged = true
    if (originalCarData.model == updatedCar.model
        && originalCarData.value == updatedCar.value
        && originalCarData.km == updatedCar.km
        && originalCarData.description == updatedCar.description
        && originalCarData.sold == updatedCar.sold) {
        dataChanged = false
    }

    if (!dataChanged) {
        alert("Nenhuma alteração foi feita nos dados do anúncio.");
    } else {
        try {
            const response = await fetch(`/veicles/${carId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(updatedCar)
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Erro ao salvar: ${response.status} - ${errorText}`);
            }

            alert('Anúncio atualizado com sucesso!');
            window.location.href = "meus-anuncios.php";
        } catch (error) {
            console.error("Erro ao tentar atualizar o anúncio:", error);
            alert('Erro ao salvar as alterações. Verifique os detalhes no console.');
        }
    }
});
