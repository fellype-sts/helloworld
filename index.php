<?php
require("_global.php");
$page = [
    "title" => $site['slogan'],
    "css" => "index.css",
    "js" => "index.js",
];
/** 
 * List articles of database
 * Rules / Parameters:
 * - Ordered by date , more recent comes first
 * - Get only old articles and recent articles
 *      -Don't get articles scheduled to future
 * - Get only articles with status : 'on'
 * - Get the id, thumbnail, title, and summary fields
 **/
$sql = <<<SQL

SELECT 
-- Get id, title, thumbnail, summary field
	art_id, art_date, art_thumbnail,art_title, art_summary
FROM article

-- Filters 
	WHERE
-- 	Get only recent or past articles
-- Don't get scheduled articles to future
	 art_date <= NOW()
     
-- Get only articles with status on
	AND art_status = 'on'
-- Ordered by most recent date
ORDER BY art_date DESC;
SQL;

/* Execute SQL and store the result in res  */
$res = $conn->query($sql);

/*Count total number of rows*/

$total = $res->num_rows;

/*Variable that stores a list of articles in HTML*/
$articles = "<p>Total de {$total} artigos.</p>";

/*Variable that stores a list of most viewed articles in aside */


/* If doesn't have articles */

if ($total == 0) :
    $articles = "<p>Não achei nada!</p>";
else :

    while ($art = $res->fetch_assoc()) :

        $articles .= <<<HTML
    
    <div class="article" onclick="location.href = 'view.php?id={$art['art_id']}'">
    <img src="{$art['art_thumbnail']}" alt="{$art['art_title']}">
    <div>
        <h4>{$art['art_title']}</h4>
        <p>{$art['art_summary']}</p>
    </div>
    </div>

    HTML;

    endwhile;

endif;
//debug($articles);

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

//debug($aside,true);
/* Load header page  */
require("_header.php");


?>

<article>
    <h2><?php echo $total ?> artigos mais recentes</h2>
    <?php echo $articles ?>
</article>

<aside><h3>Artigos mais Vistos</h3>
<?php echo $aside ?>
</aside>

<?php require("_footer.php"); ?>