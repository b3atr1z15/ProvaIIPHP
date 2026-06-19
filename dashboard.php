<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
require 'conexao.php';

// Consulta os clientes e seus respectivos carros
$stmt = $pdo->query("
    SELECT clientes.*, usuarios.nome AS cadastrado_por 
    FROM clientes 
    INNER JOIN usuarios ON clientes.usuario_id = usuarios.id 
    ORDER BY clientes.id DESC
");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Clientes e Carros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
</head>
<body class="bg-light fundo-dashboard">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-text text-white me-auto">
                Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['usuario_nome']); ?></strong>!
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm">Sair do Sistema</a>
        </div>
    </nav>

  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-dark">Controle de Clientes e Veículos</h2>
        
        <div class="d-flex gap-2">
            <a href="cadastrar.php" class="btn btn-success">Cadastrar Cliente/Carro</a>
            <a href="relatorio.php" class="btn btn-info">Gerar PDF</a>
        </div>
        
    </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Contato</th>
                            <th>Veículo (Marca/Modelo)</th>
                            <th>Placa</th>
                            <th>Cadastrado Por</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($clientes) > 0): ?>
                            <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?= $cliente['id']; ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($cliente['nome']); ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($cliente['email']); ?></small>
                                </td>
                                <td><?= htmlspecialchars($cliente['telefone']); ?></td>
                                <td><?= htmlspecialchars($cliente['carro_marca']) . ' - ' . htmlspecialchars($cliente['carro_modelo']); ?></td>
                                <td><span class="badge bg-secondary p-2"><?= htmlspecialchars($cliente['carro_placa']); ?></span></td>
                                <td><strong class="text-dark"><?= htmlspecialchars($cliente['cadastrado_por']); ?></strong></td>
                                
                                <td>
                                    <a href="editar.php?id=<?= $cliente['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="deletar.php?id=<?= $cliente['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este registro?')">Deletar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Nenhum veículo cadastrado até o momento.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>