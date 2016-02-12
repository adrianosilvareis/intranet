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
    reg_responsavel_correcao VARCHAR(255),
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
    anexo
    PRIMARY KEY (reg_id)
);

CREATE TABLE IF NOT EXISTS nc_plano_acao(
    plano_id INT NOT NULL AUTO_INCREMENTE,
    plano_o_que
    plano_quem
    plano_onde
    plano_prazo_max 
    plano_data_realizacao 
    plano_realizado BOOLEAN
    
    gera_demanda 
    usuario_demanda INT
    data_notificacao
    finalizado
    PRIMARY KEY(plano_id)
);