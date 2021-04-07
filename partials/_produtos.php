<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/dao/ContratoDAO.php');

    $stmt_produto = ContratoDAO::getProdutos($codigo);

    $contador = ContratoDAO::getContador($codigo);

?>

<link rel="stylesheet" href="/css/_produtos.css">

<table>
    <thead>
        <th id="codigo">Código</th>
        <th id="descricao">Descrição</th>
        <th id="preco">Preço Uni.</th>
        <th id="total">Preço</th>
        <th id="quantidade">Qtd</th>
        <th id="cancelado">Cancelado</th>
        <th id="cancelar">Cancelar</th>
    </thead>
    <tbody>
        <?php while($produto = $stmt_produto->fetch(PDO::FETCH_OBJ)) : ?>
            
            <tr>
                <td><?= $produto->codigoproduto ?></td>
                <td><?= $produto->nomeproduto ?></td>
                <td><?= $produto->preco ?></td>
                <td><?= $produto->total ?></td>
                <td><?= str_replace('.', ',', $produto->quantidade) ?></td>
                <td><?= $produto->cancelado ?></td>
                <?php if($produto->cancelado == "Não")  :?>
                    <td><input type="checkbox" name="checkbox<?= $produto->contador?>" id="checkbox<?= $produto->contador?>" value="<?= $produto->id ?>"></td>
                <?php endif ?>
            </tr>
        <?php endwhile ?>

        <input type="hidden" name="contador" id="contador" value=" <?= $contador?>">
    </tbody>
</table>
