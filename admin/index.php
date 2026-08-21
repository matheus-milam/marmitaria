<?php
session_start();

if (!isset($_SESSION["admin_logado"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../imgs/logo.jpeg">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Akt:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Akt:wght@100..900&family=Instrument+Serif:ital@0;1&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <title>Sabôr do Céu - Admin</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom shadow" style="background-color: #2f6d4e;" data-bs-theme="light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?pagina=marmita">
                <img src="../imgs/logoheadermenor.png" alt="Sabor do Céu" width="70px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pagina=marmita">Marmitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pagina=pedido">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pagina=funcionario">Funcionários</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-outline-light">Sair</a>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <?php
        $pagina = $_GET["pagina"] ?? "marmita";
        $pagina = "pages/{$pagina}.php";

        if (file_exists($pagina)) {
            include $pagina;
        } else {
            include "../pages/erro.php";
        }
        ?>
    </main>

    <footer class="footer">
        <p>Sabor do Céu - Painel Administrativo | <?= date('Y') ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>