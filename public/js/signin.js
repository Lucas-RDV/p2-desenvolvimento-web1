document.getElementById('cadastro-form').addEventListener('submit', async function(event) {
    event.preventDefault(); 
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const cpf = document.getElementById('cpf');
    const cidade = document.getElementById('city');
    const estado = document.getElementById('estate');
    const password = document.getElementById('password');

    const body = {
        name: name.value,
        password: password.value,
        email: email.value,
        cpf: cpf.value,
        phone: phone.value,
        city: cidade.value,
        estate: estado.value
      }

    console.log(body);

    const response = await fetch(`/users`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(body)
    });
    content = await response.json();
    
    if (response.status == 201) {
      alert(content.message);
      window.location.href = '/login.php';
    } else {
      alert("erro! ".content.message)
    }
    });