<?php include 'includes/conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Ordem de Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastrar Ordem de Serviço</h1>
        
        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">
                Ordem cadastrada com sucesso!
            </div>
        <?php elseif (isset($_GET['erro'])): ?>
            <div class="alert alert-danger">
                Erro ao cadastrar ordem: <?= htmlspecialchars($_GET['erro']) ?>
            </div>
        <?php endif; ?>
        <div class="card shadow p-4 rounded">
            <h4 class="mb-4 text-center text-primary">Nova Ordem de Serviço</h4>

            <form action="processa_cadastro.php" method="POST">
                <div class="mb-3">
                    <label for="nome_cliente" class="form-label">Nome do Cliente</label>
                    <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
                </div>
                
                <div class="mb-3">
                    <label for="descricao_servico" class="form-label">Descrição do Serviço</label>
                    <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="data_abertura" class="form-label">Data de Abertura</label>
                    <input type="date" class="form-control" id="data_abertura" name="data_abertura" required>
                </div>
                
                <div class="mb-3">
                    <label for="prioridade" class="form-label">Prioridade</label>
                    <select class="form-select" id="prioridade" name="prioridade" required>
                        <option value="">Selecione a prioridade</option>
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="situacao" class="form-label">Situação</label>
                    <select class="form-select" id="situacao" name="situacao" required>
                        <option value="">Selecione a situação</option>
                        <option value="aberto">Aberto</option>
                        <option value="em_andamento">Em andamento</option>
                        <option value="concluido">Concluído</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="listar.php" class="btn btn-secondary">Ver Ordens</a>
            </form>
        </div>
      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>