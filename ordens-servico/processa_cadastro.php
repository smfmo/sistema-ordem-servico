<?php
include 'includes/conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validação dos dados
        $nome_cliente = htmlspecialchars($_POST['nome_cliente'] ?? '', ENT_QUOTES, 'UTF-8');
        $descricao_servico = htmlspecialchars($_POST['descricao_servico'] ?? '', ENT_QUOTES, 'UTF-8');
        $data_abertura = $_POST['data_abertura'] ?? '';
        $prioridade = $_POST['prioridade'] ?? '';
        $situacao = $_POST['situacao'] ?? ''; 

        $prioridadesValidas = ['baixa', 'media', 'alta'];
        $situacoesValidas = ['aberto', 'em_andamento', 'concluido'];

        if (!in_array($prioridade, $prioridadesValidas) || !in_array($situacao, $situacoesValidas)) {
            throw new Exception("Valores inválidos para a prioridade ou situação.");
        }

        $sql = "INSERT INTO ordens_servico (nome_cliente, descricao_servico, data_abertura, prioridade, situacao)
                VALUES (:nome_cliente, :descricao_servico, :data_abertura, :prioridade, :situacao)";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome_cliente', $nome_cliente);
        $stmt->bindParam(':descricao_servico', $descricao_servico);
        $stmt->bindParam(':data_abertura', $data_abertura);
        $stmt->bindParam(':prioridade', $prioridade);
        $stmt->bindParam(':situacao', $situacao);

        if ($stmt->execute()) {
            echo "<div style='
                margin: 50px auto;
                padding: 20px;
                max-width: 500px;
                font-family: Arial, sans-serif;
                background-color: #e0ffe0;
                border: 1px solid #4CAF50;
                border-radius: 8px;
                text-align: center;
            '>
                <h3>Cadastro realizado com sucesso!</h3>
                <p>Você será redirecionado para a lista em 3 segundos...</p>
            </div>";

            header("refresh:3;url=listar.php");
            exit;
        } else {
            throw new Exception("Erro ao executar a inserção.");
        }
    } catch (Exception $e) {
        echo "<div style='
            margin: 50px auto;
            padding: 20px;
            max-width: 500px;
            font-family: Arial, sans-serif;
            background-color: #ffe0e0;
            border: 1px solid #f44336;
            border-radius: 8px;
            text-align: center;
        '>
            <h3>Erro ao cadastrar:</h3>
            <p>" . htmlspecialchars($e->getMessage()) . "</p>
            <p>Você será redirecionado para o formulário em 5 segundos...</p>
        </div>";

        header("refresh:5;url=cadastrar.php");
        exit;
    }
} else {
    header("Location: cadastrar.php");
    exit;
}