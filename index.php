<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $consultarPF = isset($_POST["consultarPF"]) ? $_POST["consultarPF"] : "";
    $consultarCont = isset($_POST["consultarCont"]) ? $_POST["consultarCont"] : "";
    $consultarCC = isset($_POST["consultarCC"]) ? $_POST["consultarCC"] : "";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal - Avaliação 1</title>
</head>
<body>
    <?php
        include "menu.html";
    ?>
    <h2>Pessoa Física:</h2>
    <form method="post">
        <input type="search" name="consultarPF" placeholder="Consultar por nome" value="<?php echo $consultarPF; ?>"><br>
        <br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>CPF</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica
                                    WHERE pf_nome LIKE '$consultarPF%'
                                    ORDER BY pf_nome");
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
        ?>
        <tr>
            <td><?php echo $linha["pf_id"]; ?></td>
            <td><?php echo $linha["pf_cpf"]; ?></td>
            <td><?php echo $linha["pf_nome"]; ?></td>
            <td><?php echo date("d/m/Y", strtotime($linha["pf_dt_nascimento"])); ?></td>
            <td><a href="cad/cad_pf.php?acao=editar&id=<?php echo $linha['pf_id'];?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('ctrl/ctrl_pf.php?acao=excluir&id=<?php echo $linha['pf_id']; ?>')">Excluir</a><br></td>
        </tr>
        <?php 
            }
        ?>
    </table>
    <br>
    <h2>Contatos:</h2>
    <form method="post">
        <input type="search" name="consultarCont" placeholder="Consultar por tipo" value="<?php echo $consultarCont; ?>"><br>
        <br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Pessoa Física (ID)</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM contatos
                                    WHERE cont_tipo LIKE '$consultarCont%'
                                    ORDER BY cont_tipo");
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
        ?>
        <tr>
            <td><?php echo $linha["cont_id"]; ?></td>
            <td><?php echo $linha["cont_tipo"]; ?></td>
            <td><?php echo $linha["cont_descricao"]; ?></td>
            <td><?php echo $linha["cont_pf_id"]; ?></td>
            <td><a href="cad/cad_cont.php?acao=editar&id=<?php echo $linha['cont_id'];?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('ctrl/ctrl_cont.php?acao=excluir&id=<?php echo $linha['cont_id']; ?>')">Excluir</a><br></td>
        </tr>
        <?php 
            }
        ?>
    </table>
    <br>
    <h2>Conta Corrente:</h2>
    <form method="post">
        <input type="search" name="consultarCC" placeholder="Consultar por número" value="<?php echo $consultarCC; ?>"><br>
        <br>
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table border="1">
        <tr>
            <th>Número</th>
            <th>Saldo</th>
            <th>Pessoa Física (ID)</th>
            <th>Data da última alteração</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM conta_corrente
                                    WHERE cc_numero LIKE '$consultarCC%'
                                    ORDER BY cc_numero");
            while ($linha = $consulta->fetch(PDO::FETCH_BOTH)) {
        ?>
        <tr>
            <td><?php echo $linha["cc_numero"]; ?></td>
            <td><?php echo number_format($linha["cc_saldo"], 2, ",", "."); ?></td>
            <td><?php echo $linha["cc_pf_id"]; ?></td>
            <td><?php echo date("d/m/Y", strtotime($linha["cc_dt_ultima_alteracao"])); ?></td>
            <td><a href="cad/cad_cc.php?acao=editar&id=<?php echo $linha['cc_numero'];?>">Editar</a></td>
            <td><a href="javascript:excluirRegistro('ctrl/ctrl_cc.php?acao=excluir&id=<?php echo $linha['cc_numero']; ?>')">Excluir</a><br></td>
        </tr>
        <?php 
            }
        ?>
    </table>
</body>
</html>
<script>
    function excluirRegistro(url){
        if(confirm("Este registro será excluído. Tem certeza?"))
            location.href = url;
    }
</script>