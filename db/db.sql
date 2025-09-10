-- Création de la base de données

--CREATE DATABASE IF NOT EXISTS traffic_app;
--USE traffic_app;

-- Table Users
CREATE TABLE Users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name_user VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES Roles(id_role)
);

INSERT INTO Users (id_user, name_user, password, email, role_id) VALUES
(0, 'Master1', 'admin', 'admin-master1@gmail.com', 1),
(1, 'Master2', 'manager', 'manager-master2@gmail.com', 2),
(2, 'Master3', 'analyst', 'analysr-master3@gmail.com', 3);


-- Table Roles
CREATE TABLE Roles (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL,
    permissions TEXT
);

INSERT INTO Roles (id_role, role_name, permissions) VALUES
(1, 'Admin', 'Ajouter un utilisateur, Supprimer un utilisateur'),
(2, 'Manager', 'Ajouter un capteur, Supprimer un capteur, Modifier un capteur'),
(3, 'Analyst', 'Analyser les données du traffic');


-- Table Intersections
CREATE TABLE Intersections (
    id_int INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Intersections (id_int, address) VALUES
(0, 'rue du port'),
(1, 'rue centrale');

-- Table Capteurs
CREATE TABLE Capteurs (
    id_cap INT AUTO_INCREMENT PRIMARY KEY,
    direction ENUM('up','down','left','right') NOT NULL,
    adress_ip VARCHAR(50),
    etats ENUM('actif','inactif','panne','maintenance') NOT NULL,
    id_int INT,
    FOREIGN KEY (id_int) REFERENCES Intersections(id_int)
);

INSERT INTO Capteurs (id_cap, direction, adress_ip, etats, id_int) VALUES
(0, 'up', '', 'actif', 0),
(1, 'left', '', 'inactif', 0),
(2, 'down', '', 'panne', 0),
(3, 'right', '', 'maintenance', 0),
(4, 'up', '', 'actif', 1),
(5, 'left', '', 'actif', 1),
(6, 'down', '', 'actif', 1),
(7, 'right', '', 'actif', 1);


-- Table traffic_data
CREATE TABLE traffic_data (
    id_traffic INT AUTO_INCREMENT PRIMARY KEY,
    id_cap INT,
    nbr_vehicules INT NOT NULL,
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cap) REFERENCES Capteurs(id_cap)
);

INSERT INTO traffic_data (id_cap, nbr_vehicules) VALUES
(0, 25),
(1, 10),
(4, 40),
(6, 15);


-- Table Logs
CREATE TABLE Logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    action TEXT NOT NULL,
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

INSERT INTO Logs (id_user, action) VALUES
(0, 'Ajout d’un utilisateur'),
(1, 'Ajout d’un capteur'),
(2, 'Analyse des données du trafic');


-- Table Alerts
CREATE TABLE Alerts (
    id_alert INT AUTO_INCREMENT PRIMARY KEY,
    id_cap INT,
    type_alert VARCHAR(50) NOT NULL,
    description TEXT,
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cap) REFERENCES Capteurs(id_cap)
);

INSERT INTO Alerts (id_alert, id_cap, type_alert, description) VALUES
(1, 3, 'panne', 'Le capteur en direction down de Rue du port ne répond plus');
