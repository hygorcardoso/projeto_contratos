<?php 

    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/dao/CategoriaDAO.php');

    $stmt_categoria_sidebar = CategoriaDAO::getAll();

?>

<aside class="col-md-3">
    <h2>Categorias</h2>
    <ul>
        <?php while($categoria_sidebar = $stmt_categoria_sidebar->fetch(PDO::FETCH_OBJ)) : ?>
            <li><a href="/?categoria_id=<?= $categoria_sidebar->id ?>"><?= $categoria_sidebar->nome ?></a></li>
        <?php endwhile ?>
    </ul>
</aside>