CREATE TYPE  role AS  ENUM ('normal','admin');

CREATE TABLE IF NOT EXISTS utilisateur(
   id SERIAL,
   name VARCHAR(100) NOT NULL,
   --5allehe 3allah
   password VARCHAR(100) NOT NULL,
   role role,
   CONSTRAINT pk_user PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS section(
   id SERIAL PRIMARY KEY,
   designation VARCHAR(50),
   description TEXT,
   CONSTRAINT uq_des UNIQUE(designation)
);

CREATE TABLE IF NOT EXISTS etudiant(
   id SERIAL PRIMARY KEY,
   name VARCHAR(100) NOT NULL,
   date_de_naiss DATE NOT NULL,
   img VARCHAR(256) NOT NULL,
   section INTEGER,
   CONSTRAINT fk_section FOREIGN KEY(section) REFERENCES SECTION(id)
);


INSERT INTO  utilisateur(name,password,role) VALUES
('talel zighni','123','admin'),
('ahmed el hani','1234','normal');

-- Un user normal n’a le droit qu’à la consultation
-- 7. Vous allez avoir une table etudiant avec un nom, une
-- image, une date de naissance et une section
-- 8. La table section devra avoir une designation et une
-- description.
