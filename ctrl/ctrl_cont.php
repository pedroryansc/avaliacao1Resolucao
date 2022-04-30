<?php
    //ctrl_cont -> Controle-contato

    require_once("../class/Contato.php");
    
    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;

    if($acao == "excluir"){
        try{
            $contato = new Contato(1, 1, 1, 1);
            $contato->excluir($id);
            header("location:../index.php");
        } catch(Exception $e){
            echo "<h1>Erro ao excluir conta.</h1>
            <br>
            Erro:".$e->getMessage();
        }
    }

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";

    if($acao == "salvar"){
        $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "";
        $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
        $pf_id = isset($_POST["pf_id"]) ? $_POST["pf_id"] : 0;
        $contato = new Contato($id, $tipo, $descricao, $pf_id);
        if($id == 0){
            try{
                $contato->insere();
                header("location:../index.php");
            }catch(Exception $e){
                echo "<h1>Erro ao cadastrar contato.</h1>
                <br>
                Erro:".$e->getMessage();
            }
        } else{
            try{
                $contato->editar($id);
                header("location:../index.php");
            }catch(Exception $e){
                echo "<h1>Erro ao editar contato.</h1>
                <br>
                Erro:".$e->getMessage();
            }
        }
    }
?>