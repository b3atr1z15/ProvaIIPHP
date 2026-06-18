<?php
session_start();
require 'conexao.php';

$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); // Mantendo o padrão MD5 utilizado no login

    try {
        // Verifica se o e-mail já está cadastrado
        $stmt_check = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt_check->execute([$email]);
        
        if ($stmt_check->rowCount() > 0) {
            $mensagem = "Este e-mail já está cadastrado!";
            $tipo_mensagem = "danger";
        } else {
            // Insere o novo usuário
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $senha]);
            
            $mensagem = "Conta criada com sucesso! Você já pode fazer login.";
            $tipo_mensagem = "success";
        }
    } catch (PDOException $e) {
        $mensagem = "Erro ao criar conta: " . $e->getMessage();
        $tipo_mensagem = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta - Sistema CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100 fundo-login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Criar Nova Conta</h3>
                        
                        <?php if($mensagem): ?>
                            <div class="alert alert-<?= $tipo_mensagem; ?>"><?= $mensagem; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" name="nome" class="form-control" required placeholder="Seu nome">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" required placeholder="seu@email.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" required placeholder="Crie uma senha">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Registrar</button>
                            <div class="text-center">
                                <a href="index.php" class="text-decoration-none" style="color: var(--purple-primary);">Já tem uma conta? Entrar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>