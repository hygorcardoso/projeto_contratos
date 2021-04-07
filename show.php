<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/dao/ContratoDAO.php');

    $codigo = $_GET['codigo'];
    $status = $_GET['status'];

    $stmt = ContratoDAO::getCodigo($codigo);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include('partials/_head.php') ?>
    <title>Contratos</title>

    <link rel="stylesheet" href="css/show.css">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <?php include("partials/_calendario.php") ?>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">
        <?php include('partials/_flashMessages.php') ?>

        <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>

        <?php if($status == 0) :?>
            <form action="verifica.php" method="POST">
                <input type="hidden" name="status" id="status" value="0">
                <table>
                    <tr>
                        <td>Código:</td>
                        <td id="segunda"><input type="text" id="codigo" name="codigo" readonly="disable" value="<?= $row->codigo?>"></td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td id="segunda"><input type="text" name="nome" id="nome" readonly="disable" value="<?= $row->nome ?>"></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>Data Emissão: </td>
                        <td id="segunda"><input type="date" readonly="disable" value="<?= $row->data_emissao ?>"></td>
                        <td id="terceira">Data Entrega: </td>   
                        <td id="quarta"><input type="date" id="data_entrega" name="data_entrega" value="<?= $row->data_entrega ?>"/></td>
                    </tr>
                    <tr>
                        <td>Data Retirada: </td>   
                        <td id="segunda"><input type="date" id="data_retirada" name="data_retirada" value="<?= $row->data_retirada ?>"/></td>
                        <td id="terceira">Data Devolução: </td>
                        <td id="quarta"><input type="date" id="data_devolucao" name="data_devolucao" value="<?= $row->data_devolucao ?>"></td>
                    </tr>
                </table>
                    
                <hr>
                <?php include("partials/_produtos.php") ?>
                
                <hr>
                <p>Observação:</p>
                <textarea name="observacao" id="observacao"><?= $row->observacao ?></textarea>
                <button type="submit" class="btn btn-outline-success">Gravar</button>
            </form>

        <?php else : ?>

            <form action="verifica.php" method="POST">
                <input type="hidden" name="status" id="status" value="1">
                <table>
                    <tr>
                        <td>Código:</td>
                        <td id="segunda"><input type="text" id="codigo" name="codigo" readonly="disable" value="<?= $row->codigo?>"></td>
                        <td id="terceira">Data Emissão: </td>
                        <td id="quarta"><input type="text" readonly="disable" value="<?= date('d/m/Y', strtotime($row->data_emissao)); ?>"></td>
                    </tr>
                    <tr>
                        <td>Nome: </td>
                        <td id="segunda"><input type="text" name="nome" id="nome" readonly="disable" value="<?= $row->nome ?>"></td>
                            <td id="terceira">Data Entrega: </td>   
                            <td id="quarta"><input type="text" id="calendario" name="calendario" value="<?= date('d/m/Y', strtotime($row->data_entrega)); ?>"/></td>
                    </tr>
                </table>
                    
                <hr>
                <?php include("partials/_produtos.php") ?>
                
                <hr>
                <p>Observação:</p>
                <textarea name="observacao" id="observacao"><?= $row->observacao ?></textarea>
                <button type="submit" class="btn btn-warning">Concluir Revisão</button>
            </form>

        <?php endif ?>

        <?php endwhile ?>
    </div>
</body>
</html>
