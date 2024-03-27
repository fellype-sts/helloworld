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
-- Get id
	art_id
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
    $articles = "<h2>Artigos recentes</h2><p>Não achei nada!</p>";
else :

    // Título
    if ($total == 1) $articles = '<h2>Artigo mais recente</h2>';
    else $articles = "<h2>{$total} artigos mais recentes</h2>";

    // Loop para obter cada artigo
    while ($art = $res->fetch_assoc()) 

        $articles .= view_article($art['art_id']);

    

endif;

require('_header.php')
?>

<article>
   
    <?php echo $articles ?>
</article>

<aside> <?php 
require("widgets/_mostviewed.php");

require("widgets/_mostcommented.php");
?></aside>

<?php require("_footer.php"); ?>