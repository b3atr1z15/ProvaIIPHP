<?php
session_start();
require 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); 

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->execute([$email, $senha]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilo.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100 fundo-login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Acessar Sistema</h3>
                        <?php if($erro): ?>
                            <div class="alert alert-danger"><?= $erro; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" required placeholder="admin@teste.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" required placeholder="123456">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Entrar</button>
                            
                            <a href="criar_conta.php" class="btn btn-outline-primary w-100">Criar Nova Conta</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>