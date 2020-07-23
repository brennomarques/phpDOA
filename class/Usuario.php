<?php

    class Usuario {
   
        private $idusuario;
        private $deslogin;
        private $dessenha;
        private $dtcadastro;
   
        public function getIdusario(){
            return $this->idusuario;
        }
        public function getDeslogin(){
            return $this->deslogin;
        }
        public function getDessenha(){
            return $this->dessenha;
        }
        public function getDtcadastro(){
            return $this->dtcadastro;
        }

        public function setIdusario($value){
            $this->idusuario = $value;
        }
        public function setDeslogin($value){
            $this->deslogin = $value;
        }
        public function setDessenha($value){
            $this->dessenha = $value;
        }
        public function setDtcadastro($value){
            $this->dtcadastro = $value;
        }

        public function loadById($id){
            $sql = new Sql();

            $result = $sql->select("SELECT * FROM usuario WHERE idusuario = :ID", array(
                ":ID"=>$id
            ));

            if(count($result) > 0){
                $row = $result[0];
                $this->setIdusario($row['idusuario']);
                $this->setDeslogin($row['deslogin']);
                $this->setDessenha($row['dessenha']);
                $this->setDtcadastro(new DateTime($row['dtcadastro']));//já pasando para tipo timestempo
            }
        }

        public function __toString(){
            return json_encode(array(
                "idusuario"=>$this->getIdusario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }
    }

?>