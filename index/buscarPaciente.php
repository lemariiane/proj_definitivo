<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'sis_hosp');

// Verifica a conexão
if ($conn->connect_error) {
    error_log("Erro na conexão com o banco de dados: " . $conn->connect_error); 
    die(json_encode(["erro" => "Erro na conexão com o banco de dados."]));
}

if (isset($_GET['ficha']) && is_numeric($_GET['ficha'])) {
    $ficha = $_GET['ficha'];

    // Consulta ao banco de dados
    $sql = "SELECT nomepac, email FROM cadastro_paciente WHERE ficha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ficha);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["erro" => "Paciente não encontrado."]);
    }

    $stmt->close();
} else {
    echo json_encode(["erro" => "Número da ficha inválido."]);
}

$conn->close();
?>