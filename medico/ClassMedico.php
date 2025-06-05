<?php
class ClassMedico {
    private $id_medico;
    private $senha;

    public function getId_medico() {
        return $this->id_medico;
    }

    public function setId_medico($id_medico) {
        $this->id_medico = $id_medico;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
}
?>
