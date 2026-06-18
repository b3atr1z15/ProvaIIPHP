<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
require 'conexao.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

if (!$cliente) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $carro_marca = $_POST['carro_marca'];
    $carro_modelo = $_POST['carro_modelo'];
    $carro_placa = $_POST['carro_placa'];

    $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ?, carro_marca = ?, carro_modelo = ?, carro_placa = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $telefone, $carro_marca, $carro_modelo, $carro_placa, $id]);

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente e Carro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
</head>
<body class="bg-light py-5 fundo-editar">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Editar Cadastro</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <h5 class="text-muted mb-3">Dados do Cliente</h5>
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']); ?>" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($cliente['email']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($cliente['telefone']); ?>">
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-muted mb-3">Dados do Carro</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Marca</label>
                                    <input type="text" name="carro_marca" class="form-control" value="<?= htmlspecialchars($cliente['carro_marca']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" name="carro_modelo" class="form-control" value="<?= htmlspecialchars($cliente['carro_modelo']); ?>" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Placa do Veículo</label>
                                <input type="text" name="carro_placa" class="form-control" value="<?= htmlspecialchars($cliente['carro_placa']); ?>" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="dashboard.php" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>