<?php
require("_global.php");
$page = [
    "title" => "Perfil do Usuário",
    "css" => "profile.css",
    "js" => "profile.js",
];

require("_header.php");

?>

<article>
    <h2>Olá <span id="userName"> usuário</span>!</h2>
    <div id="userCard"></div>
    <p>Sua conta é gerenciada pelo Google. Cliquw no botão para acessar seu perfil no Google.</p>
    
    <p class="center">
        <button type="button" id="btnGoogleProfile">
            <i class="fa-brands fa-google fa-fw"></i>
            Acessar perfil no Google
        </button>
    </p>

    <p>Clique no botão abaixo para sair do aplicativo.</p>
    
    <p class="center">
        <button type="button" id="btnLogout">
            <i class="fa-solid fa-right-from-bracket fa-fw"></i>
            Logout / Sair
        </button>

    </p>

</article>

<aside>
    <h3>+ para você</h3>
</aside>

<?php require("_footer.php"); ?>