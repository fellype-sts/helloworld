-- --------------------------------------------------------
-- This script is meant to used ONLY in development.    --
-- Delete in production mode.                           --
-- --------------------------------------------------------
-- References:                                      --
--  •  MySQL → https://www.w3schools.com/mysql       --
--  •  SQL ANSI → https://www.w3schools.com/sql      --
-- ------------------------------------------------- --
-- Delete database --
DROP DATABASE IF EXISTS helloword;

-- Recreate database --
CREATE DATABASE helloword CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Select database -- 
USE helloword;

CREATE TABLE employee (
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    emp_photo VARCHAR(255),
    emp_name VARCHAR(127) NOT NULL,
    emp_birth DATE,
    emp_emaiL VARCHAR(255) NOT NULL,
    emp_password VARCHAR (65) NOT NULL,
    emp_type ENUM('admin', 'author', 'moderator') DEFAULT 'moderator',
    emp_status ENUM('on', 'off', 'del') DEFAULT 'on'
);

CREATE TABLE article (
    art_id INT PRIMARY KEY AUTO_INCREMENT,
    art_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    art_thumbnail VARCHAR(255),
    art_title VARCHAR(127),
    art_summary VARCHAR(255),
    art_author INT,
    art_content TEXT,
    art_views INT DEFAULT '0',
    art_status ENUM('on', 'off', 'del') DEFAULT 'on',
    FOREIGN KEY (art_author) REFERENCES employee(emp_id)
);

CREATE TABLE comment (
    cmt_id INT PRIMARY KEY AUTO_INCREMENT,
    cmt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cmt_article INT,
    cmt_social_id VARCHAR(255),
    cmt_social_name VARCHAR(255),
    cmt_social_photo VARCHAR(255),
    cmt_social_email VARCHAR(255),
    cmt_content TEXT,
    cmt_status ENUM('on', 'off', 'del') DEFAULT 'on',
    FOREIGN KEY(cmt_article) REFERENCES article(art_id)
);

CREATE TABLE contact (
    ctt_id INT PRIMARY KEY AUTO_INCREMENT,
    ctt_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ctt_name VARCHAR(255),
    ctt_email VARCHAR(255),
    ctt_subject VARCHAR(255),
    ctt_message TEXT,
    ctt_status ENUM('received', 'read', 'answered', 'deleted') DEFAULT 'received'
);

INSERT INTO
    employee (
        emp_photo,
        emp_name,
        emp_birth,
        emp_email,
        emp_password,
        emp_type
    )
VALUES
    (
        'https://randomuser.me/api/portraits/lego/3.jpg',
        'Joca da Silva',
        '2000-01-01',
        'joca@silva.com',
        SHA1('senha123'),
        'admin'
    ),
    (
        'https://randomuser.me/api/portraits/women/51.jpg',
        'Marineusa Siriliano',
        '1990-09-20',
        'mari@neuza.com',
        SHA1('senha123'),
        'author'
    ),
    (
        'https://randomuser.me/api/portraits/lego/5.jpg',
        'João Silva',
        '1990-05-15',
        'joao.silva@example.com',
        SHA1('senha123'),
        'author'
    ),
    (
        'https://randomuser.me/api/portraits/lego/6.jpg',
        'Maria Santos',
        '1985-09-28',
        'maria.santos@example.com',
        SHA1('abc123'),
        'moderator'
    ),
    (
        'https://randomuser.me/api/portraits/lego/1.jpg',
        'Pedro Oliveira',
        '1982-03-10',
        'pedro.oliveira@example.com',
        SHA1('qwerty'),
        'admin'
    ),
    (
        'https://randomuser.me/api/portraits/women/76.jpg',
        'Ana Pereira',
        '1995-07-20',
        'ana.pereira@example.com',
        SHA1('123456'),
        'author'
    ),
    (
        'https://randomuser.me/api/portraits/lego/4.jpg',
        'Carlos Costa',
        '1978-12-03',
        'carlos.costa@example.com',
        SHA1('senha456'),
        'moderator'
    ),
    (
        'https://randomuser.me/api/portraits/women/65.jpg',
        'Mariana Ferreira',
        '1989-11-07',
        'mariana.ferreira@example.com',
        SHA1('senha789'),
        'admin'
    );

INSERT INTO
    article (
        art_id,
        art_author,
        art_thumbnail,
        art_title,
        art_summary,
        art_content
    )
VALUES
    (
        '1',
        '2',
        'https://picsum.photos/200',
        'Figueira donde nascem figos',
        'Conheça e saiba cuida de figueira e comer frutos deliciosos.',
        '
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ab, excepturi, ullam veniam perspiciatis officiis nostrum libero rerum ipsum minima tempore quisquam accusamus officia magni ea accusantium cumque reiciendis molestias.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat obcaecati harum doloribus perferendis mollitia autem, sapiente fuga itaque officiis molestias libero ea, delectus vero error? Amet deserunt eum vero.</p>
            <figure>
            <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
            <figcaption>Imagem aleatória.</figcaption>                    
            </figure>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto nulla cum voluptate sed debitis minima consequuntur sint earum iste nam corporis aperiam dolorum temporibus itaque, corrupti velit architecto? Modi, quam!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum quia distinctio iusto exercitationem qui accusantium ex ullam, excepturi illo quisquam beatae, nisi ad earum reprehenderit, maiores asperiores fuga nulla accusamus.</p>
        '
    ),
    (
        '2',
        '4',
        'https://picsum.photos/201',
        'Roseiras que espetam os dedos',
        'Como lidar com a colheita das rosas sem sangrar.',
        '
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ab, excepturi, ullam veniam perspiciatis officiis nostrum libero rerum ipsum minima tempore quisquam accusamus officia magni ea accusantium cumque reiciendis molestias.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat obcaecati harum doloribus perferendis mollitia autem, sapiente fuga itaque officiis molestias libero ea, delectus vero error? Amet deserunt eum vero.</p>
            <figure>
            <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
            <figcaption>Imagem aleatória.</figcaption>                    
            </figure>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto nulla cum voluptate sed debitis minima consequuntur sint earum iste nam corporis aperiam dolorum temporibus itaque, corrupti velit architecto? Modi, quam!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum quia distinctio iusto exercitationem qui accusantium ex ullam, excepturi illo quisquam beatae, nisi ad earum reprehenderit, maiores asperiores fuga nulla accusamus.</p>
        '
    ),
    (
        '3',
        '2',
        'https://picsum.photos/202',
        'Plantinhas na varanda',
        'Cuide bem das plantinhas da varanda neste verão.',
        '
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga ab, excepturi, ullam veniam perspiciatis officiis nostrum libero rerum ipsum minima tempore quisquam accusamus officia magni ea accusantium cumque reiciendis molestias.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate placeat obcaecati harum doloribus perferendis mollitia autem, sapiente fuga itaque officiis molestias libero ea, delectus vero error? Amet deserunt eum vero.</p>
            <figure>
            <img src="https://picsum.photos/300/200" alt="Imagem qualquer">    
            <figcaption>Imagem aleatória.</figcaption>                    
            </figure>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto nulla cum voluptate sed debitis minima consequuntur sint earum iste nam corporis aperiam dolorum temporibus itaque, corrupti velit architecto? Modi, quam!</p>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum quia distinctio iusto exercitationem qui accusantium ex ullam, excepturi illo quisquam beatae, nisi ad earum reprehenderit, maiores asperiores fuga nulla accusamus.</p>
        '
    );

-- Popular tabela 'comment'.
-- Popular tabela 'contact'.
;

INSERT INTO
    comment (
        cmt_article,
        cmt_social_id,
        cmt_social_name,
        cmt_social_photo,
        cmt_social_email,
        cmt_content
    )
VALUES
    (
        '1', 
    'abc123',
    'Mariah do Bairro', 
    'https://randomuser.me/api/portraits/women/40.jpg',
    'mariahbairro@gmail.com',
    'Não gosto de Figos. Eles tem caroços.'
    ),
    (
        '2', 
    'def456',
    'Esmeraldino', 
    'https://randomuser.me/api/portraits/lego/7.jpg',
    'esmeraldo@dino.com',
    'Prefiro os cravos às rosas. Pelo menos eles não tem espinhos.'
    ),
    (
        '1', 
    'ghi890',
    'Pedro Pedroso', 
    'https://randomuser.me/api/portraits/men/87.jpg',
    'pedro@pedroso.com',
    'Fogos são gostosos somente no Natal.'
    );