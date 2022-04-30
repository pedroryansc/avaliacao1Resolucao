<?php

    require_once("class/PessoaFisica.php");
    require_once("class/Contato.php");
    require_once("class/ContaCorrente.php");

    function exibir_como_select($chave, $dados){
        $str = "<option value=0>Escolha</option>";
        foreach($dados as $linha){
            $str .= "<option value='{$linha[$chave[0]]}'>{$linha[$chave[1]]}</option>";
        }
        return $str;
    }

    function lista_pessoa($id){
        $pessoaFisica = new PessoaFisica(1, 1, 1, 1);
        $lista = $pessoaFisica->buscar($id);
        if($id != 0){
            foreach($lista as $vetor)
                return $vetor;
        } else
            return exibir_como_select(array("pf_id", "pf_nome"), $lista);
    }

    function lista_contato($id){
        $contato = new Contato(1, 1, 1, 1);
        $lista = $contato->buscar($id);
        foreach($lista as $vetor)
            return $vetor;
    }

    function lista_conta_corrente($id){
        try{
            $contaCorrente = new ContaCorrente(1, 1, 1, 1);
        } catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
        $lista = $contaCorrente->buscar($id);
        if($id != ""){
            foreach($lista as $vetor)
                return $vetor;
        } else
            return exibir_como_select(array("cc_numero", "cc_numero"), $lista);
    }
?>