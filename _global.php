<?php


header("Content-type: text/html; charset=utf-8");
setlocale(LC_ALL, 'pt_BR.UTF8');
mb_internal_encoding('UTF8');
mb_regex_encoding('UTF8');
/* Global Settings of the site, set on your demand*/

$site = [
    "sitename" => "Hello Word",
    "title" => "Olá Mundo",
    "slogan" => "Lendo e Aprendendo",
    "logo" => "logo.png",
    "mysql_hostname" => "localhost",
    "mysql_username" => "root",
    "mysql_password" => "",
    "mysql_database" => "helloword",
    "summary_length" => 40,
    "social_list" => [
        [
            "name" => "GitHub.com",
            "link" => "https://github.com/fellype-sts",
            "icon" => "fa-brands fa-square-github fa-fw",
            "color" => "#333"
        ], [
            "name" => "LinkedIn",
            "link" => "https://www.linkedin.com/in/luferat/",
            "icon" => "fa-brands fa-linkedin fa-fw",
            "color" => "#0a66c2"
        ]
    ]
];


/* Connect MySQL with MySQLi*/
$conn = new mysqli(
    $site["mysql_hostname"],
    $site["mysql_username"],
    $site["mysql_password"],
    $site["mysql_database"]
);

/* For error in connection with database*/
if ($conn->connect_error) die("Falha de conexão com o banco e dados: " . $conn->connect_error);

/*Set charset*/
$conn->query("SET NAMES 'utf8'");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');
/*Set Date to brazilian format*/
$conn->query('SET GLOBAL lc_time_names = pt_BR');
$conn->query('SET lc_time_names = pt_BR');

/*********************************
 * Globals Functions of the site *
 *********************************/

/**
 * Function for debugging
 * References:
 * https://www.w3schools.com/tags/tag_pre.asp
 * https://www.w3schools.com/php/func_var_var_dump.asp
 * https://www.w3schools.com/php/func_var_print_r.asp
 *Examples of use:
 * debug($site); → Debug $site without application disruption.
 * debug($conn, true); → $conn debug started the application.
 * The first parameter is mandatory, type "any", being the target element to be "debugged"
 * The second parameter is optional, type "boolean", being:
 * If false → (Default) shows the target debug and follows the application execution
 *If true → shows the target debug and ends the application execution
 * Tip: switch between print_r() and var_dump() to see what is best for your case,
 * just comment one and uncomment another in the function code.
 **/
function debug($target, $exit = false)
{
    print_r($target);
    //var_dump($target);
    if ($exit) exit();
}
/**
 * Função que exibe um artigo pelo id na forma de card ou banner.
 **/
function view_article($article_id)
{

    // Obtém a variável $conn
    global $conn;

    // Obtém o artigo do banco de dados conforme o ID
    $sql = <<<SQL

SELECT 
	art_id, art_thumbnail, art_title, art_summary
FROM article
WHERE 
    art_id = '{$article_id}';

SQL;

    $res = $conn->query($sql);
    $art = $res->fetch_assoc();

    // Retorna para o chamador
    return <<<HTML

        <div class="article" onclick="location.href = 'view.php?id={$art['art_id']}'">
        <img src="{$art['art_thumbnail']}" alt="{$art['art_title']}">
        <div>
            <h4>{$art['art_title']}</h4>
            <p>{$art['art_summary']}</p>
        </div>
        </div>

    HTML;
}
function aside_box($data = [])
{

    // Se o array de parâmetros está vazio, retorna vazio
    if (empty($data))
        return '';

    // Inicializa variáveis
    $clicked = $title = $body = $body_content = $footer = '';

    // Testa se enviou um link na chave 'href'
    if (isset($data['href']))
        $clicked = 'class="clicked" onclick="location.href = \'' . $data['href'] . '\'"';

    // Testa se envoiu um título na chave 'title'
    if (isset($data['title']))
        $title = "<h5>{$data['title']}</h5>";

    // Testa se enviou um conteúdo na chave 'body'
    if (isset($data['body'])) {

        // Testa se solicitou o corte do conteúdo
        if (isset($data['limit']))
            // Excuta o corte
            $body_content = cutString($data['body'], $data['limit']);
        else
            $body_content = $data['body'];

        $body = '<small title="' . $data['body'] . '">' . $body_content . '</small>';
    }

    // Testa se solicitou um footer na chave 'footer'
    if (isset($data['footer']))
        $footer = '<small class="footer">' . $data['footer'] . '</small>';

    $out = <<<HTML

        <div {$clicked}>
            {$title}
            {$body}
            {$footer}
        </div>

    HTML;

    // Se solicitou o echo na saída (navegador)
    if (isset($data['echo']))
        echo $out;

    // Retorna o resultado da função para o chamador
    return $out;
}

/**
 * Função que corta uma string
 * Caso a string tenha mais de XX caracteres, ela será cortada e terá "..." no final do corte
 **/
function cutString($string, $limit = 50, $sufix = "...")
{
    if (strlen($string) > $limit) {
        // Corta a string no limite especificado
        $string = substr($string, 0, $limit - strlen($sufix)) . $sufix;
    }
    return $string;
}

