<?php
session_start();
require_once "../conexao/conexao.php";

class ClassAgendamentoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrarAgendamento($novoAgendamento) {
        try {
            $sql = "INSERT INTO agendamento (ficha, start, end, id_medico)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $novoAgendamento->getFicha());
            $stmt->bindValue(2, $novoAgendamento->getStart());
            $stmt->bindValue(3, $novoAgendamento->getEnd());
            $stmt->bindValue(4, $novoAgendamento->getId_medico());
            $stmt->execute();

            $_SESSION['mensagem'] = "✅ Agendamento realizado com sucesso!";
            $_SESSION['status'] = "sucesso";

        } catch (PDOException $erro) {
            $_SESSION['mensagem'] = "❌ Erro ao cadastrar: " . $erro->getMessage();
            $_SESSION['status'] = "erro";
        }

        header("Location: calendario.php");
        exit;
    }
    

   public function excluirAgendamento($id_agendamento) {
        try {
            $sql = "DELETE FROM agendamento WHERE id_agendamento = :id_agendamento";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_agendamento', $id_agendamento, PDO::PARAM_INT);
            $stmt->execute();

            // Set session messages - optional if using AJAX for all feedback
            // session_start(); // Make sure session is started if you use this line
            $_SESSION['mensagem'] = "✅ Agendamento excluído com sucesso!";
            $_SESSION['status'] = "sucesso";
            return true;

        } catch (PDOException $erro) {
            // session_start(); // Make sure session is started if you use this line
            $_SESSION['mensagem'] = "❌ Erro ao excluir! " . $erro->getMessage();
            $_SESSION['status'] = "erro";
            return false;
        }
    }


    public function buscarAgendamentoPorId($id) {
        try {
            $sql = "SELECT id_agendamento, start, end, id_medico, ficha FROM agendamento WHERE id_agendamento = :id_agendamento"; 
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_agendamento', $id, PDO::PARAM_INT);
            $stmt->execute();
            $agendamentoData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($agendamentoData) {
                $agendamento = new ClassAgendamento();
                $agendamento->setId_agendamento($agendamentoData['id_agendamento']); 
                $agendamento->setStart($agendamentoData['start']);
                $agendamento->setEnd($agendamentoData['end']);
                $agendamento->setId_medico($agendamentoData['id_medico']);
                $agendamento->setFicha($agendamentoData['ficha']);
                return $agendamento;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erro ao buscar agendamento: " . $e->getMessage();
            return null;
        }
    }

}
?>