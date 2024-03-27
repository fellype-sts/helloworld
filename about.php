<?php
require("_global.php");
$page = [
    "title" => "Sobre nós",
    "css" => "about.css",
    "js" => "index.js",
];
$employees = '';


$sql = <<<SQL

SELECT 
	-- Campos necessários
    emp_id, emp_photo, emp_name, emp_type,
    -- Converte a data de cadastro
    DATE_FORMAT(emp_date, "%d/%m/%Y") AS emp_datebr,
    -- Obtém a idade
    TIMESTAMPDIFF(YEAR, emp_birth, CURDATE()) AS emp_age 
FROM employee
-- Requisitos
WHERE emp_status = 'on'
-- Ordena pelo mais antigo
ORDER BY emp_date;

SQL;
$res = $conn->query($sql);

if ($res->num_rows > 0) :

    $employees .= <<<HTML

        <h3>Colaboradores</h3>
        <p>No {$site['sitename']}, contamos com uma equipe dedicada de administradores, autores e moderadores apaixonados pelo mundo das plantas. Nossos administradores garantem o bom funcionamento do blog, enquanto nossos autores especializados trazem sua experiência e conhecimento para criar conteúdo informativo e inspirador. Nossos moderadores garantem que a comunidade se mantenha positiva e construtiva, proporcionando uma experiência enriquecedora para todos os nossos leitores e participantes.</p>
        <div class="emprow">

    HTML;

    while ($row = $res->fetch_assoc()) :

        switch ($row['emp_type']):
            case 'admin':
                $emp_type = 'administrador';
                break;
            case 'author':
                $emp_type = 'autor';
                break;
            case 'moderator':
                $emp_type = 'moderador';
                break;
            default:
                $emp_type = 'colaborador';
                break;
        endswitch;

        $employees .= <<<HTML

        <div class="empcol">
            <img src="{$row['emp_photo']}" alt="{$row['emp_name']}">
            <h3>{$row['emp_name']}</h3>
            <ul>
                <li>{$row['emp_age']} anos</li>
                <li>Colabora desde {$row['emp_datebr']} como {$emp_type}.</li>
            </ul>
        </div>

        HTML;

    endwhile;

    $employees .= '</div>';

endif;

$article = <<<HTML

    
    <div>
        <h1> Sobre nós</h1>
            <p>onde compartilhamos insights e conhecimentos sobre as habilidades e tecnologias empregadas no desenvolvimento de sites dinâmicos e funcionais. Este projeto foi criado para destacar as capacidades do nosso time e demonstrar nosso domínio em diversas áreas da programação web.</p>

            <p>Nosso público-alvo são pessoas interessadas em entender sobre o conhecimento das habilidades  do desenvolvedor para construir sites como este.</p>

            <p>Utilizamos PHP como linguagem principal de back-end, explorando sua versatilidade e poder para criar funcionalidades avançadas. Além disso, nosso uso de bancos de dados SQL garante a robustez e escalabilidade do nosso projeto, permitindo-nos gerenciar eficientemente grandes volumes de dados.</p>

            <p>Para oferecer uma experiência de usuário perfeita, implementamos um sistema de cadastro e login através do Firebase, demonstrando nossa capacidade de integrar tecnologias de ponta em nossos projetos.</p>

            <p>Junte-se a nós nesta jornada enquanto compartilhamos nossos conhecimentos e experiências, e inspire-se para criar seus próprios projetos web impressionantes. Este blog é mais do que apenas um portfólio; é uma demonstração do nosso compromisso com a excelência na programação web.</p>
    </div>
HTML;




require("_header.php");

?>

<article><?php echo $article ?> <?php echo $employees ?></article>

<aside> <h3><span >Política Privacidade</span></h3><p><span  >A sua privacidade é importante para nós. É política do Hello World respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site <a href="localhost">Hello World</a>, e outros sites que possuímos e operamos.</span></p><p><span   >Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço. Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que estamos coletando e como será usado.</span></p><p><span   >Apenas retemos as informações coletadas pelo tempo necessário para fornecer o serviço solicitado. Quando armazenamos dados, protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.</span></p><p><span   >Não compartilhamos informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.</span></p><p><span   >O nosso site pode ter links para sites externos que não são operados por nós. Esteja ciente de que não temos controle sobre o conteúdo e práticas desses sites e não podemos aceitar responsabilidade por suas respectivas&nbsp;</span><a href="https://politicaprivacidade.com/" rel="noopener noreferrer" target="_blank" style="background-color: transparent; color: rgb(68, 68, 68);">políticas de privacidade</a><span   >.</span></p><p><span   >Você é livre para recusar a nossa solicitação de informações pessoais, entendendo que talvez não possamos fornecer alguns dos serviços desejados.</span></p><p><span   >O uso continuado de nosso site será considerado como aceitação de nossas práticas em torno de privacidade e informações pessoais. Se você tiver alguma dúvida sobre como lidamos com dados do usuário e informações pessoais, entre em contacto connosco.</span></p><p><span   >
<p><br></p></span></p><h3><span   >Compromisso do Usuário</span></h3><p><span   >O usuário se compromete a fazer uso adequado dos conteúdos e da informação que o Hello World oferece no site e com caráter enunciativo, mas não limitativo:</span></p><ul><li><span   >A) Não se envolver em atividades que sejam ilegais ou contrárias à boa fé a à ordem pública;</span></li><li><span   >B) Não difundir propaganda ou conteúdo de natureza racista, xenofóbica, </span><span style="color: rgb(33, 37, 41);"></span><span   > ou azar, qualquer tipo de pornografia ilegal, de apologia ao terrorismo ou contra os direitos humanos;</span></li><li><span   >C) Não causar danos aos sistemas físicos (hardwares) e lógicos (softwares) do Hello World, de seus fornecedores ou terceiros, para introduzir ou disseminar vírus informáticos ou quaisquer outros sistemas de hardware ou software que sejam capazes de causar danos anteriormente mencionados.</span></li></ul><h3><span   >Mais informações</span></h3><p><span   >Esperemos que esteja esclarecido e, como mencionado anteriormente, se houver algo que você não tem certeza se precisa ou não, geralmente é mais seguro deixar os cookies ativados, caso interaja com um dos recursos que você usa em nosso site.</span></p><p><span   >Esta política é efetiva a partir de&nbsp;22 March 2024 04:40</span></p>
<?php
    // Mostra ícone de contatos na lista de redes sociais
    $show_contact = true;
    // Importa lista de redes sociais
    require('widgets/_socialaside.php');
    // Importa lista de artigos recentes
    require('widgets/_newest.php');
    ?>
</aside>

<?php require("_footer.php"); ?>