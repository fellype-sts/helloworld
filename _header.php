<?php
// Testa se solicitou a inclusão dos arquivos ".css" e ".js"
$_css = $_js = '';
if (isset($page['css']))
    $_css = '<link rel="stylesheet" href="assets/css/' . $page["css"] . '">' . "\n";

if (isset($page['js']))
    $_js = '<script src="assets/js/' . $page["js"] . '"></script>' . "\n";
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/global.css">
    <?php echo $_css ?>
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Rabbid <?php echo $page["title"] ?></title>
</head>

<body>
    <div id="wrap">
        <header>
            <div class="header-title-logo">
                <a href="index.php" title="Página inicial">
                    <img class="logo" src="assets/img/<?php echo $site["logo"]?>" alt="Logotipo de Hello World">
                </a>
                <div class="header-title">
                    <h1>Hello World</h1>
                    <small>Lendo e Aprendendo.</small>
                </div>
            </div>
            <div class="header-search">
                <form class="form-wrapper" action="" method="get">
                    <input type="search" name="q" id="search" placeholder="Pesquisar...">
                    <button type="submit" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
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
            <img id="userImg"src="" alt="Login de Usuário" referrerpolicy="no-referrer">
            <i id="userIcon" class="fa-solid fa-right-to-bracket"></i>
                <span id="userLabel">Login</span>
            </a>
        </nav>

        <main>