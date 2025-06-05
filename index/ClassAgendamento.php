<?php
    class ClassAgendamento {
        private $id_agendamento;
        private $ficha;
        private $start; 
        private $end;
        private $id_medico;
        
          
        public function setId_agendamento($id_agendamento) {
            $this->id_agendamento = $id_agendamento;
            
        }

        public function setFicha($ficha) {
            $this->ficha = $ficha;
            
        }

        public function setStart($start) {
            $this-> start= $start;
        }
        
        public function setEnd($end) {
            $this->end = $end;
            
        }

        public function setId_medico($id_medico) {
            $this->id_medico = $id_medico;
            
        }


        //get

        public function getId_agendamento() {
            return $this->id_agendamento;
        }

        public function getFicha() {
            return $this->ficha;
        }

        public function getStart() {
            return $this->start;
        }
        
        
        public function getEnd() {
            return $this->end;
            
        }

        public function getId_medico() {
            return $this->id_medico;
        }
    }

?>