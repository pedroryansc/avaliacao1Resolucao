<?php
    //ctrl_cc -> Controle-conta-corrente

    require_once("../class/ContaCorrente.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : "";

    if($acao == "excluir"){
        try{
            $contaCorrente = new ContaCorrente(1, 1, 1, 1);
            $contaCorrente->excluir($id);
            header("location:../index.php");
        } catch(Exception $e){
            echo "<h1>Erro ao excluir conta.</h1>
            <br>
            Erro:".$e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $numero = isset($_POST["numero"]) ? $_POST["numero"] : "";
        $saldo = isset($_POST["saldo"]) ? $_POST["saldo"] : 0;
        $pf_id = isset($_POST["pf_id"]) ? $_POST["pf_id"] : 0;
        $dt_ultima_alteracao = isset($_POST["dt_ultima_alteracao"]) ? $_POST["dt_ultima_alteracao"] : "";
        $contaCorrente = new ContaCorrente($numero, $saldo, $pf_id, $dt_ultima_alteracao);
        if($id == ""){
            try{
                $contaCorrente->insere();
                header("location:../index.php");
            }catch(Exception $e){
                echo "<h1>Erro ao cadastrar conta.</h1>
                <br>
                Erro:".$e->getMessage();
            }
        } else{
            try{
                $contaCorrente->editar($id);
                header("location:../index.php");
            }catch(Exception $e){
                echo "<h1>Erro ao editar conta.</h1>
                <br>
                Erro:".$e->getMessage();
            }
        }
    }
?>