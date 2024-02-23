<?php 


header("Content-type: text/html; charset=utf-8");

/* Global Settings of the site, set on your demand*/ 

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

/* Connect MySQL with MySQLi*/ 
$conn = new mysqli(
    $site["mysql_hostname"],
    $site["mysql_username"],
    $site["mysql_password"],
    $site["mysql_database"]
);

/* For error in connection with database*/ 
if ($conn->connect_error) die("Falha de conexão com o banco e dados: " . $conn->connect_error);

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
function debug($target, $exit = false ) {
    print_r($target);
    //var_dump($target);
    if($exit) exit();
}