<?php

//Load page configs
require("_global.php");

$page = [
    "title" => "Faça contato",
    "css" => "contacts.css",
    "js" => "contacts.js",
];

require("_header.php");

?>

<article>
<h2>Faça Contato</h2>
<p>Preencha todos os campos do formulário para enviar o contato para a equipe do <strong><?php echo $site['sitename']?></strong>. </p>
<p class="</strong> "><small>Todos os campos são obrigatórios.</small></p>
</article>


<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

<p>Preencha todos os campos do formulário para enviar um contato para a equipe do <strong><?php echo $site['sitename'] ?></strong>.</p>
<p class="center red"><small>Todos os campos são obrigatórios.</small></p>

<p>
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" placeholder="Seu nome completo." value="Joca da Silva">
</p>

<p>
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" placeholder="usuario@provedor.com" value="joca@silva.com">
</p>

<p>
    <label for="subject">Assunto:</label>
    <input type="text" name="subject" id="subject" placeholder="Sobre o que deseja escrever" value="Assunto de teste">
</p>

<p>
    <label for="message">Mensagem:</label>
    <textarea name="message" id="message" placeholder="Escreva sua mensagem aqui">Mensagem de teste</textarea>
</p>

<p>
    <button type="submit">Enviar</button>
</p>

</form>
<aside></aside>

<?php require("_footer.php"); ?>