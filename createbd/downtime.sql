CREATE TABLE IF NOT EXISTS dt_downtime(
    equip_id INT NOT NULL,
    time_id INT NOT NULL AUTO_INCREMENT,
    time_stop TIMESTAMP DEFAULT 0 NOT NULL,
    time_start TIMESTAMP DEFAULT 0 NOT NULL,
    time_lastupdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    equip_author VARCHAR(255) NOT NULL,
    PRIMARY KEY(time_id)
);

CREATE TABLE IF NOT EXISTS dt_equipamentos(
    equip_id INT NOT NULL AUTO_INCREMENT,
    equip_title VARCHAR(255) NOT NULL,
    equip_content VARCHAR(255) NOT NULL,
    equip_date TIMESTAMP DEFAULT 0 NOT NULL,
    equip_status BOOLEAN DEFAULT TRUE,
    equip_lastupdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    equip_author VARCHAR(255) NOT NULL,
    PRIMARY KEY(equip_id)
);