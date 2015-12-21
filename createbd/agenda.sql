CREATE TABLE agenda_contatos (
    contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contato_descricao VARCHAR(200),
    contato_telefone VARCHAR(50),
    contato_email VARCHAR(50),
    contato_endereco VARCHAR(50),
    contato_cidade INT,
    contato_estados INT,
    contato_setor INT
);

CREATE TABLE agenda_setor (
    setor_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    setor_descricao VARCHAR(100)
);

