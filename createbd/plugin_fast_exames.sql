CREATE TABLE IF NOT EXISTS fe_exames (
ex_id INT NOT NULL AUTO_INCREMENT,
ex_descricao VARCHAR(50), 
ex_sinonimia VARCHAR(50), 
ex_unidade VARCHAR(50), 
ex_valor_referencia VARCHAR(50), 
ex_prazo INT, 
ex_info_paciente VARCHAR(200), 
ex_info_coleta VARCHAR(200),
ex_info_interferentes VARCHAR(200), 
ex_info_encaminhamento VARCHAR(200), 
ex_valor DOUBLE(10,2), 
ex_status BOOLEAN, 
ex_data_abertura TIMESTAMP NOT NULL, 
ex_data_fechamento TIMESTAMP NOT NULL,
ex_paciente_os VARCHAR(50),
ws_users INT, 
ws_users_soli INT, 
fe_setor_soli INT, 
fe_setor_exec INT, 
fe_material INT, 
fe_metodo INT, 
PRIMARY KEY (ex_id));

CREATE TABLE IF NOT EXISTS fe_setor(
    set_id INT NOT NULL AUTO_INCREMENT,
    set_descricao  VARCHAR(50),
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