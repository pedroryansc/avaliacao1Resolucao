<?php
    require_once("../class/ContaCorrente.php");

    $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
    
    if($acao == "salvar"){
        $cc_pf_id = isset($_POST["cc_pf_id"]) ? $_POST["cc_pf_id"] : 0;
        $cc_numero = isset($_POST["cc_numero"]) ? $_POST["cc_numero"] : "";
        $operacao = isset($_POST["operacao"]) ? $_POST["operacao"] : "";
        $valor = isset($_POST["valor"]) ? $_POST["valor"] : 0;
        $contaCorrente = new ContaCorrente(1, 1, 1, 1);
        $lista = $contaCorrente->buscar($cc_numero);
        $vetor = converteParaArray($lista);
        $opr = $contaCorrente->saqueOuDeposito($cc_pf_id, $operacao, $vetor, $valor, $cc_numero);
        header("location:../cad/operacoes.php?opr=$opr&num=$cc_numero");
    }

    function converteParaArray($lista){
        foreach($lista as $vetor)
            return $vetor;
    }
?>