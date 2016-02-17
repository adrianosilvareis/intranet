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


INSERT INTO ws_intranet.dt_downtime (equip_id, time_stop, time_start, time_lastupdate, equip_author) VALUES 
(1, '2015-12-09 19:33:06.0', '2015-12-09 20:02:15.0', '2015-12-09 20:02:15.0', 'Lucilene'),
(1, '2015-12-09 19:33:06.0', '2015-12-09 20:02:15.0', '2015-12-09 20:02:15.0', 'Jorge Terrao'),
(1, '2015-12-10 07:00:08.0', '2015-12-10 08:15:34.0', '2015-12-09 08:15:34.0', 'Jose Robson'),
(1, '2015-12-28 07:00:09.0', '2015-12-28 09:25:42.0', '2015-12-28 09:25:42.0', 'Karolina'),
(1, '2015-01-25 08:00:09.0', '2015-01-25 18:30:09.0', '2015-01-25 18:30:09.0', 'Lucilene'),
(1, '2015-01-27 08:15:09.0', '2015-01-27 19:00:09.0', '2015-01-27 19:00:09.0', 'Joarez'),
(1, '2015-01-28 07:00:09.0', '2015-01-28 12:00:09.0', '2015-01-28 12:00:09.0', 'Karolina'),
(2, '2015-12-22 08:00:17.0', '2015-12-22 10:45:32.0', '2015-12-22 10:45:32.0', 'Jose Robson'),
(2, '2016-01-25 17:00:38.0', '2016-01-25 18:30:38.0', '2016-02-17 10:15:21.0', 'Joarez'),
(2, '2016-02-04 07:00:41.0', '2016-02-04 19:00:18.0', '2016-02-04 19:00:18.0', 'Karolina'),
(2, '2016-02-05 07:00:59.0', '2016-02-05 17:00:59.0', '2016-02-05 17:00:59.0', 'Jose Robson');


INSERT INTO ws_intranet.dt_equipamentos (equip_title, equip_content, equip_date, equip_status, equip_lastupdate, equip_author) VALUES 
('Centaur', 'Imuno Vila Velha', '2016-02-16 10:04:43.0', true, '2016-02-17 10:04:53.0', 'Karolina'),
('Unicell', 'Imuno Vila Velha', '2016-02-15 10:05:10.0', true, '2016-02-17 10:05:19.0', 'Jose Robson');
