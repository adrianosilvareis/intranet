CREATE TABLE IF NOT EXISTS agenda_contatos (
    contato_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contato_descricao VARCHAR(200),
    contato_telefone VARCHAR(500),
    contato_email VARCHAR(50),
    contato_site VARCHAR(50),
    contato_obs VARCHAR(500),
    endereco_id INT,
    setor_id INT
);

CREATE TABLE IF NOT EXISTS agenda_endereco(
    endereco_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    endereco_lagradouro VARCHAR(200),
    endereco_bairro VARCHAR(200),
    endereco_numero VARCHAR(50),
    endereco_cep VARCHAR(50),
    app_cidade INT
);

CREATE TABLE IF NOT EXISTS agenda_setor (
    setor_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    setor_descricao VARCHAR(100)
);

