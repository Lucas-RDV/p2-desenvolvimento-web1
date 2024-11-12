if (localStorage.getItem("userID") == null) {
    alert("Voce precisa estar logado para anunciar um veiculo!");
    window.location.href = "/login.php";
}

document.getElementById("anuncio-form").addEventListener("submit", async function(event) {
    event.preventDefault();

    const data = {
        model: document.getElementById("model").value,
        value: document.getElementById("value").value,
        km: document.getElementById("km").value,
        description: document.getElementById("description").value,
        userid: localStorage.getItem("userID")
    };

    try {
        const response = await fetch('/veicles', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            alert("Anúncio criado com sucesso!");
            window.location.href = "/meus-anuncios.php"
        } else {
            alert("Erro ao criar anúncio. Tente novamente.");
        }
    } catch (error) {
        console.error("Erro ao criar anúncio:", error);
        alert("Erro ao criar anúncio. ".error);
    }
});