<?php
    class ClassCadastro_paciente {
        private $nomepac;  
        private $cpfpac;
        private $datanasc;
        private $telefonepac;
        private $telefonepac2;
        private $cep;
        private $estadopac;
        private $cidadepac;
        private $bairropac;
        private $ruapac;
        private $numeropac;
        private $pagamento;
        private $ficha;
        
        public function setNomepac($nomepac) {
            $this->nomepac = $nomepac;
        }
          
        public function setCpfpac($cpfpac) {
            $this->cpfpac = $cpfpac;
            
        }
        
        public function setDatanasc($datanasc) {
            $this->datanasc = $datanasc;
        }
        
        public function setTelefonepac($telefonepac) {
            $this->telefonepac = $telefonepac;
            
        }

        public function setTelefonepac2($telefonepac2) {
            $this->telefonepac2 = $telefonepac2;
            
        }

        public function setCep($cep) {
            $this->cep = $cep;
            
        }

        public function setEstadopac($estadopac) {
            $this->estadopac = $estadopac;
            
        }

        public function setCidadepac($cidadepac) {
            $this->cidadepac = $cidadepac;
            
        }

        public function setBairropac($bairropac) {
            $this->bairropac = $bairropac;
            
        }

        public function setRuapac($ruapac) {
            $this->ruapac = $ruapac;
            
        }

        public function setNumeropac($numeropac) {
            $this->numeropac = $numeropac;
            
        }

        public function setPagamento($pagamento) {
            $this->pagamento = $pagamento;
            
        }

        public function setFicha($ficha) {
            $this->ficha = $ficha;
            
        }

        //get

        public function getNomepac() {
            return $this->nomepac;
        }

        public function getCpfpac() {
            return $this->cpfpac;
            
        }
        
        public function getDatanasc() {
            return $this->datanasc;
        }
        
        public function getTelefonepac() {
            return $this->telefonepac;
            
        }

        public function getTelefonepac2() {
            return $this->telefonepac2;
            
        }

        public function getCep() {
            return $this->cep;
        }

        public function getEstadopac() {
            return $this->estadopac;
        }

        public function getCidadepac() {
            return $this->cidadepac;
        }

        public function getBairropac() {
            return $this->bairropac;
        }

        public function getRuapac() {
            return $this->ruapac;
        }

        public function getNumeropac() {
            return $this->numeropac;
        }

        public function getPagamento() {
            return $this->pagamento;
        }

        public function getFicha() {
            return $this->ficha;
        }

    }

?>