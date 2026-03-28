-- 1. Destroy all corrupted test data and reset the ID counters to 1
TRUNCATE TABLE etudiant, section, utilisateur RESTART IDENTITY CASCADE;

-- 2. Seed fresh Users (Your originals)
INSERT INTO utilisateur (name, password, role) VALUES
('talel zighni', '123', 'admin'),
('ahmed el hani', '1234', 'normal');

-- 3. Seed fresh Sections (Using standard university sections)
INSERT INTO section (designation, description) VALUES
('GL1', 'Génie Logiciel - 1ère année'),
('GL2', 'Génie Logiciel - 2ème année'),
('RSI', 'Réseaux et Systèmes Informatiques'),
('MDW', 'Multimédia et Développement Web');

-- 4. Seed fresh Etudiants (Referencing the section IDs we just made)
INSERT INTO etudiant (name, date_de_naiss, img, section) VALUES
('Sami Ben Ali', '2001-05-14', 'sami.png', 1),    -- GL1
('Fatma Trabelsi', '2000-11-22', 'fatma.png', 2),  -- GL2
('Youssef Gharbi', '2002-03-08', 'youssef.png', 3),-- RSI
('Amira Mansour', '2001-07-30', 'amira.png', 2),   -- GL2
('Karim Jendoubi', '1999-12-05', 'default.png', 4);-- MDW
