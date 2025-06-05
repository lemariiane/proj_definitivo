<?php
require_once '../conexao/conexao.php';
require_once 'ClassMedico.php';

class ClassMedicoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function buscarMedicoPorId($id_medico) {
        $sql = "SELECT id_medico, senha FROM medicos WHERE id_medico = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id_medico, PDO::PARAM_INT);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $medico = new ClassMedico();
            $medico->setId_medico($row['id_medico']);
            $medico->setSenha($row['senha']);
            return $medico;
        }

        return null;
    }

    public function buscarAgendamentosPorMedico($id_medico) {
        $sql = "
            SELECT a.id_agendamento, a.start, a.end, a.ficha, p.nomepac, p.email
            FROM agendamento a
            LEFT JOIN cadastro_paciente p ON a.ficha = p.ficha
            WHERE a.id_medico = :id_medico
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_medico', $id_medico, PDO::PARAM_INT);
        $stmt->execute();

        $agendamentos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $agendamentos[] = [
                'id' => $row['id_agendamento'],
                'title' => $row['nomepac'] ?? 'Paciente não encontrado',
                'start' => $row['start'],
                'end' => $row['end'],
                'ficha' => $row['ficha'],
                'email' => $row['email'] ?? 'Email não encontrado'
            ];
        }

        return $agendamentos;
    }
}
?>
