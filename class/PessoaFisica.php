<?php
    class PessoaFisica{
        private $pf_id;
        private $pf_cpf;
        private $pf_nome;
        private $pf_dt_nascimento;

        public function __construct($id, $cpf, $nome, $dt_nascimento){
            $this->setId($id);
            $this->setCpf($cpf);
            $this->setNome($nome);
            $this->setDtNascimento($dt_nascimento);
        }

        public function getId(){ return $this->pf_id; }
        public function getCpf(){ return $this->pf_cpf; }
        public function getNome(){ return $this->pf_nome; }
        public function getDtNascimento(){ return $this->pf_dt_nascimento; }

        public function setId($id){
            $this->pf_id = $id;
        }
        public function setCpf($cpf){
            if($cpf <> "")
                $this->pf_cpf = $cpf;
            else
                throw new Exception("CPF inválido: $cpf");
        }
        public function setNome($nome){
            if($nome <> "")
                $this->pf_nome = $nome;
            else
                throw new Exception("Nome inválido: $nome");    
        }
        public function setDtNascimento($dt_nascimento){
            if($dt_nascimento <> "")
                $this->pf_dt_nascimento = $dt_nascimento;
            else
                throw new Exception("Data de nascimento inválida: $dt_nascimento");
        }

        public function insere(){
            require_once("../conf/Conexao.php");
            $query = "INSERT INTO pessoa_fisica VALUES(:id, :cpf, :nome, :dt_nascimento)";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":id", $this->pf_id);
            $stmt->bindParam(":cpf", $this->pf_cpf);
            $stmt->bindParam(":nome", $this->pf_nome);
            $stmt->bindParam(":dt_nascimento", $this->pf_dt_nascimento);
            return $stmt->execute();
        }
        public function buscar($id){
            require_once("../conf/Conexao.php");
            $query = "SELECT * FROM pessoa_fisica";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            if($id > 0){
                $query .= " WHERE pf_id = :id";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(":id", $id);
            }
            if($stmt->execute())
                return $stmt->fetchAll(); 
            return false;
        }
        public function editar($id){
            require_once("../conf/Conexao.php");
            $query = "UPDATE pessoa_fisica
                    SET pf_cpf = :cpf, pf_nome = :nome, pf_dt_nascimento = :dt_nascimento
                    WHERE pf_id = :id";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":cpf", $this->pf_cpf);
            $stmt->bindParam(":nome", $this->pf_nome);
            $stmt->bindParam(":dt_nascimento", $this->pf_dt_nascimento);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }
        public function excluir($id){
            require_once("../conf/Conexao.php");
            $query = "DELETE FROM pessoa_fisica WHERE pf_id = :id";
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }
    }
?>