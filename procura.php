<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/dao/ContratoDAO.php');

    $codigo = $_GET['codigo'];

    $stmt = ContratoDAO::getCodigo($codigo);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include('partials/_head.php') ?>
    <title>Contratos</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include("partials/_navbar.php") ?>

    <div class="container">
        <?php include('partials/_flashMessages.php') ?>
        <div class="row">
            <table>
                <thead>
                    <th><h3 id="codigo">Código</h3></th>
                    <th><h3 id="nome">Nome</h3></th>
                    <th><h3 id="data">Data de Contratação</h3></th>
                    <th><h3 id="valor">Valor</h3></th>
                    <th><h3 id="acao">Ações</h3></th>
                </thead>
                <tbody>
                    <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                    <?php  $data_emissao = $row->data_emissao; ?>
                    <tr>
                        <td><p> <?= $row->codigo; ?> </p></td>
                        <td><p> <?= $row->nome; ?> </p></td>
                        <td><p> <?= date('d/m/Y', strtotime($data_emissao)) ?> </p></td>
                        <td><p> <?= $row->valor; ?> </p></td>
                        <td>
                            <a href="show.php?codigo=<?= $row->codigo ?>&status=0"><button type="button" class="btn btn-outline-success">Revisar</button></a>
                        </td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>    

    <?php include("partials/_javascript_import.php") ?>
</body>
</html>
