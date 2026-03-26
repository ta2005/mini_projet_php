-- =============================
--  DATABASE AND USER SETUP
--    USER: tp_user
--    PASS: tp_pass
-- =============================

DO $$
BEGIN
    IF NOT EXISTS (SELECT FROM pg_catalog.pg_roles WHERE rolname = 'tp_user') THEN
        CREATE USER tp_user WITH PASSWORD 'tp_pass';
    END IF;
END
$$;

-- CREATE DATABASE IF NOT EXISTS gestion_etudiants OWNER tp_user;
-- USE DATABASE gestion_etudiants;



-- =============================
--  SCHEMA SETUP
-- =============================

CREATE EXTENSION IF NOT EXISTS pgcrypto;

DO $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'user_role') THEN
        CREATE TYPE user_role AS ENUM ('normal', 'admin');
    END IF;
END
$$;

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


-- =============================
--  PERMISSIONS
-- =============================

GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO tp_user;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO tp_user;



-- =============================
--  DUMMY VALUES
-- =============================

INSERT INTO section (designation, description) VALUES
('GL', 'Genie Logiciel'),
('RT', 'Resaux et Telecommunications'),
('IIA', 'Informatique Industrielle et Automatique'),
('IMI', 'Instrumentation et Maintenance Industrielle');

INSERT INTO  utilisateur(username, password, role) VALUES
('talel zighni', crypt('123', gen_salt('bf')), 'admin'),
('ahmed el hani', crypt('1234', gen_salt('bf')), 'normal'),
('rayenn kahammar', crypt('pass10', gen_salt('bf')), 'normal');
