<?php
    //ctrl_pf -> Controle-pessoa-fisica

    require_once("../class/PessoaFisica.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "excluir"){
        try{
            $pessoaFisica = new PessoaFisica(1, 1, 1, 1);
            $pessoaFisica->excluir($id);
            header("location:../index.php");
        } catch(Exception $e){
            echo "<h1>Erro ao excluir conta.</h1>
            <br>
            Erro:".$e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $dt_nascimento = isset($_POST["dt_nascimento"]) ? $_POST["dt_nascimento"] : "";
        $pessoaFisica = new pessoaFisica($id, $cpf, $nome, $dt_nascimento);
        if($id == 0){
            try{
                $pessoaFisica->insere();
                header("location:../index.php");
            }catch(Exception $e){
                echo "<h1>Erro ao cadastrar pessoa física.</h1>
                <br>
                Erro:".$e->getMessage();
            }
        } else{
            try{
                $pessoaFisica->editar($id);
                header("location:../index.php");
            }catch(Exception $e){
                echo "<h1>Erro ao editar pessoa física.</h1>
                <br>
                Erro:".$e->getMessage();
            }
        }
    }
?>