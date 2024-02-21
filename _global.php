<?php 


header("Content-type: text/html; charset=utf-8");



$site = [
    "sitename" => "Olá Mundo",
    "title" => "Olá Mundo",
    "slogan" => "Lendo e Aprendendo",
    "logo" => "logo.png",
    "mysql_hostname" => "localhost",
    "mysql_username" => "root",
    "mysql_password" => "",
    "mysql_database" => "helloword"

];



// Debug
// print_r($site);
// exit();

$conn = new mysqli(
    $site["mysql_hostname"],
    $site["mysql_username"],
    $site["mysql_password"],
    $site["mysql_database"]
);

if ($conn->connect_error) die("Falha de conexão com o banco e dados: " . $conn->connect_error);
 /*********************************
 * Funções globais do aplicativo *
 *********************************/

// Função para debug
function debug($target, $exit = false ) {
    print_r($target);
    //var_dump($target);
    if($exit) exit();
}
//debug($site);
//debug($conn, true)

$sql = "SELECT art_id, art_title from article;";
$conn->query($sql);
$res = $conn->query($sql);
debug($res);

if($res -> num_rows > 0) { 
    echo 'achei algo';
    while ($article = $res->fetch_assoc()) {
        
        echo <<<output

        <div> 
        <img src="{$article['art_thumbnail']}" alt="{$article['art_title']}">
        <h4>{$article['art_title']}</h4>
        <p>{$article['art_summary']}</p>
        <p><a href="view.php?id={$article['art_id']}">Ver artigo completo</a></p>
        </div>
        output;
    }
} else {
    echo 'Nenhum artigo cadastrado.';
}


exit();

?>
