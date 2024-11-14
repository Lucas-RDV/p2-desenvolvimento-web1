const userID = localStorage.getItem("userID");
let originalUserData = {};

async function loadUserData() {
    try {
        const response = await fetch(`/users/${userID}`);
        if (!response.ok) {
            throw new Error('Erro ao carregar os dados do usuário.');
        }
        const user = await response.json();
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('phone').value = user.phone;
        document.getElementById('cpf').value = user.cpf;
        document.getElementById('city').value = user.city;
        document.getElementById('estate').value = user.estate;
        document.getElementById('password').value = '';
        originalUserData = {
            name: user.name,
            email: user.email,
            phone: user.phone,
            cpf: user.cpf,
            city: user.city,
            estate: user.estate,
            password: ''
        };
    } catch (error) {
        console.error(error);
        alert('Erro ao carregar os dados do usuário. Tente novamente mais tarde.');
        window.location.href = "meus-anuncios.php";
    }
}

loadUserData();

document.getElementById('cadastro-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const updatedUserData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        cpf: document.getElementById('cpf').value,
        city: document.getElementById('city').value,
        estate: document.getElementById('estate').value,
        password: document.getElementById('password').value
    };
    let dataChanged = false;
    for (let key in originalUserData) {
        if (originalUserData[key] !== updatedUserData[key]) {
            dataChanged = true;
            break;
        }
    }
    if (!dataChanged) {
        alert("Nenhuma alteração foi feita nos dados.");
        return;
    }
    try {
        const response = await fetch(`/users/${userID}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedUserData)
        });

        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`Erro ao salvar: ${response.status} - ${errorText}`);
        }

        alert('Dados do usuário atualizados com sucesso!');
        window.location.href = "meus-anuncios.php";
    } catch (error) {
        console.error("Erro ao tentar atualizar os dados do usuário:", error);
        alert('Erro ao salvar as alterações. Verifique os detalhes no console.');
    }
});

function enableField(fieldId) {
    document.getElementById(fieldId).disabled = false;
}