<?php
require("_global.php");

$page = [
    "title" => "Artigo Completo",
    "css" => "view.css",
    "js" => "view.js",
];

// Get article ID and stores it in 'id' variable

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Valid id
//References  https://www.w3schools.com/php/func_network_header.asp
if ($id < 0) header ('Location: 404.php');

// Get article from database
$sql = <<<SQL

SELECT
	-- Get necessary 'article' fields
	art_id, art_title, art_content, 
    
    -- Get necessary 'employee' fields
    emp_id, emp_photo, emp_name, emp_type,
    
    -- Get date in brazilian format
    DATE_FORMAT(art_date, "%e/%m/%Y às %H:%i") AS art_datebr,
    
    -- Get sing up date of employee to pseudo_field emp_datebr
    DATE_FORMAT(emp_date, "%e/%m/%Y às %H:%i") AS emp_datebr,
    
    -- Calculate the age of employee
     TIMESTAMPDIFF(YEAR,emp_birth, CURDATE()) AS emp_age
     
     -- Original Column
	FROM `article` 
	INNER JOIN `employee` ON art_author = emp_id

WHERE art_id = '{$id}'
	AND art_date <= NOW()
    AND art_status = 'on';
SQL;

//Execute SQL
$res = $conn->query($sql);

// If articles doesn't exist show 404
if($res->num_rows == 0) header ('Location: 404.php');

//Get the article and stores in $art

$art = $res->fetch_assoc();

//Change title page

$page['title'] = $art['art_title'];

//debug($art,true);

//Load view to user

$article = <<<ART

<div class="article">
    <h2>{$art['art_title']}</h2>
    <small>Por {$art['emp_name']} em {$art['art_datebr']}.</small>
    <div>{$art['art_content']}</div>
</div>

ART;

//Uptade number of views of article
$sql = <<<SQL
UPDATE article 
    SET art_views = art_views + 1 
WHERE art_id = '{$id}';
SQL;
$conn->query($sql);

// Select author type
switch ($art['emp_type']) {
    case 'admin':
        $emp_type = 'administrador(a)';
        break;
    case 'author':
        $emp_type = 'autor(a)';
        break;
    case 'moderator':
        $emp_type = 'moderador(a)';
        break;
    default:
        $emp_type = 'indefinido(a)';
};

//Creat view aside to author
$aside_author = <<<HTML

<div class="aside-author">
    <img src="{$art['emp_photo']}" alt="{$art['emp_name']}">
    <h4>{$art['emp_name']}</h4>
    <ul>
        <li>{$art['emp_age']} anos</li>    
        <li>Colaborador desde {$art['emp_datebr']} como {$emp_type}.</li>
    </ul>
</div>

HTML;

// Get others articles of authors
$sql = <<<SQL

SELECT
	art_id, art_thumbnail, art_title    
FROM `article`
WHERE 

	art_author = '{$art['emp_id']}'
   
    AND art_id != '{$art['art_id']}'
    
    AND art_date <= NOW()
    
    AND art_status = 'on'

ORDER BY RAND()

LIMIT 3;

SQL;
$res = $conn->query($sql);

// Inicializa a view
$aside_articles = '<div class="aside-article"><h4>+ Artigos</h4>' . "\n";



// Loop
while ($aart = $res->fetch_assoc()) :

    $aside_articles .= <<<HTML
<div onclick="location.href:'/view.php?id={$aart['art_id']}'">
<img src="{$aart['art_thumbnail']}" alt="{$aart['art_title']}">
<h5>{$aart['art_title']}</h5>
</div>

HTML;

endwhile;

// Fecha view
$aside_articles .= '</div>';

//Load site header
require("_header.php");

?>

<article><?php echo $article ?>
<?php require("widgets/_comments.php")?>
</article>

<aside><?php
    echo $aside_author; 
    echo $aside_articles; 
    ?></aside>

<?php require("_footer.php"); ?>