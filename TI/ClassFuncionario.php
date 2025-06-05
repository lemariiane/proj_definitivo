<?php
    class ClassAgendamento {
        private $numcar;
        private $senha; 


        //set  
        public function setNumcar($numcar) {
            $this->numcar = $numcar;
            
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }
        

        //get
        public function getNumcar() {
            return $this->numcar;
        }

        public function getSenha() {
            return $this->senha;
        }
    }

?>