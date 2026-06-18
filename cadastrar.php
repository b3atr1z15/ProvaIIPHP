<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $carro_marca = $_POST['carro_marca'];
    $carro_modelo = $_POST['carro_modelo'];
    $carro_placa = $_POST['carro_placa'];

    $usuario_id = $_SESSION['usuario_id'];
$stmt = $pdo->prepare("INSERT INTO clientes (usuario_id, nome, email, telefone, carro_marca, carro_modelo, carro_placa) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$usuario_id, $nome, $email, $telefone, $carro_marca, $carro_modelo, $carro_placa]);
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente e Carro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
</head>
<body class="bg-light py-5 fundo-cadastro ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Cadastrar Cliente e Veículo</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <h5 class="text-muted mb-3">Dados do Cliente</h5>
                            <div class="mb-3">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone" class="form-control">
                                </div>
                            </div>

                            <hr>
                            <h5 class="text-muted mb-3">Dados do Carro</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Marca</label>
                                    <input type="text" name="carro_marca" class="form-control" placeholder="Ex: Ford" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" name="carro_modelo" class="form-control" placeholder="Ex: Fiesta" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Placa do Veículo</label>
                                <input type="text" name="carro_placa" class="form-control" placeholder="Ex: ABC-1234" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="dashboard.php" class="btn btn-secondary">Voltar</a>
                                <button type="submit" class="btn btn-success">Salvar Cadastro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>