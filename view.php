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


//Load site header
require("_header.php");

$aside = <<< HTML
<div class='aside'> 
    <img src="{$art['emp_photo']}" alt="{art['emp_name']}">
    <h3> {$art['emp_name']}</h3>
    <p>Idade: {$art['emp_age']} </p>
</div>

HTML;

?>

<article><?php echo $article ?></article>

<aside><?php echo $aside ?></aside>

<?php require("_footer.php"); ?>