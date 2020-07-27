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

        public function loadById($id){//usuario por ID
            $sql = new Sql();

            $result = $sql->select("SELECT * FROM usuario WHERE idusuario = :ID", array(
                ":ID"=>$id
            ));

            if(count($result) > 0){
                $this->setData($result[0]);
            }
        }

        public static function eListAll(){ //lista todos os usuario
            $sql = new Sql();
            return $sql->select("SELECT * FROM usuario ORDER BY idusuario;");
        }

        public function login($login, $password){
            $sql = new Sql();

            $result = $sql->select("SELECT * FROM usuario WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
                ":LOGIN"=>$login,
                ":PASSWORD"=>$password
            ));

            if(count($result) > 0){
                $this->setData($result[0]);
            }else{
                throw new Exception("Login e/ou senha inválidos");
                
            }
        }

        public static function eSearch($login){//realiza busca no busca.
            $sql = new Sql();
            return $sql->select("SELECT * FROM usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
                ':SEARCH'=>"%".$login."%"
            ));

        }

        public function setData($data){//dados
            $this->setIdusario($data['idusuario']);
            $this->setDeslogin($data['deslogin']);
            $this->setDessenha($data['dessenha']);
            $this->setDtcadastro(new DateTime($data['dtcadastro']));//já pasando para tipo timestempo
        }

        public function eInsert(){//inserir dados
            $sql = new Sql();
            $results = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)", array(
                ':LOGIN'=>$this->getDeslogin(),
                ':PASSWORD'=>$this->getDessenha()
            ));
            if(count($results) > 0){
                $this->setData($results[0]);
            }
        }

        public function eUpdate($login, $password){//Atualizar
            
            $this->setDeslogin($login);
            $this->setDessenha($password);

            $sql = new Sql();

            $sql->query("UPDATE usuario SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario =:ID", array(
                'LOGIN'=>$this->getDeslogin(),
                'PASSWORD'=>$this->getDessenha(),
                'ID'=>$this->getIdusario()
            ));
        }

        public function eDelete(){//Deletar usuario 

            $sql = new Sql();

            $sql->query("DELETE FROM usuario WHERE idusuario =:ID", array(
                'ID'=>$this->getIdusario()
            ));

            $this->setIdusario("0");
            $this->setDeslogin("");
            $this->setDessenha("");
            $this->setDtcadastro(new DateTime());
        }    

        public function __toString(){//exibir em formato Json
            return json_encode(array(
                "idusuario"=>$this->getIdusario(),
                "deslogin"=>$this->getDeslogin(),
                "dessenha"=>$this->getDessenha(),
                "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
            ));
        }
    }

?>