<?php
require_once '../conexao/conexao.php';
class ClassBloqueioDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

      public function buscarBloqueiosPorMedico($id_medico) {
        $query = "SELECT id, start, end, obs FROM bloqueios_medico WHERE id_medico = :id_medico";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_medico', $id_medico);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir um novo bloqueio
    public function inserirBloqueio($id_medico, $start, $end, $obs) {
        $sql = "INSERT INTO bloqueios_medico (id_medico, start, end, obs) VALUES (:id_medico, :start, :end, :obs)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        $stmt->bindParam(':obs', $obs);

        return $stmt->execute();
    }

    public function salvar($id_medico, $start, $end, $obs) {
        $query = "INSERT INTO bloqueios_medico (id_medico, start, end, obs) VALUES (:id_medico, :start, :end, :obs)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_medico', $id_medico);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        $stmt->bindParam(':obs', $obs);
        return $stmt->execute();
    }

   public function editar($id, $start, $end, $obs) {
        $query = "UPDATE bloqueios_medico SET start = :start, end = :end, obs = :obs WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':start', $start);
        $stmt->bindParam(':end', $end);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluir($id) {
        $query = "DELETE FROM bloqueios_medico WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
