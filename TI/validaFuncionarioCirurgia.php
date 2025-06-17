<?php require_once '../conexao/conecta.php' ?>
<?php
    $numcar= $_POST['numcar'];
    $senha= md5($_POST['senha']); // senha criptografada

    inserir($conexao, $numcar, $senha);
  
    function inserir($conexao, $numcar, $senha) {
        $sql = "INSERT INTO logar (numcar,senha)
                values('$numcar','$senha')";
        
        if(mysqli_query($conexao, $sql)) {
            echo 'Adicionando';
            header ("Location:menu.php");
        } else {
            echo ' ';
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Login</title>
    <style>
        body {
            background-image: url('../img/background-logar.jpg');
            background-size: cover;
            display: flex;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main {
            background-color: rgba(7, 14, 20, 0.514);
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: #ffffffd7;
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

        input:hover {
            background-color: #d6d5d5e8;
        }

        input[type="text"],
        input[type="password"] {
            width: fit-content;
            padding: 10px;
            border: 1px solid red;
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
        h3{
            color: red;
        }
    </style>
</head>
<body>

<main>
    <div class="login-container">
        <h2>Acesso Funcionário</h2>
        <form action="validaFuncionarioCirurgia.php" method="post">
            <div class="form-group">
                <label>Número da carteira</label>
                <input type="text" name="numcar" class="<?php echo $erroCampo ? 'erro' : ''; ?>" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" id="password" name="senha" class="<?php echo $erroCampo ? 'erro' : ''; ?>" required>
            </div>
            <h3>Essa carteira já existe!</h3>
            <button type="submit">Login</button>
        </form>
    </div>
</main>
</body>
</html>