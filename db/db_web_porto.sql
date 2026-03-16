CREATE DATABASE IF NOT EXISTS web_porto;
USE web_porto;

CREATE TABLE IF NOT EXISTS profile (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  title VARCHAR(200) NOT NULL,
  summary TEXT NOT NULL,
  about TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS social_links (
  id INT AUTO_INCREMENT PRIMARY KEY,
  platform VARCHAR(50) NOT NULL,
  url VARCHAR(255) NOT NULL,
  icon_class VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS skills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  skill_name VARCHAR(100) NOT NULL,
  percentage INT NOT NULL,
  color_class VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS experience (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS certificates (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  image_path VARCHAR(255) NOT NULL
);

INSERT INTO profile (name, title, summary, about) VALUES
('Mochammad Rezky Ramadhan', 'CyberSecurity Enthusiast | Future SOC Analyst', 'Mahasiswa Sistem Informasi yang mendalami bidang CyberSecurity dan berfokus menjadi SOC Analyst profesional.', 'Nama saya Mochammad Rezky Ramadhan, mahasiswa Sistem Informasi angkatan 2024 yang saat ini menempuh semester 4 dan mendalami bidang CyberSecurity. Saya memiliki ketertarikan pada dunia keamanan sistem, monitoring ancaman, serta analisis insiden keamanan.');

INSERT INTO social_links (platform, url, icon_class) VALUES
('Instagram', 'https://www.instagram.com/mocha.rzy/', 'bi bi-instagram'),
('LinkedIn', 'https://www.linkedin.com/in/mochammad-rezky-ramadhan-128022330/', 'bi bi-linkedin');

INSERT INTO skills (skill_name, percentage, color_class) VALUES
('Python & Java', 40, 'bg-primary'),
('SOC Analyst', 15, 'bg-info'),
('Web Penetration', 5, 'bg-secondary');

INSERT INTO experience (content) VALUES
('Staff Biro Eden - INFORSA'),
('Project Python: Sistem Reservasi Restoran'),
('Project Java EnergiSense: projek yang membandingkan penggunaan listrik mana yang paling murah dan awet'),
('Sedang belajar menjadi Blue Team bagian SOC Analyst'),
('Sedang belajar bahasa pemograman Flutter/dart untuk Pemograman Aplikasi Bergerak dan html/css untuk Pemograman Berbasis Web');

INSERT INTO certificates (title, description, image_path) VALUES
('CyberSecurity Certificate', 'Sertifikat pelatihan CyberSecurity sebagai dasar pemahaman keamanan sistem.', 'images/images_cyber.jpg');
