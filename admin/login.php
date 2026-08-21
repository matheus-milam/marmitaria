<?php
session_start();

$email_admin = "admin@gmail.com";
$senha_admin = "sabor123";

if (isset($_POST["entrar"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if ($email === $email_admin && $senha === $senha_admin) {
        $_SESSION["admin_logado"] = true;
        header("Location: index.php?pagina=marmita");
        exit;
    }else

    $erro = "E-mail ou senha inválidos";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Sabor do Céu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 350px;">
            <h4 class="mb-3 text-center">Área Administrativa</h4>

            <?php if (isset($erro)) { ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php } ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <button type="submit" name="entrar" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>