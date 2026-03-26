CREATE EXTENSION IF NOT EXISTS pgcrypto;

CREATE TYPE  user_role AS  ENUM ('normal','admin');

CREATE TABLE IF NOT EXISTS utilisateur (
    id SERIAL,
    username VARCHAR(100) NOT NULL UNIQUE,
    --5allehe 3allah
    password TEXT NOT NULL,
    role user_role DEFAULT 'normal',
    CONSTRAINT pk_user PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS section (
    id SERIAL PRIMARY KEY,
    designation VARCHAR(10) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS etudiant(
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    date_de_naissance DATE NOT NULL,
    img_url VARCHAR(256) NOT NULL,
    section_id INTEGER REFERENCES section(id) ON DELETE SET NULL
);


INSERT INTO section (designation, description) VALUES
('GL', 'Genie Logiciel'),
('RT', 'Resaux et Telecommunications'),
('IIA', 'Informatique Industrielle et Automatique'),
('IMI', 'Instrumentation et Maintenance Industrielle');

INSERT INTO  utilisateur(username, password, role) VALUES
('talel zighni', crypt('123', gen_salt('bf')), 'admin'),
('ahmed el hani', crypt('1234', gen_salt('bf')), 'normal'),
('rayenn kahammar', crypt('pass10', gen_salt('bf')), 'normal');
