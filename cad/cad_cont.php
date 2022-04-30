<!DOCTYPE html>
<?php
    require_once("../utils.php");

    $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    if($id != 0){
        $vetor = lista_contato($id);
    }

    $title = "Cadastro de Contato";
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
    <form action="../ctrl/ctrl_cont.php?id=<?php echo $id; ?>" method="post">
        Tipo: <input type="text" name="tipo" value="<?php if($acao == "editar") echo $vetor[1]; ?>"><br>
        <br>
        Descrição: <input type="text" name="descricao" value="<?php if($acao == "editar") echo $vetor[2]; ?>"><br>
        <br>
        Pessoa Física: <select name="pf_id">
                            <?php
                                if($acao == "editar"){
                                    $pdo = Conexao::getInstance(); 
                                    $consulta = $pdo->query("SELECT * FROM pessoa_fisica");
                                    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
                            ?>
                                <option value="<?php echo $linha["pf_id"]; ?>" <?php if($vetor[3] == $linha["pf_id"]) echo "selected"; ?>>
                                    <?php echo $linha["pf_nome"]; ?>
                                </option>
                            <?php
                                    }
                                } else
                                    echo lista_pessoa(0);
                            ?>
                        </select><br>
        <br>
        <button type="submit" name="acao" value="salvar">Salvar</button>
    </form>
</body>
</html>