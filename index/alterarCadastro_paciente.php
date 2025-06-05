<?php
require_once "ClassCadastro_paciente.php";
require_once '../conexao/conecta.php';
require_once "ClassCadastro_pacienteDAO.php";

// Substitua a recuperação dos dados via GET por POST
$nomepac = isset($_POST['nomepac']) ? htmlspecialchars($_POST['nomepac'], ENT_QUOTES, 'UTF-8') : '';
$cpfpac = isset($_POST['cpfpac']) ? htmlspecialchars($_POST['cpfpac'], ENT_QUOTES, 'UTF-8') : '';
$datanasc = isset($_POST['datanasc']) ? htmlspecialchars($_POST['datanasc'], ENT_QUOTES, 'UTF-8') : '';
$telefonepac = isset($_POST['telefonepac']) ? htmlspecialchars($_POST['telefonepac'], ENT_QUOTES, 'UTF-8') : '';
$telefonepac2 = isset($_POST['telefonepac2']) ? htmlspecialchars($_POST['telefonepac2'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$cep = isset($_POST['cep']) ? htmlspecialchars($_POST['cep'], ENT_QUOTES, 'UTF-8') : '';
$estadopac = isset($_POST['estadopac']) ? htmlspecialchars($_POST['estadopac'], ENT_QUOTES, 'UTF-8') : '';
$cidadepac = isset($_POST['cidadepac']) ? htmlspecialchars($_POST['cidadepac'], ENT_QUOTES, 'UTF-8') : '';
$bairropac = isset($_POST['bairropac']) ? htmlspecialchars($_POST['bairropac'], ENT_QUOTES, 'UTF-8') : '';
$ruapac = isset($_POST['ruapac']) ? htmlspecialchars($_POST['ruapac'], ENT_QUOTES, 'UTF-8') : '';
$numeropac = isset($_POST['numeropac']) ? htmlspecialchars($_POST['numeropac'], ENT_QUOTES, 'UTF-8') : '';
$pagamento = isset($_POST['pagamento']) ? htmlspecialchars($_POST['pagamento'], ENT_QUOTES, 'UTF-8') : '';
$ficha = isset($_POST['ficha']) ? htmlspecialchars($_POST['ficha'], ENT_QUOTES, 'UTF-8') : '';


// Instanciando as classes
$ClassCadastro_pacienteDAO = new ClassCadastro_pacienteDAO();
$novoCadastro_paciente = new ClassCadastro_paciente();

// Atribuindo os valores ao objeto
$novoCadastro_paciente->setNomepac($nomepac);
$novoCadastro_paciente->setCpfpac($cpfpac);
$novoCadastro_paciente->setDatanasc($datanasc);
$novoCadastro_paciente->setTelefonepac($telefonepac);
$novoCadastro_paciente->setTelefonepac2($telefonepac2);
$novoCadastro_paciente->setEmail($email);
$novoCadastro_paciente->setCep($cep);
$novoCadastro_paciente->setEstadopac($estadopac);
$novoCadastro_paciente->setCidadepac($cidadepac);
$novoCadastro_paciente->setBairropac($bairropac);
$novoCadastro_paciente->setRuapac($ruapac);
$novoCadastro_paciente->setNumeropac($numeropac);
$novoCadastro_paciente->setPagamento($pagamento);
$novoCadastro_paciente->setFicha($ficha);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar paciente</title>
    <style>
        h1{
            margin-bottom: 50px;
        }
        button {
            background-color: #014a68;
            color: white;
            padding: 15px 220px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #012e40;
        }
    </style>
</head>

<body>

    <center>
        <form action="alterarProcessaCadastro_paciente.php" method="POST">
            <h1>ALTERAR DADOS</h1>

            <p>Nome paciente</p>
            <input type="text" name="nomepac" value="<?php echo $novoCadastro_paciente->getNomepac(); ?>" required> <br><br><br>

            <p> Cpf </p>
            <input type="text" name="cpfpac" value="<?php echo $novoCadastro_paciente->getCpfpac(); ?>" required> <br><br><br>

            <p> Data nascimento</p>
            <input type="date" name="datanasc" value="<?php echo $novoCadastro_paciente->getDatanasc(); ?>" required> <br><br><br>

            <p> Telefone </p>
            <input type="text" name="telefonepac" value="<?php echo $novoCadastro_paciente->getTelefonepac(); ?>" required> <br><br><br>

            <p>Telefone 2 </p>
            <input type="text" name="telefonepac2" value="<?php echo $novoCadastro_paciente->getTelefonepac2(); ?>" required> <br><br><br>

            <Email </p>
            <input type="text" name="email" value="<?php echo $novoCadastro_paciente->getEmail(); ?>" required> <br><br><br>


            <p> Cep </p>
            <input type="text" name="cep" value="<?php echo $novoCadastro_paciente->getCep(); ?>" required> <br><br><br>

            <p> Estado </p>
            <input type="text" name="estadopac" value="<?php echo $novoCadastro_paciente->getEstadopac(); ?>" required> <br><br><br>

            <p> Cidade </p>
            <input type="text" name="cidadepac" value="<?php echo $novoCadastro_paciente->getCidadepac(); ?>" required> <br><br><br>

            <p> Bairro </p>
            <input type="text" name="bairropac" value="<?php echo $novoCadastro_paciente->getBairropac(); ?>" required> <br><br><br>

            <p> Rua </p>
            <input type="text" name="ruapac" value="<?php echo $novoCadastro_paciente->getRuapac(); ?>" required> <br><br><br>

            <p> Número </p>
            <input type="text" name="numeropac" value="<?php echo $novoCadastro_paciente->getNumeropac(); ?>" required> <br><br><br>

            <p> Pagamento </p>
            <input type="text" name="pagamento" value="<?php echo $novoCadastro_paciente->getPagamento(); ?>" required> <br><br><br>

            <p>Ficha</p>
            <input type="text" name="ficha" value="<?php echo $novoCadastro_paciente->getFicha(); ?>" readonly> <br><br><br>

            <br><br>

            <button type="submit">Alterar</button>
        </form>
    </center>

</body>

</html>