CREATE TABLE IF NOT EXISTS fe_exames (
ex_id INT NOT NULL AUTO_INCREMENT,
ex_descricao VARCHAR(500), 
ex_minemonico VARCHAR(50), 
ex_sinonimia VARCHAR(500), 
ex_unidade VARCHAR(50), 
ex_valor_referencia VARCHAR(2500), 
ex_metodo VARCHAR(500), 
ex_prazo INT, 
ex_info_paciente VARCHAR(500), 
ex_info_coleta VARCHAR(500),
ex_info_interferentes VARCHAR(500), 
ex_info_encaminhamento VARCHAR(500), 
ex_valor DOUBLE(10,2), 
ex_status BOOLEAN DEFAULT FALSE, 
ex_cancelado BOOLEAN DEFAULT FALSE, 
ex_data_abertura TIMESTAMP DEFAULT '0000-00-00 00:00:00',
ex_data_fechamento TIMESTAMP DEFAULT '0000-00-00 00:00:00',
ex_paciente_os VARCHAR(50),
ex_observacao VARCHAR(1000),
ws_users INT, 
ws_users_soli INT, 
fe_setor_soli INT, 
fe_setor_exec INT, 
fe_material INT, 
fe_metodo INT, 
fe_acoes INT, 
PRIMARY KEY (ex_id));

CREATE TABLE IF NOT EXISTS fe_setor(
    set_id INT NOT NULL AUTO_INCREMENT,
    set_descricao  VARCHAR(50),
    set_email VARCHAR(50),
    set_execucao BOOLEAN, 
    set_solicita BOOLEAN,
    set_status BOOLEAN, 
PRIMARY KEY (set_id));

CREATE TABLE IF NOT EXISTS fe_material(
    mat_id INT NOT NULL AUTO_INCREMENT,
    mat_descricao  VARCHAR(50),
    mat_status BOOLEAN, 
PRIMARY KEY (mat_id ));

CREATE TABLE IF NOT EXISTS fe_metodo(
    met_id INT NOT NULL AUTO_INCREMENT,
    met_descricao  VARCHAR(50),
    met_status BOOLEAN, 
PRIMARY KEY (met_id ));

CREATE TABLE IF NOT EXISTS fe_acoes(
    acao_id INT NOT NULL AUTO_INCREMENT,
    acao_descricao  VARCHAR(50),
    acao_status BOOLEAN, 
PRIMARY KEY (acao_id ));