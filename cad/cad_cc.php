<!DOCTYPE html>
<?php
    require_once("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    if($id != ""){
        $vetor = lista_conta_corrente($id);
    }

    $title = "Cadastro de Conta Corrente";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
    <a href="../index.php">Voltar à página principal</a> |
    <?php echo $title; ?><br>
    <br>
    <form action="../ctrl/ctrl_cc.php?id=<?php echo $id; ?>" method="post">
        Número: <input type="text" name="numero" value="<?php if($acao == "editar") echo $vetor[0]; ?>"><br>
        <br>
        Saldo: R$<input type="text" name="saldo" value="<?php if($acao == "editar") echo $vetor[1]; ?>"><br>
        <br>
        Pessoa Física: <select name="pf_id">
                            <?php
                                if($acao == "editar"){
                                    $pdo = Conexao::getInstance(); 
                                    $consulta = $pdo->query("SELECT * FROM pessoa_fisica");
                                    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                            ?>
                                <option value="<?php echo $linha["pf_id"]; ?>" <?php if($vetor[2] == $linha["pf_id"]) echo "selected"; ?>>
                                    <?php echo $linha["pf_nome"]; ?>
                                </option>
                            <?php
                                    }
                                } else
                                    echo lista_pessoa(0);
                            ?>
                        </select><br>
        <br>
        Data da última alteração: <input type="date" name="dt_ultima_alteracao" value="<?php if($acao == "editar") echo $vetor[3]; ?>"><br>
        <br>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
</body>
</html>