<?php
session_start();
require_once 'id_medico.php';

if (medicoEstaLogado()) {
    header("Location: ../medico/calendario.php");
    exit;
}

$erro = isset($_GET['erro']) && $_GET['erro'] == 1;
?>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Médico</title>
        <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <style>
            body {
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                background: url('../img/background.jpg') no-repeat;
                background-size: cover;
            }

            .form {
                background-color: rgba(255, 255, 255, 0.356);
                justify-content: center;
                padding: 80px;
                border-radius: 10px;
                width: 285px;
                height: 350px;
                margin: auto;
                box-shadow: 5px 5px 10px rgba(0, 24, 26, 0.295);
            }

            .box input {
                text-align: center;
                padding: 8px;
                width: 93%;
                height: 45%;
                background: transparent;
                border: #fff;
                outline: none;
                border: 3px solid rgba(255, 255, 255, 0.877);
                border-radius: 60px;
                transition: border-color 0.2s;
            }

            .box input:hover {
                border-color: rgba(247, 212, 114, 0.445);
            }

            .btn-dark {
                width: 100%;
                height: 45px;
                border: none;
                outline: none;
                border-radius: 40px;
                cursor: pointer;
                color: #494848cc;
                background-color:rgba(124, 124, 124, 0.93);
                background-color: #fcfcfcee;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.205);
                text-align: center;
                font-size: 14px;
            }

            .btn-dark:hover{
                background-color:rgba(194, 194, 194, 0.22);
            }

            .form .registrar {
                text-align: center;
            }

            .mensagem-erro {
                color: red;
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

        <div class="form">
            <form id="loginForm" method="POST" action="logandomedico.php">
                <div class="box">
                    <img src="../img/grupouniaologin.png" alt="Logo">
                    <input type="text" id="id_medico" name="id_medico" placeholder="Id" required>

                    <br><br>
                </div>

                <div class="box">
                    <input type="password" id="password" name="senha" placeholder="Senha" required>
                    <br><br>
                </div>


                <?php if ($erro): ?>
                    <p class="mensagem-erro">Número do Id ou senha incorretos!</p>
                <?php endif; ?>

                <button type="submit" class="btn btn-dark">Entrar</button>
                <br>
            </form>
        </div>

        <script>

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
        </script>

    </body>

    </html>