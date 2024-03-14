<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/<?php echo $page["css"] ?>">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Rabbid <?php echo $page["title"] ?></title>
</head>

<body>
    <header>
        <div class="header-nav-container">
            <div class="header-title-logo">
                <a href="index.php" title="Página inicial">
                    <img class="logo" src="assets/img/<?php echo $site["logo"] ?>" alt="Logotipo de Hello World">
                </a>
            </div>
            <div class="header-title">
                <h1>Hello World</h1>
                <small>Lendo e Aprendendo.</small>
            </div>
            <div class="header-search">
                <form class="form-wrapper" action="" method="get">
                <input class="input-search" name="q" id="search" placeholder="Pesquisar...">   
                <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </header>
    <nav>
        <a href="index.php" title="Página Inicial">
            <i class="fa-solid fa-house-chimney" style="text-decoration: none;"></i>

            <span>Início</span>
        </a>

        <a href="contacts.php" title="Fale Conosco">
            <i class="fa-solid fa-comment-dots"></i>
            <span>Contatos</span>
        </a>

        <a href="about.php" title="Sobre nós">
            <i class="fa-solid fa-circle-info"></i>
            <span>Sobre</span>
        </a>
        <a id="userAccess" href="login.php" title="Logue-se">
            <img id="userImg" src="" alt="">
            <i id="userIcon" class="fa-solid fa-right-to-bracket"></i>
            <span id="userLabel">Login</span>
        </a>
    </nav>

    <div id="container">
        <div id="wrap">
            <main>