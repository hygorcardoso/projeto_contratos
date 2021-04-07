<?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/utils/ConnectionFactory.php');

    class ContratoDAO {
        
        public static function getAll() {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("SELECT d.id, d.codigo, e.nome, d.data, CAST(d.valor AS money) AS valor FROM dav d INNER JOIN entidade e ON d.idcliente = e.id ORDER BY d.codigo DESC;");
            $stmt->execute();

            return $stmt;
        }

        public static function getCodigo($codigo){
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("SELECT d.id, d.codigo, e.nome, CAST(d.data AS date) AS data_emissao, CAST(d.entrega AS date) AS data_entrega, CAST(d.extra6 AS date) AS data_devolucao, CAST(d.extra7 AS date) AS data_retirada, CAST(d.valor AS money) AS valor, d.observacao FROM dav d INNER JOIN entidade e ON d.idcliente = e.id WHERE d.codigo = :codigo;");
            $stmt->bindValue(":codigo", $codigo);
            $stmt->execute();

            return $stmt;
        }

        public static function getProdutos($codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("SELECT contador, id, codigoproduto, nomeproduto, CAST(preco AS money) AS preco, CAST(total AS money) AS total, ROUND(quantidade, 2) AS quantidade, case when cancelado = 1 then 'Sim' else 'Não' end as cancelado FROM davitem WHERE iddav in (SELECT id FROM dav WHERE codigo = :codigo) ORDER BY contador");
            $stmt->bindValue(":codigo", $codigo);
            $stmt->execute();

            return $stmt; 
        }

        public static function alteraDataEntrega($data_entrega, $codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("UPDATE dav SET entrega = :data_entrega WHERE codigo = :codigo");
            $stmt->bindValue(":data_entrega", $data_entrega);
            $stmt->bindValue(":codigo", $codigo);

            return $stmt->execute();
        }

        public static function alteraDataDevolucao($data_devolucao, $codigo) {

            $con = ConnectionFactory::getConnection();  

            $stmt = $con->prepare("UPDATE dav SET extra6 = :data_devolucao WHERE codigo = :codigo");
            $stmt->bindValue(":data_devolucao", $data_devolucao);
            $stmt->bindValue(":codigo", $codigo);

            return $stmt->execute();
        }

        public static function alteraDataRetirada($data_retirada, $codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("UPDATE dav SET extra7 = :data_retirada WHERE codigo = :codigo");
            $stmt->bindValue(":data_retirada", $data_retirada);
            $stmt->bindValue(":codigo", $codigo);

            return $stmt->execute();
        }

        public static function alteraObservacao($observacao, $codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("UPDATE dav SET observacao = :observacao WHERE codigo = :codigo");
            $stmt->bindValue(":observacao", $observacao);
            $stmt->bindValue(":codigo", $codigo);

            return $stmt->execute();
        }

        public static function getContador($codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("SELECT MAX(contador) AS contador FROM davitem WHERE iddav = (SELECT id FROM dav WHERE codigo = :codigo); ");
            $stmt->bindValue(":codigo", $codigo);
            $stmt->execute();

            $contador = $stmt->fetch(PDO::FETCH_OBJ);

            return $contador->contador;
        }

        public static function atualizaProduto($produto) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("UPDATE davitem SET cancelado = '1' WHERE id = :produto");
            $stmt->bindValue(":produto", $produto);

            return $stmt->execute();
        }

        public static function atualizaPedido($codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("UPDATE dav SET descontosubtotal = '0.00', status = '7', percentualdescontosubtotal = '0.00' WHERE codigo = :codigo");
            $stmt->bindValue(":codigo", $codigo);

            return $stmt->execute();
        }

        public static function atualizaStatus($codigo) {
            $con = ConnectionFactory::getConnection();

            $stmt = $con->prepare("UPDATE dav SET status = '1' WHERE codigo = :codigo ");
            $stmt->bindValue(":codigo", $codigo);

            return $stmt->execute();
        }

    }
?>
