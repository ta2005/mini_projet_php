
CREATE DATABASE IF NOT EXISTS gestion_etudiants;
USE gestion_etudiants;


CREATE TABLE IF NOT EXISTS utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    password TEXT NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user'
);


CREATE TABLE IF NOT EXISTS section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    des VARCHAR(255) NOT NULL 
);

CREATE TABLE IF NOT EXISTS etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    date_de_naiss DATE NOT NULL,
    img VARCHAR(256) NOT NULL,
    section_id INT, 
    CONSTRAINT fk_section 
        FOREIGN KEY (section_id) 
        REFERENCES section(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

INSERT INTO section (des) VALUES
('GL'), ('RT'), ('IMI'), ('IIA');

INSERT INTO utilisateur (name, password, role) VALUES
('talel zighni', SHA2('123', 256), 'admin'),
('ahmed el hai', SHA2('1234', 256), 'user');

INSERT INTO etudiant (name, date_de_naiss, img, section_id) VALUES
('Ali Ben Salah', '2000-05-12', 'images/pdp.jpg', 1),
('Sara Trabelsi', '2001-08-22', 'images/pdp.jpg', 2),
('Mohamed Gharbi', '1999-12-03', 'images/pdp.jpg', 1);