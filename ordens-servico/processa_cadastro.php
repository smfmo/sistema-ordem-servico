<?php
include 'includes/conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{
        //validação dos dados
        $nome_cliente = htmlspecialchars($_POST['nome_cliente'] ?? '', ENT_QUOTES, 'UTF-8');
        $descricao_servico = htmlspecialchars($_POST['descricao_servico'] ?? '', ENT_QUOTES, 'UTF-8');
        $data_abertura = $_POST['data_abertura'] ?? '';
        $prioridade =  $_POST['prioridade'] ?? '';
        $situacao =  $_POST['situacao'] ?? ''; 
        $prioridadesValidas = ['baixa', 'media', 'alta'];
        $situacoesValidas = ['aberto', 'em_andamento', 'concluido'];

        if(!in_array($prioridade, $prioridadesValidas) || !in_array($situacao, $situacoesValidas)){
            throw new Exception("Valores inválidos para a prioridade ou situação.");
        }

        $sql =
         "INSERT INTO ordens_servico (nome_cliente, descricao_servico, data_abertura, prioridade,situacao)
            VALUES (:nome_cliente, :descricao_servico, :data_abertura, :prioridade, :situacao)";
        
        $stmt = $conexao->prepare($sql);
        $stmt-> bindParam(':nome_cliente', $nome_cliente);
        $stmt-> bindParam(':descricao_servico', $descricao_servico);
        $stmt-> bindParam(':data_abertura', $data_abertura);
        $stmt-> bindParam(':prioridade', $prioridade);
        $stmt-> bindParam(':situacao', $situacao);

        if($stmt->execute()){
            header("Location: cadastrar.php?sucesso=true");
        } else{
            throw new Exception("Erro ao executar a inserção.");
        }
    } catch(Exception $e){
        header("Location: cadastrar.php?erro=" . urlencode($e->getMessage()));
    }
}else{
        header("Location: cadastrar.php");
    }

exit();
?>