<?php require_once 'logica-usuario.php' ?>
<?php
$erro = isset($_GET['login']) && $_GET['login'] == 0; // Verifica se username=0
?>
<?php 

    if(usuarioEstaLogado()) {
        echo "Está Logado";
        header("Location:menu.php");

    } else {

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Login Interno</title>
    <style>
       body {
            background-image: url('../img/background_login_interno.jpg');
            background-size: cover;
            display: flex;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
}

        main {
            background-color: rgba(7, 14, 20, 0.904); /* Cor de fundo com opacidade */
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
}

        .login-container {
            background-color: #979797b4;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 5px 5px 25px rgba(0, 0, 0, 0.651);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input:hover{
            background-color: #d6d5d5e8;
        }

        input[type="text"],
        input[type="password"] {
            width: fit-content;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.397);
        }

        button {
            width: 100%;
            padding: 10px;
            background-color:  #222222e7;
            color: #ffffffa8;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.397);
        }

        button:hover {
            background-color: #0f0f0f;
        }

        .mensagem-erro {
            color:rgb(207, 0, 0);
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-top: 4px;
        }

        .message.visible {
                visibility: visible;
            }
    </style>
</head>
<body>
    <main>
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm" action="loga.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="senha" required>
            </div>

            <?php if ($erro): ?>
                <p class="mensagem-erro">Username ou password inválidos!</p>
            <?php endif; ?>

            <button type="submit">Login</button>
        </form>
    </div>
</main>

<script>
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                var formValid = true;

                var fields = [{
                        id: 'username',
                        messageId: 'username-message'
                    },
                    {
                        id: 'password',
                        messageId: 'password-message'
                    }
                ];

                fields.forEach(function(field) {
                    var input = document.getElementById(field.id);
                    var message = document.getElementById(field.messageId);
                    if (input.value.trim() === '') {
                        message.classList.add('visible');
                        input.classList.add('input-error');
                        if (formValid) {
                            input.focus();
                        }
                        formValid = false;
                    } else {
                        message.classList.remove('visible');
                        input.classList.remove('input-error');
                    }
                });

                if (!formValid) {
                    event.preventDefault();
                }
            });
        </script>

</body>
</html>
<?php }?>