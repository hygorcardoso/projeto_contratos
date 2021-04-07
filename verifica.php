<?php 

    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/dao/ContratoDAO.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/utils/FlashMessages.php');


    $codigo = $_POST['codigo'];
    $data_entrega = $_POST['data_entrega'];
    $data_devolucao = $_POST['data_devolucao'];
    $data_retirada = $_POST['data_retirada'];
    $observacao = $_POST['observacao'];
    $contador = $_POST['contador'];
    $status = $_POST['status'];

    if($status == 0) {
        $valores = ContratoDAO::getCodigo($codigo)->fetch(PDO::FETCH_OBJ);

        if($valores->data_entrega != $data_entrega) {
            $retorno_data = ContratoDAO::alteraDataEntrega($data_entrega, $codigo);
    
            if(!isset($retorno_data)){
                Flashmessages::setMessage("Erro ao alterar data, caso persistir, contate o suporte.", "error");
                header('Location: /show.php?codigo=' . $codigo);
            }
    
            Flashmessages::setMessage("Revisão efetuada com sucesso", "sucess");
            
        }

        if($valores->data_devolucao != $data_devolucao) {
            $data_devolucao = date('d/m/Y', strtotime($data_devolucao));
            $retorno_data = ContratoDAO::alteraDataDevolucao($data_devolucao, $codigo);

            if(!isset($retorno_data)){
                Flashmessages::setMessage("Erro ao alterar data, caso persistir, contate o suporte.", "error");
                header('Location: /show.php?codigo=' . $codigo);
            }
    
            Flashmessages::setMessage("Revisão efetuada com sucesso", "sucess");
            
        }

        if($valores->data_retirada != $data_retirada) {
            $data_retirada = date('d/m/Y', strtotime($data_retirada));
            $retorno_data = ContratoDAO::alteraDataRetirada($data_retirada, $codigo);
    
            if(!isset($retorno_data)){
                Flashmessages::setMessage("Erro ao alterar data, caso persistir, contate o suporte.", "error");
                header('Location: /show.php?codigo=' . $codigo);
            }
    
            Flashmessages::setMessage("Revisão efetuada com sucesso", "sucess");
            
        }
    
        if($valores->observacao != $observacao) {
            $retorno_observacao = ContratoDAO::alteraObservacao($observacao, $codigo);
    
            if(!isset($retorno_observacao)){
                Flashmessages::setMessage("Erro ao revisar contrato, caso persistir, contate o suporte.", "error");
                return 0;
            }
    
            Flashmessages::setMessage("Revisão efetuada com sucesso", "sucess");
    
        }
    
        $i = 1;
        $produto = 0;
        if($contador) {
            do{
                if(isset($_POST['checkbox'. $i])){
                    $retorno_produto = ContratoDAO::atualizaProduto($_POST['checkbox'. $i]);
                    if(isset($retorno_produto)){
                        $produto++;
                    }
                }
                $i++;
            } while($i <= $contador);
    
            if($produto > 0) {
                $retorno_status = ContratoDAO::atualizaPedido($codigo);
    
                if(!isset($retorno_status)){
                    Flashmessages::setMessage("Erro ao revisar contrato, caso persistir, contate o suporte.", "error");
                    header('Location: /show.php?codigo=' . $codigo);
                    return 0;
                }
    
                $retorno_status = null;
                Flashmessages::setMessage("Adicione o produto no contrato, e conclua a revisão", "info");
                header('Location: /show.php?codigo=' . $codigo . "&status=1");
                return 0;
                
            }
        }
    
        header('Location: /index.php');
    } else {
        $retorno_status = ContratoDAO::atualizaStatus($codigo);

        if(!isset($retorno_status)){
            Flashmessages::setMessage("Erro ao revisar contrato, caso persistir, contate o suporte.", "error");
            header('Location: /show.php?codigo=' . $codigo);
            return 0;
        }

        Flashmessages::setMessage("Revisão efetuada com sucesso", "sucess");
        header('Location: /index.php');
        return 0;

    }
?>
