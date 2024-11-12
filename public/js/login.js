async function getUserID(email, password) {
    const response = await fetch(`/users`);

    if (!response.ok) {
        throw new Error(`Erro ao obter usuário: ${response.status}`);
    }

    const users = await response.json();
    console.log(users);
    for (const user of users) {
        if (user.email === email && user.password === password) {
            console.log(user.userID);
            return user.userID;
        }
    }
    return null;
}

document.getElementById('login-form').addEventListener('submit', async function (event) {
    event.preventDefault();
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const user = await getUserID(email.value, password.value);
    if (user != null) {
        localStorage.setItem("userID", user);
        window.location.href = "/";
    }else {
        alert("email ou senha incorretos");
    }
})