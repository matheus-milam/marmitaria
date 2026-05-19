<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="imgs/logo.jpeg">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
   
<title>Sabôr do Céu</title>
</head>
<body>
    <header class="header">
        <a href="home" title="home" class="header-logo">
            <img src="imgs/logoHeader.png" alt="Sabôr do Céu">
        </a>
        <a href="javascript:mostrarMenu()" title="Mostrar Menu" class="header-menu">
            <img src="imgs/menu.png" alt="Menu">
        </a>
        <nav class="header-nav">
            <ul>
            <li><a href="index.php?pagina=home">Home</a></li>
            <li><a href="index.php?pagina=cardapio">Cárdapio</a></li>
            <li><a href="index.php?pagina=contato">Contato</a></li>
            <li><a href="index.php?pagina=sobre">Sobre</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <?php
        $pagina = $_GET["pagina"] ?? "home";
        $pagina = "pages/{$pagina}.php";
        
        if(file_exists($pagina)) {
        include $pagina;
        }else {
        include "pages/erro.php";
        }
    ?>
</main>

<footer class="footer">
    <p>Desenvolvido por Matheus Milam</p>
    

</footer>


<script>
    function mostrarMenu() {
        var menu = document.querySelector(".header-nav");
        menu.classList.toggle("mostrar");
    }
</script>
</body>



</html>

