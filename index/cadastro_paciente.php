<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro paciente</title>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <style>
        body{
            background-size: cover;
        }
        div.form-group{
            padding: 8px;
        }
    </style>
</head>
<body>
<header>
        <nav class="navbar">
            <strong><p class="logo">Grupo União</p></strong>
            
             <ul class="nav-menu">
                    <li class="nav-item"><a class="nav-link" href="../index/menu.php"><strong>Menu</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="../index/cadastro_paciente.php"><strong>Cadastrar paciente</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="../index/selecionarMedico.php"><strong>Agendamento de cirurgia</strong></a></li>
                </ul>
    
            <div class="nav-ham">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
</header>

<main class="container">        
        <form method="post" action="controleCadastro_paciente.php">
            <div class="form-group">
                <h1>Cadastro Pacientes</h1>
                <br><br>

                <div class="form-group">
                    <input type="text" id="nomepac" name="nomepac" placeholder=" ">
                    <label for="nomepac">Nome completo</label>
                </div>

                <div class="form-group">
                    <input oninput="mascara(this)" type="text" name="cpfpac" maxlength="11" id="cpfpac" placeholder=" " required>
                    <label for="cpfpac">CPF</label>
                </div>

                <div class="form-group">
                    <input type="date" id="datanasc" name="datanasc" placeholder=" " required>                  
                    <label id="date" for="datanasc">Data de nascimento</label>
                </div>

                <div class="form-group">
                    <input maxlength="11" type="text" name="telefonepac" id="telefonepac" placeholder=" " required>
                    <label for="telefonepac">Telefone 1</label>
                </div>

                <div class="form-group">
                    <input maxlength="11" type="text" name="telefonepac2" id="telefonepac2" placeholder=" " required>
                    <label for="telefonepac2">Telefone 2</label>
                </div>

                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder=" " required>
                    <label for="email">Email</label>
                </div>

                <div class="form-group">
                    <input type="text" name="cep" id="cep" placeholder=" " required>
                    <label for="cep">CEP</label>
                </div>

                <div class="form-group">
                    <input type="text" name="estadopac" id="estadopac" placeholder=" " required>
                    <label for="estadopac">Estado</label>
                </div>

                <div class="form-group">
                    <input type="text" name="cidadepac" id="cidadepac" placeholder=" " required>
                    <label for="cidadepac">Cidade</label>
                </div>

                <div class="form-group">
                    <input type="text" name="bairropac" id="bairropac" placeholder=" " required>
                    <label for="bairropac">Bairro</label>
                </div>

                <div class="form-group">
                    <input type="text" name="ruapac" id="ruapac" placeholder=" " required>
                    <label for="ruapac">Rua</label>
                </div>
                
                <div class="form-group">
                    <input type="text" name="numeropac" id="numeropac" placeholder=" ">
                    <label for="numeropac">Número</label>
                </div>

                <div class="form-group">
                    <select id="pagamento" name="pagamento" placeholder=" " required>
                        <option value="">Selecione a forma de pagamento</option>
                        <option value="convenio">Convênio</option>
                        <option value="particular">Particular</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ficha" id="ficha" name="ficha"></label>
                </div>

                <br><br><br>

                <div class="form-group">
                    <input type="submit" value="Cadastrar Paciente e gerar ficha">
                </div>            
    </form>
</main>
    <script>
        
 function buscaCep(){
let cep= document.getElementById('cep').value;
if(cep!==""){
    let url="https://brasilapi.com.br/api/cep/v1/" + cep;
    let req = new XMLHttpRequest();
    req.open("GET", url);
    req.send();

    req.onload = function(){
        if(req.status === 200){
            let endereco = JSON.parse(req.response);
        document.getElementById("estadopac").value = endereco.state;
        document.getElementById("cidadepac").value = endereco.city;
        document.getElementById("bairropac").value = endereco.neighborhood;
        document.getElementById("ruapac").value = endereco.street;

        document.getElementById("estadopac").classList.add('filled');
        document.getElementById("cidadepac").classList.add('filled');
        document.getElementById("bairropac").classList.add('filled');
        document.getElementById("ruapac").classList.add('filled');

        document.getElementById("error-message").style.display = 'none';
        }else if(req.status === 404){
            document.getElementById("error-message").style.display = 'block';
        }else{
            alert("Erro ao fazer a requisição");
;           }
    }
}
}

document.addEventListener('DOMContentLoaded', function () {
    let cep = document.getElementById("cep");
    if (cep) {
        cep.addEventListener("blur", buscaCep);
    }
});
    </script>
    <script src="../javascript/nav.js"></script>

</body>
</html>