
-- CREATE TABLE IF NOT EXISTS nc_setor (
--     setor_id INT NOT NULL AUTO_INCREMENT,
--     setor_descricao VARCHAR(255) NOT NULL,
--     setor_ativo BOOLEAN DEFAULT TRUE,
--     PRIMARY KEY (setor_id)
-- );

CREATE TABLE IF NOT EXISTS nc_origem(
    origem_id INT NOT NULL AUTO_INCREMENT,
    origem_descricao VARCHAR(255) NOT NULL,
    origem_ativo BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (origem_id)
);

CREATE TABLE IF NOT EXISTS nc_reg_file (
    reg_id INT, 
    file_id INT NOT NULL AUTO_INCREMENT, 
    file_url VARCHAR(255), 
    file_name VARCHAR(255), 
    file_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP  NOT NULL, 
    PRIMARY KEY (file_id)
);

CREATE TABLE IF NOT EXISTS nc_registro_has_nc_origem (
    reg_id INT NOT NULL,
    origem_id INT NOT NULL,
    PRIMARY KEY(reg_id, origem_id)
);

-- deve mesmo existir ?
CREATE TABLE IF NOT EXISTS ws_user_has_nc_setor(
    user_id INT NOT NULL,
    setor_id INT NOT NULL,
    PRIMARY KEY (user_id, setor_id)
);

CREATE TABLE IF NOT EXISTS nc_registro(
    reg_id INT NOT NULL AUTO_INCREMENT,
    reg_descricao VARCHAR(255) NOT NULL,
    reg_impacto_paciente BOOLEAN DEFAULT FALSE,
    reg_origem_outros VARCHAR(255),
    reg_correcao_imediata VARCHAR(500),
    reg_user_correcao VARCHAR(255),
    reg_aval_processo VARCHAR(500),
    reg_aval_materia_prima VARCHAR(500),
    reg_aval_mao_obra VARCHAR(500),
    reg_aval_equipamento VARCHAR(500),
    reg_aval_meio_ambiente VARCHAR(500),
    reg_aval_outros VARCHAR(500),
    reg_causa_principal VARCHAR(500),
    reg_date_correcao TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_resposta TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_cadastro TIMESTAMP DEFAULT 0 NOT NULL,
    reg_date_lastupdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    user_lastupdate INT,
    user_cadastro INT,
    user_recebimento INT,
    reg_responsavel_aval VARCHAR(255) NOT NULL,
    PRIMARY KEY (reg_id)
);

CREATE TABLE IF NOT EXISTS nc_plano_acao(
    plano_id INT NOT NULL AUTO_INCREMENT,
    reg_id INT NOT NULL,
    plano_o_que VARCHAR(500),
    plano_quem VARCHAR(500),
    plano_onde VARCHAR(500),
    plano_date_max TIMESTAMP DEFAULT 0 NOT NULL,
    plano_date_performs TIMESTAMP DEFAULT 0 NOT NULL,
    plano_realizado BOOLEAN DEFAULT FALSE,
    plano_demand BOOLEAN DEFAULT FALSE,
    plano_completed BOOLEAN DEFAULT FALSE,
    user_demand INT,
    data_notification TIMESTAMP DEFAULT 0 NOT NULL,
    PRIMARY KEY(plano_id)
);