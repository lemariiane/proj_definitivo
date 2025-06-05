<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de acesso</title>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
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

        form {
            margin: 0;
            gap: 1rem;
            background-color: #ffffff00;
            box-shadow: 0px 0px 0px #ffffff00;
            border-radius: 0%;
        }


        .form {
            background-color: rgba(255, 255, 255, 0.356);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            width: 350px;
            height: 400px;
            margin: auto;
            box-shadow: 5px 5px 10px rgba(0, 24, 26, 0.295);
        }

        .form-group {
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            background-color: transparent;
            padding: 0;
        }

        select {
            width: 200px;
        }

        input[type="submit"] {
            width: 200px;
            height: 45px;
            border: none;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            color: #494848cc;
            background-color: #fcfcfcee;
            border-color: #fafafa;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.205);
            text-align: center;
            font-size: 14px;

        }

        input[type="submit"]:hover {
            background-color: rgba(194, 194, 194, 0.22);
        }
    </style>
</head>

<body>

    <div class="form">
        <form id="loginForm" method="post" action="#">
            <div class="form-group">
                <img src="../img/grupouniaologin.png" alt="Logo">

                <select id="tipoacesso" name="tipoacesso" required>
                    <option value="">Selecione o tipo de acesso</option>
                    <option value="1">Funcionário(a) marcação</option>
                    <option value="2">Médico(a)</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Acessar">
            </div>
        </form>
    </div>

        <script>
            document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault(); // evita submit padrão

  const tipo = document.getElementById('tipoacesso').value;

  if (tipo === '1') {
    // redireciona pro login de funcionário
    window.location.href = '../login/login.php';
  } else if (tipo === '2') {
    // redireciona pro login de médico 
    window.location.href = '../login/login_medico.php'; 
  } else {
    alert('Selecione um tipo de acesso válido!');
  }
});

        </script>

</body>

</html>