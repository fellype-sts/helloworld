<?php 

//Get a list with most commented articles in the site
$sql = <<<SQL

SELECT cmt_article, art_title, art_summary
FROM comment INNER JOIN article WHERE cmt_article = art_id AND cmt_status = 'on'
GROUP BY cmt_article
ORDER BY COUNT(*) DESC
LIMIT 3;
SQL;

// execute the querry and stores result in res
$res = $conn->query($sql);

//Variable that stores the html
$aside_cmt = '<h3>Artigos + comentados</h3><div class="viewed">';

// Loop to get each register
while ($most_cmt = $res->fetch_assoc()) {

    // Create a var to store teh summary
    $art_summary = $most_cmt['art_summary'];

    //If summary is too long
    if(strlen($most_cmt['art_summary']) > $site['summary_length'])
    $art_summary= mb_substr(
        $most_cmt['art_summaty'], 0, $site['summary_length']
    ). "...";

    //Build the HTML
    $aside_cmt .= <<<HTML

<div onclick="loction.href = 'view.php?id={$most_cmt['art_id']}'">
    <div>
    <h5>{$most_cmt['art_title']}</h5>
    <p><small title="{most_cmt['art_summary']}">{$art_summary}</small></p>
    </div>
</div>
HTML;
}
$aside_cmt .= '</div>'
?>