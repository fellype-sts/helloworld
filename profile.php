<?php
require("_global.php");
$page = [
    "title" => "Perfil do Usuário",
    "css" => "profile.css",
    "js" => "profile.js",
];


//Stores user id
$uid = isset($_GET['uid']) ? trim(htmlentities($_GET['uid'])) : '';

// HTML
$user_comments = '<h3>Seus comentários</h3>';

//If id exists
if ($uid != '') :

    
    $sql = <<<SQL

SELECT 
    cmt_content,
    art_id, art_title
FROM comment
    INNER JOIN article ON cmt_article = art_id
WHERE 
    -- Requisitos
    cmt_status = 'on'
    AND art_status = 'on'
    AND art_date <= NOW()
    AND cmt_social_id = ?
ORDER BY cmt_date DESC
LIMIT 5;

SQL;

    // Prepare and executes statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    //Get the result
    $res = $stmt->get_result();

    // Total registers
    $total = $res->num_rows;

    // If doesnt have
    if ($total > 0) :

        while ($art = $res->fetch_assoc()) :

            $cmt_content = $art['cmt_content'];
            if (strlen($cmt_content) > 40) {
                $cmt_content = substr($cmt_content, 0, 47) . "...";
            }

            $user_comments .= <<<HTML

<div class="box" onclick="location.href='view.php?id={$art['art_id']}'">
    <h5>{$art['art_title']}</h5>
    <small>{$cmt_content}</small>
</div>

HTML;

        endwhile;

    else :

        $user_comments .= <<<HTML

<p class="center">Você ainda não tem comentários. Acesse nossos <a href="index.php">artigos</a> e comente!</p>
        
HTML;

    endif;

    else :

        $user_comments .= <<<HTML
    
    <p class="center" id="linkToProfile"> Clique </p>
    
    HTML;

    
endif;




require("_header.php");
?>

<article>
    <h2>Olá <span id="userName"> usuário</span>!</h2>
    <div id="userCard"></div>
    <p>Sua conta é gerenciada pelo Google. Clique no botão para acessar seu perfil no Google.</p>
    
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
    <?php echo $user_comments ?>
</aside>

<?php require("_footer.php"); ?>