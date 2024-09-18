document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const senha = document.getElementById('loginPassword').value;

    fetch('php/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `email=${email}&password=${senha}`
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                window.location.href = 'php/crud.php';
            } else {
                alert('Login falhou!');
            }
        });
});

document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const email = document.getElementById('registerEmail').value;
    const senha = document.getElementById('registerPassword').value;

    fetch('php/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `email=${email}&password=${senha}`
    })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                alert('Cadastro bem-sucedido!');
            } else {
                alert('Cadastro falhou!');
            }
        });
});
