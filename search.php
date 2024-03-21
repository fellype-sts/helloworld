<?php

// Carrega configurações globais
require("_global.php");

// Configurações desta página
$page = array(
    "title" => "Procurando...",
    "css" => "index.css",
    "js" => "search.js"
);

// Incializa variável da view
$search_view = '';

$total = '';

// Obtém o termo de busca da URL
$query = isset($_GET['q']) ? trim(htmlentities(strip_tags($_GET['q']))) : '';

// Se a query NÃO está vazia
if ($query != '') :

    // Consulta SQL usa prepared statement
    $sql = <<<SQL

-- Referências: https://www.w3schools.com/mysql/mysql_like.asp

SELECT 
	art_id, art_thumbnail, art_title, art_summary 
FROM article 
WHERE
	-- Requisitos padrão
    art_date <= NOW()
    AND art_status = 'on'
    -- Busca
    AND art_title LIKE ?
    OR art_summary LIKE ?
    OR art_content LIKE ?
ORDER BY art_date DESC;

SQL;

    // Prepara a query de busca
    $search_query = "%{$query}%";

    // Prepara e executa o statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'sss',
        $search_query,
        $search_query,
        $search_query
    );
    $stmt->execute();
    // Obtém o resultado da consulta
    $res = $stmt->get_result();

    // Total de registros
    $total = $res->num_rows;

    // Se vieram registros:
    if ($total > 0) :

        // Processa o total de resultados
        if ($total == 1) $viewtotal = '1 resultato';
        else $viewtotal = "{$total} resultados";

        $search_view .= <<<HTML
        
<h2>Procurando por {$query}</h2>
<p><small class="authordate">{$viewtotal}</small></p>

HTML;

        while ($art = $res->fetch_assoc()) :

            $search_view .= <<<HTML

<div class="article" onclick="location.href = 'view.php?id={$art['art_id']}'">
    <img src="{$art['art_thumbnail']}" alt="{$art['art_title']}">
    <div>
        <h4>{$art['art_title']}</h4>
        <p>{$art['art_summary']}</p>
    </div>
</div>

HTML;

        endwhile;

    // Se não achou nada:
    else :
        $search_view .= <<<HTML

<h2>Procurando por {$query}</h2>
<p class="center">Nenhum conteúdo encontrado com "{$query}".</p>

HTML;

    endif;

else :

    $search_view .= <<<HTML

<h2>Procurando...</h2>
<p class="center">Digite algo no campo de busca!</p>

HTML;

endif;


//exit();
$sql2 = <<<SQL
SELECT art_id, art_title, art_summary, art_thumbnail FROM article 
ORDER BY art_views DESC
LIMIT 3;
SQL;
$aside = "";
//Call SQL
$result = $conn->query($sql2);

while ($mv = $result->fetch_assoc()) :

    // Cria uma variável '$art_summary' para o resumo
    $art_summary = $mv['art_summary'];

    // Se o resumo tem mais de X caracteres
    // Referências: https://www.w3schools.com/php/func_string_strlen.asp
    if (strlen($mv['art_summary']) > $site['summary_length'])

        // Corta o resumo para a quantidade de caracteres correta
        // Referências: https://www.php.net/mb_substr
        $art_summary = mb_substr(
            $mv['art_summary'],         // String completa, a ser cortada
            0,                          // Posição do primeiro caracter do corte
            $site['summary_length']     // Tamanho do corte
        ) . "...";                      // Concatena reticências no final

    $aside .= <<<HTML

<div class="aside" onclick="location.href = 'view.php?id={$mv['art_id']}'">
<img src="{$mv['art_thumbnail']}" alt="{$mv['art_title']}">
<div>
    <h4>{$mv['art_title']}</h4>
    <p>{$mv['art_summary']}</p>
</div>
</div>

HTML;
endwhile;

// Inclui o cabeçalho do documento
require('_header.php');
?>

<article>
    <?php
    // Exibe a view
    echo $search_view;
    ?>
</article>

<aside><?php echo $aside ?></aside>

<?php
// Inclui o rodapé do documento
require('_footer.php');
?>