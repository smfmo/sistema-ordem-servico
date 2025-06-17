<?php include 'includes/conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Ordens de Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Ordens de Serviço</h1>
        <a href="cadastrar.php" class="btn btn-primary mb-3">Nova Ordem</a>
        
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome do Cliente</th>
                    <th>Data de Abertura</th>
                    <th>Prioridade</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $sql = "SELECT * FROM ordens_servico ORDER BY data_abertura DESC";
                    $stmt = $conexao->query($sql);
                    
                    while ($ordem = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $classePrioridade = '';
                        echo "<tr class='$classePrioridade'>";
                        echo "<td>" . htmlspecialchars($ordem['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($ordem['nome_cliente']) . "</td>";
                        echo "<td>" . htmlspecialchars(date('d/m/Y', strtotime($ordem['data_abertura']))) . "</td>";
                        echo "<td>" . ucfirst(htmlspecialchars($ordem['prioridade'])) . "</td>";
                        echo "<td>" . ucfirst(str_replace('_', ' ', htmlspecialchars($ordem['situacao']))) . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6' class='text-danger'>Erro ao carregar ordens: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>