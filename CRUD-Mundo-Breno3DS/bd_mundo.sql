create database bd_mundo;
use bd_mundo;

create  table paises(
id_pais int primary key auto_increment, nome varchar(200) unique not null, continente varchar(20) not null, populacao int not null, idioma varchar(200)not null
);

create table cidades(
id_cidade int primary key auto_increment, nome varchar(200) not null, populacao int not null, id_pais int not null
);

alter table cidades add foreign key (id_pais) references paises(id_pais); 

-- África
INSERT INTO paises (nome, continente, populacao, idioma) VALUES 
('República Federal da Nigéria', 'África', 223800000, 'Inglês'),
('República Árabe do Egito', 'África', 105000000, 'Árabe'),
('República da África do Sul', 'África', 60000000, 'Inglês'),
('República do Quênia', 'África', 54000000, 'Suaíli'),
('República de Gana', 'África', 32000000, 'Inglês');

-- América do Norte
INSERT INTO paises (nome, continente, populacao, idioma) VALUES 
('Estados Unidos da América', 'América do Norte', 331000000, 'Inglês'),
('Canadá', 'América do Norte', 38000000, 'Inglês'),
('Estados Unidos Mexicanos', 'América do Norte', 128000000, 'Espanhol'),
('República de Cuba', 'América do Norte', 11000000, 'Espanhol'),
('República Dominicana', 'América do Norte', 11000000, 'Espanhol');

-- América do Sul
INSERT INTO paises (nome, continente, populacao, idioma) VALUES 
('República Federativa do Brasil', 'América do Sul', 213000000, 'Português'),
('República Argentina', 'América do Sul', 45000000, 'Espanhol'),
('República da Colômbia', 'América do Sul', 52000000, 'Espanhol'),
('República do Chile', 'América do Sul', 19000000, 'Espanhol'),
('República do Peru', 'América do Sul', 33000000, 'Espanhol');

-- Ásia
INSERT INTO paises (nome, continente, populacao, idioma) VALUES 
('República Popular da China', 'Ásia', 1400000000, 'Mandarim'),
('Japão', 'Ásia', 125000000, 'Japonês'),
('República da Índia', 'Ásia', 1400000000, 'Hindi'),
('Reino da Arábia Saudita', 'Ásia', 34000000, 'Árabe'),
('República da Coreia', 'Ásia', 52000000, 'Coreano');

-- Europa
INSERT INTO paises (nome, continente, populacao, idioma) VALUES 
('República Federal da Alemanha', 'Europa', 83000000, 'Alemão'),
('República Francesa', 'Europa', 67000000, 'Francês'),
('República Italiana', 'Europa', 60000000, 'Italiano'),
('Reino Unido da Grã-Bretanha e Irlanda do Norte', 'Europa', 67000000, 'Inglês'),
('Reino da Espanha', 'Europa', 47000000, 'Espanhol');

-- Oceania
INSERT INTO paises (nome, continente, populacao, idioma) VALUES 
('Commonwealth da Austrália', 'Oceania', 26000000, 'Inglês'),
('Aotearoa - Nova Zelândia', 'Oceania', 5000000, 'Inglês'),
('República das Ilhas Fiji', 'Oceania', 900000, 'Inglês'),
('Papua-Nova Guiné', 'Oceania', 9000000, 'Inglês'),
('Estado Independente de Samoa', 'Oceania', 200000, 'Samoano');

-- África
-- Nigéria
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Lagos', 14600000, 1),
('Abuja', 8000000, 1),
('Kano', 3500000, 1),
('Port Harcourt', 1200000, 1),
('Ibadan', 3500000, 1);

-- Egito
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Cairo', 9500000, 2),
('Alexandria', 5000000, 2),
('Giza', 4500000, 2),
('Shubra El-Kheima', 1200000, 2),
('Port Said', 600000, 2);

-- África do Sul
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Joanesburgo', 5000000, 3),
('Cidade do Cabo', 4000000, 3),
('Durban', 3500000, 3),
('Pretória', 2000000, 3),
('Ekurhuleni', 2000000, 3);

-- Quênia
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Nairóbi', 4700000, 4),
('Mombaça', 1200000, 4),
('Kisumu', 500000, 4),
('Nakuru', 400000, 4),
('Eldoret', 500000, 4);

-- Gana
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Acra', 2500000, 5),
('Kumasi', 2000000, 5),
('Takoradi', 500000, 5),
('Tamale', 400000, 5),
('Sekondi', 200000, 5);

-- América do Norte
-- Estados Unidos
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Nova York', 8419600, 6),
('Los Angeles', 3980400, 6),
('Chicago', 2716000, 6),
('Houston', 2328000, 6),
('Phoenix', 1690000, 6);

-- Canadá
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Toronto', 2809000, 7),
('Montreal', 1700000, 7),
('Vancouver', 631000, 7),
('Calgary', 1239000, 7),
('Ottawa', 934000, 7);

-- México
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Cidade do México', 9209944, 8),
('Guadalajara', 5000000, 8),
('Monterrey', 5000000, 8),
('Cancún', 888000, 8),
('Puebla', 1500000, 8);

-- Cuba
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Havana', 2100000, 9),
('Santiago de Cuba', 500000, 9),
('Camagüey', 300000, 9),
('Holguín', 300000, 9),
('Santa Clara', 250000, 9);

-- República Dominicana
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Santo Domingo', 3100000, 10),
('Santiago de los Caballeros', 600000, 10),
('La Romana', 250000, 10),
('San Pedro de Macorís', 300000, 10),
('Puerto Plata', 200000, 10);

-- América do Sul
-- Brasil
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('São Paulo', 12300000, 11),
('Rio de Janeiro', 6748000, 11),
('Brasília', 3055149, 11),
('São José dos Campos', 11895578, 11 ),
('Fortaleza', 2600000, 11);

-- Argentina
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Buenos Aires', 2890151, 12),
('Córdoba', 1400000, 12),
('Rosário', 1200000, 12),
('Mendoza', 1150000, 12),
('La Plata', 800000, 12);

-- Colômbia
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Bogotá', 8000000, 13),
('Medellín', 2500000, 13),
('Cali', 2400000, 13),
('Barranquilla', 1200000, 13),
('Cartagena', 1000000, 13);

-- Chile
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Santiago', 5000000, 14),
('Valparaíso', 300000, 14),
('Concepción', 230000, 14),
('La Serena', 200000, 14),
('Antofagasta', 400000, 14);

-- Peru
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Lima', 8900000, 15),
('Arequipa', 1000000, 15),
('Trujillo', 900000, 15),
('Chiclayo', 600000, 15),
('Cusco', 430000, 15);

-- Ásia
-- China
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Pequim', 21540000, 16),
('Xangai', 24200000, 16),
('Shenzhen', 12000000, 16),
('Guangzhou', 14000000, 16),
('Chengdu', 16000000, 16);

-- Japão
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Tóquio', 13929286, 17),
('Yokohama', 3720000, 17),
('Osaka', 2690000, 17),
('Nagoya', 2300000, 17),
('Sapporo', 2000000, 17);

-- Índia
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Nova Délhi', 29000000, 18),
('Mumbai', 12400000, 18),
('Bangalore', 12000000, 18),
('Kolkata', 4500000, 18),
('Chennai', 4600000, 18);

-- Arábia Saudita
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Riad', 7000000, 19),
('Jidá', 4000000, 19),
('Meca', 2000000, 19),
('Medina', 1500000, 19),
('Dammam', 1000000, 19);

-- Coreia do Sul
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Seul', 10000000, 20),
('Busan', 3500000, 20),
('Incheon', 2900000, 20),
('Daegu', 2500000, 20),
('Daejeon', 1500000, 20);

-- Europa
-- Alemanha
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Berlim', 3700000, 21),
('Hamburgo', 1800000, 21),
('Munique', 1400000, 21),
('Colônia', 1000000, 21),
('Frankfurt', 700000, 21);

-- França
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Paris', 2148000, 22),
('Marselha', 860000, 22),
('Lyon', 515000, 22),
('Toulouse', 450000, 22),
('Nice', 340000, 22);

-- Itália
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Roma', 2873000, 23),
('Milão', 1350000, 23),
('Nápoles', 1000000, 23),
('Turim', 900000, 23),
('Palermo', 650000, 23);

-- Reino Unido
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Londres', 8900000, 24),
('Birmingham', 1100000, 24),
('Manchester', 530000, 24),
('Glasgow', 600000, 24),
('Liverpool', 500000, 24);

-- Espanha
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Madrid', 3200000, 25),
('Barcelona', 1600000, 25),
('Valência', 800000, 25),
('Sevilha', 500000, 25),
('Bilbao', 350000, 25);

-- Oceania
-- Austrália
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Sidney', 5312000, 26),
('Melbourne', 5000000, 26),
('Brisbane', 2300000, 26),
('Perth', 2000000, 26),
('Adelaide', 1300000, 26);

-- Nova Zelândia
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Auckland', 1650000, 27),
('Wellington', 400000, 27),
('Christchurch', 400000, 27),
('Hamilton', 160000, 27),
('Dunedin', 120000, 27);

-- Fiji
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Suva', 90000, 28),
('Nadi', 40000, 28),
('Lautoka', 52000, 28),
('Labasa', 30000, 28),
('Ba', 33000, 28);

-- Papua-Nova Guiné
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Port Moresby', 400000, 29),
('Lae', 90000, 29),
('Mount Hagen', 50000, 29),
('Madang', 30000, 29),
('Wewak', 25000, 29);

-- Samoa
INSERT INTO cidades (nome, populacao, id_pais) VALUES 
('Apia', 37000, 30),
('Faleasiu', 10000, 30),
('Vaitele', 8000, 30),
('Siumu', 4000, 30),
('Leulumoega', 3000, 30);














