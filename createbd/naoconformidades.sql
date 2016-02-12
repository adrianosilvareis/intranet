CREATE TABLE IF NOT EXISTS nc_setor (
    setor_id INT NOT NULL AUTO_INCREMENT,
    setor_descricao VARCHAR(255) NOT NULL,
    setor_ativo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (setor_id)
);

CREATE TABLE IF NOT EXISTS nc_origem(
    origem_id INT NOT NULL AUTO_INCREMENT,
    origem_descricao VARCHAR(255) NOT NULL,
    origem_ativo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (origem_id)
);

CREATE TABLE IF NOT EXISTS nc_registro(
    reg_id INT NOT NULL AUTO_INCREMENT,
    reg_descricao VARCHAR(255) NOT NULL,
    reg_impacto_paciente BOOLEAN DEFAULT FALSE,
    reg_origem_outros VARCHAR(255),
    reg_correcao_imediata VARCHAR(500),
    reg_user_correcao VARCHAR(255),
    reg_aval_processo VARCHAR(500),
    reg_aval_material VARCHAR(500),
    reg_aval_pessoas VARCHAR(500),
    reg_aval_equipamento VARCHAR(500),
    reg_aval_ambiente VARCHAR(500),
    reg_aval_outros VARCHAR(500),
    reg_causa VARCHAR(500),
    reg_date_ocorrencia TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_correcao TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_resposta TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_cadastro TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_lastupdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    user_cadastro INT,
    user_recebimento INT,
    user_avaliacao INT,
    PRIMARY KEY (reg_id)
);