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

/* If doesn't have articles */

if ($total == 0) :
    $articles = "<p>Não achei nada!</p>";
else:

    while ($art = $res->fetch_assoc()) :

        $articles .= <<<HTML
    
    <div onclick="location.href('view.php?id={$art['art_id']}')"> 
    
        <img src="{$art['art_thumbnail']}" alt="{$art['art_title']}">
        <div>
        <h4>{$art['art_title']}</h4>
        <p>{$art['art_summary']}</p>
    </div>

    </div>

    HTML;

    endwhile;

endif;
debug($articles);

exit();

/* Load header page  */
require("_header.php");


?>

<article></article>

<aside></aside>

<?php require("_footer.php"); ?>