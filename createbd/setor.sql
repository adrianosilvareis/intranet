CREATE TABLE IF NOT EXISTS ws_setor(
    setor_id INT NOT NULL AUTO_INCREMENT,
    setor_content VARCHAR(255) NOT NULL,
    setor_status BOOLEAN DEFAULT TRUE,
    setor_email VARCHAR(255),
    setor_type INT,
    setor_category VARCHAR(255),
    setor_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY(setor_id)
); 

CREATE TABLE IF NOT EXISTS ws_setor_type(
    type_id INT NOT NULL AUTO_INCREMENT,
    type_content VARCHAR(255) NOT NULL,
    type_status BOOLEAN DEFAULT TRUE,
    PRIMARY KEY(type_id)
);