<?php
    class Contato{
        private $cont_id;
        private $cont_tipo;
        private $cont_descricao;
        private $cont_pf_id;

        public function __construct($id, $tipo, $descricao, $pf_id){
            $this->setId($id);
            $this->setTipo($tipo);
            $this->setDescricao($descricao);
            $this->setPessoaFisica($pf_id);
        }
        
        public function getId(){ return $this->cont_id; }
        public function getTipo(){ return $this->cont_tipo; }
        public function getDescricao(){ return $this->cont_descricao; }
        public function getPessoaFisica(){ return $this->cont_pf_id; }
        
        public function setId($id){
            $this->cont_id = $id;
        }
        public function setTipo($tipo){
            if($tipo <> "") //<> = Diferente de (!=)
                $this->cont_tipo = $tipo;
            else
                throw new Exception("Tipo inválido: $tipo");
        }
        public function setDescricao($descricao){
            if($descricao <> "")
                $this->cont_descricao = $descricao;
            else
                throw new Exception("Descrição inválida: $descricao");
        }
        public function setPessoaFisica($pf_id){
            if($pf_id > 0)
                $this->cont_pf_id = $pf_id;
            else
                throw new Exception("Pessoa Física inválida: $pf_id");
        }

        public function insere(){
            require_once("../conf/Conexao.php");
            $query = "INSERT INTO contatos VALUES(:id, :tipo, :descricao, :pf_id)";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":id", $this->cont_id);
            $stmt->bindParam(":tipo", $this->cont_tipo);
            $stmt->bindParam(":descricao", $this->cont_descricao);
            $stmt->bindParam(":pf_id", $this->cont_pf_id);
            return $stmt->execute();
        }
        public function buscar($id){
            require_once("../conf/Conexao.php");
            $query = "SELECT * FROM contatos WHERE cont_id = :id";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":id", $id);
            if($stmt->execute())
                return $stmt->fetchAll(); 
            return false;
        }
        public function editar($id){
            require_once("../conf/Conexao.php");
            $query = "UPDATE contatos
                    SET cont_tipo = :tipo, cont_descricao = :descricao, cont_pf_id = :pf_id
                    WHERE cont_id = :id";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":tipo", $this->cont_tipo);
            $stmt->bindParam(":descricao", $this->cont_descricao);
            $stmt->bindParam(":pf_id", $this->cont_pf_id);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }
        public function excluir($id){
            require_once("../conf/Conexao.php");
            $query = "DELETE FROM contatos WHERE cont_id = :id";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }
    }
?>