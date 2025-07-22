-- ####################################################################
-- #                                                                  #
-- #                  ARCHIVO SEEDER PARA JIMBO'S PALACE              #
-- #                                                                  #
-- ####################################################################

-- Primero, eliminamos los datos existentes en orden inverso para evitar conflictos de Foreign Key.
DELETE FROM transaccion;
DELETE FROM empleado;
DELETE FROM contrato;


-- ####################################################################
-- #                      INSERCIONES PARA CONTRATO                   #
-- ####################################################################
-- Se crean 20 contratos con diferentes duraciones y salarios.
INSERT INTO contrato (no_contrato, fecha_inicio, fecha_fin, salary) VALUES
(101, '2023-01-15', '2025-01-14', 2500000),
(102, '2023-02-01', '2024-02-01', 1800000),
(103, '2023-03-10', '2025-03-09', 4500000),
(104, '2023-04-20', '2024-10-20', 2200000),
(105, '2023-05-01', '2025-05-01', 3800000),
(106, '2023-06-15', '2024-06-15', 1900000),
(107, '2023-07-01', '2025-06-30', 5000000),
(108, '2023-08-05', '2024-08-05', 2100000),
(109, '2023-09-01', '2024-03-01', 1750000),
(110, '2023-10-10', '2025-10-10', 4800000),
(111, '2023-11-25', '2024-11-25', 2300000),
(112, '2023-12-01', '2025-11-30', 1950000),
(113, '2024-01-20', '2026-01-19', 5200000),
(114, '2024-02-15', '2025-02-15', 2400000),
(115, '2024-03-01', '2024-09-01', 2000000),
(116, '2024-04-10', '2026-04-10', 5500000),
(117, '2024-05-05', '2025-05-05', 2600000),
(118, '2024-06-01', '2025-06-01', 2150000),
(119, '2024-07-15', '2026-07-15', 6000000),
(120, '2024-08-01', '2025-01-31', 2250000);


-- ####################################################################
-- #                      INSERCIONES PARA EMPLEADO                   #
-- ####################################################################
-- Se crean 40 empleados, incluyendo Jefes de Sala y Crupieres.
-- Los Jefes de Sala (códigos impares) actúan como mentores.
INSERT INTO empleado (codigo, nombre_completo, codigo_mentor, tipo, area_asignada, codigo_certificacion, años_experiencia, juego_certificado, no_contrato) VALUES
-- Jefes de Sala
(1, 'Carlos Alberto Ramirez', NULL, 'JEFE DE SALA', 'Salón Principal', 9001, NULL, NULL, 103),
(3, 'Sofia Vergara Rojas', NULL, 'JEFE DE SALA', 'Salón VIP', 9002, NULL, NULL, 105),
(5, 'Andrés Felipe Morales', 1, 'JEFE DE SALA', 'Área de Torneos', 9003, NULL, NULL, 107),
(7, 'Valentina Zuluaga Giraldo', 1, 'JEFE DE SALA', 'Salón Principal', 9004, NULL, NULL, 110),
(9, 'Mateo Correa Palacio', 3, 'JEFE DE SALA', 'Salón VIP', 9005, NULL, NULL, 113),
(11, 'Mariana Restrepo Vélez', 3, 'JEFE DE SALA', 'Área de Torneos', 9006, NULL, NULL, 116),
(13, 'Javier Ignacio Osorio', 5, 'JEFE DE SALA', 'Salón Principal', 9007, NULL, NULL, 119),

-- Crupieres
(2, 'Juan Esteban Pérez', 1, 'CRUPIER', NULL, NULL, 5, 'Blackjack', 101),
(4, 'Ana María Jiménez', 1, 'CRUPIER', NULL, NULL, 3, 'Póker Texas Hold''em', 102),
(6, 'David Alejandro Gómez', 3, 'CRUPIER', NULL, NULL, 7, 'Ruleta Europea', 104),
(8, 'Laura Catalina Ortiz', 3, 'CRUPIER', NULL, NULL, 2, 'Baccarat', 106),
(10, 'Sebastián Londoño', 5, 'CRUPIER', NULL, NULL, 10, 'Póker Caribeño', 108),
(12, 'Camila Andrea Muñoz', 5, 'CRUPIER', NULL, NULL, 4, 'Blackjack', 109),
(14, 'Daniel José Ríos', 7, 'CRUPIER', NULL, NULL, 6, 'Póker Texas Hold''em', 111),
(15, 'Isabela Cardona', 7, 'CRUPIER', NULL, NULL, 1, 'Ruleta Americana', 112),
(16, 'Felipe Alarcón', 9, 'CRUPIER', NULL, NULL, 8, 'Baccarat', 114),
(17, 'Gabriela Soto', 9, 'CRUPIER', NULL, NULL, 3, 'Dados (Craps)', 115),
(18, 'Ricardo Mendoza', 11, 'CRUPIER', NULL, NULL, 12, 'Blackjack', 117),
(19, 'Daniela Vargas', 11, 'CRUPIER', NULL, NULL, 5, 'Póker Texas Hold''em', 118),
(20, 'Alejandro Torres', 13, 'CRUPIER', NULL, NULL, 2, 'Ruleta Europea', 120),
(21, 'Manuela Gallego', 1, 'CRUPIER', NULL, NULL, 4, 'Baccarat', 101),
(22, 'Esteban Chaves', 3, 'CRUPIER', NULL, NULL, 9, 'Póker Caribeño', 102),
(23, 'Juliana Betancur', 5, 'CRUPIER', NULL, NULL, 1, 'Blackjack', 104),
(24, 'Santiago Arango', 7, 'CRUPIER', NULL, NULL, 7, 'Póker Texas Hold''em', 106),
(25, 'Valeria Henao', 9, 'CRUPIER', NULL, NULL, 3, 'Ruleta Americana', 108),
(26, 'Simón Castro', 11, 'CRUPIER', NULL, NULL, 6, 'Baccarat', 109),
(27, 'Luciana Navarro', 13, 'CRUPIER', NULL, NULL, 2, 'Dados (Craps)', 111),
(28, 'Emilio Zapata', 1, 'CRUPIER', NULL, NULL, 11, 'Blackjack', 112),
(29, 'Antonia Jaramillo', 3, 'CRUPIER', NULL, NULL, 4, 'Póker Texas Hold''em', 114),
(30, 'Martín Serna', 5, 'CRUPIER', NULL, NULL, 8, 'Ruleta Europea', 115),
(31, 'Salomé Bedoya', 7, 'CRUPIER', NULL, NULL, 1, 'Baccarat', 117),
(32, 'Tomás Quintero', 9, 'CRUPIER', NULL, NULL, 5, 'Póker Caribeño', 118),
(33, 'Elena Montoya', 11, 'CRUPIER', NULL, NULL, 3, 'Blackjack', 120),
(34, 'Jerónimo Arias', 13, 'CRUPIER', NULL, NULL, 9, 'Póker Texas Hold''em', 101),
(35, 'Agustina Cano', 1, 'CRUPIER', NULL, NULL, 2, 'Ruleta Americana', 102),
(36, 'Benjamín Cárdenas', 3, 'CRUPIER', NULL, NULL, 7, 'Baccarat', 104),
(37, 'Victoria Mejía', 5, 'CRUPIER', NULL, NULL, 4, 'Dados (Craps)', 106),
(38, 'Samuel Villegas', 7, 'CRUPIER', NULL, NULL, 10, 'Blackjack', 108),
(39, 'Amelia Rendón', 9, 'CRUPIER', NULL, NULL, 1, 'Póker Texas Hold''em', 109),
(40, 'Maximiliano Duque', 11, 'CRUPIER', NULL, NULL, 6, 'Ruleta Europea', 111);


-- ####################################################################
-- #                    INSERCIONES PARA TRANSACCION                  #
-- ####################################################################
-- Se crean 100 transacciones de diferentes tipos.
-- El codigo_encargado es un crupier, y el codigo_revisor es un Jefe de Sala.
INSERT INTO transaccion (codigo, nombre_cliente, codigo_encargado, codigo_revisor, monto_dinero, fecha, hora, tipo, cantidad_fichas, nombre_torneo) VALUES
(1001, 'Luisa Fernanda W', 2, 1, 500000, '2023-03-20', '15:30:00', 'COMPRA FICHAS', 500, NULL),
(1002, 'Pipe Bueno', 4, 1, 300000, '2023-03-21', '16:00:00', 'COMPRA FICHAS', 300, NULL),
(1003, 'Maluma Baby', 6, 3, 1000000, '2023-04-15', '20:00:00', 'INSCRIPCION', NULL, 'Torneo de Verano VIP'),
(1004, 'J Balvin', 8, 3, 750000, '2023-04-16', '21:15:00', 'CANJE FICHAS', 750, NULL),
(1005, 'Karol G', 10, 5, 250000, '2023-05-10', '18:45:00', 'COMPRA FICHAS', 250, NULL),
(1006, 'Shakira', 12, 5, 2000000, '2023-05-11', '19:30:00', 'INSCRIPCION', NULL, 'Torneo de Estrellas'),
(1007, 'Juanes', 14, 7, 450000, '2023-06-05', '22:00:00', 'CANJE FICHAS', 450, NULL),
(1008, 'Carlos Vives', 15, 7, 600000, '2023-06-06', '23:00:00', 'COMPRA FICHAS', 600, NULL),
(1009, 'Fonseca', 16, 9, 800000, '2023-07-12', '14:20:00', 'COMPRA FICHAS', 800, NULL),
(1010, 'Andrés Cepeda', 17, 9, 1500000, '2023-07-13', '15:00:00', 'INSCRIPCION', NULL, 'Campeonato Nacional de Póker'),
(1011, 'Greeicy Rendón', 18, 11, 350000, '2023-08-20', '17:50:00', 'CANJE FICHAS', 350, NULL),
(1012, 'Mike Bahía', 19, 11, 400000, '2023-08-21', '18:30:00', 'COMPRA FICHAS', 400, NULL),
(1013, 'Sebastián Yatra', 20, 13, 900000, '2023-09-01', '20:10:00', 'COMPRA FICHAS', 900, NULL),
(1014, 'Camilo Echeverry', 21, 13, 1200000, '2023-09-02', '21:00:00', 'INSCRIPCION', NULL, 'Torneo Diamante'),
(1015, 'Evaluna Montaner', 22, 1, 200000, '2023-10-18', '16:45:00', 'CANJE FICHAS', 200, NULL),
(1016, 'Ricardo Montaner', 23, 1, 550000, '2023-10-19', '17:30:00', 'COMPRA FICHAS', 550, NULL),
(1017, 'Mau y Ricky', 24, 3, 700000, '2023-11-25', '19:00:00', 'COMPRA FICHAS', 700, NULL),
(1018, 'Piso 21', 25, 3, 1800000, '2023-11-26', '20:00:00', 'INSCRIPCION', NULL, 'Batalla de Bandas'),
(1019, 'ChocQuibTown', 26, 5, 480000, '2023-12-10', '22:30:00', 'CANJE FICHAS', 480, NULL),
(1020, 'Grupo Niche', 27, 5, 650000, '2023-12-11', '23:15:00', 'COMPRA FICHAS', 650, NULL),
(1021, 'Guayacán Orquesta', 28, 7, 720000, '2024-01-15', '14:00:00', 'COMPRA FICHAS', 720, NULL),
(1022, 'Fruko y sus Tesos', 29, 7, 2500000, '2024-01-16', '15:00:00', 'INSCRIPCION', NULL, 'Clásico Salsero'),
(1023, 'Joe Arroyo', 30, 9, 950000, '2024-02-20', '18:00:00', 'CANJE FICHAS', 950, NULL),
(1024, 'Diomedes Díaz', 31, 9, 300000, '2024-02-21', '19:00:00', 'COMPRA FICHAS', 300, NULL),
(1025, 'Rafael Orozco', 32, 11, 450000, '2024-03-05', '20:45:00', 'COMPRA FICHAS', 450, NULL),
(1026, 'Silvestre Dangond', 33, 11, 3000000, '2024-03-06', '21:30:00', 'INSCRIPCION', NULL, 'Festival Vallenato'),
(1027, 'Peter Manjarrés', 34, 13, 520000, '2024-04-10', '16:00:00', 'CANJE FICHAS', 520, NULL),
(1028, 'Jorge Celedón', 35, 13, 880000, '2024-04-11', '17:00:00', 'COMPRA FICHAS', 880, NULL),
(1029, 'Fanny Lu', 36, 1, 280000, '2024-05-18', '19:20:00', 'COMPRA FICHAS', 280, NULL),
(1030, 'Andrés Calamaro', 37, 1, 1100000, '2024-05-19', '20:10:00', 'INSCRIPCION', NULL, 'Rock en tu Idioma Fest'),
(1031, 'Gustavo Cerati', 38, 3, 1500000, '2024-06-22', '22:00:00', 'CANJE FICHAS', 1500, NULL),
(1032, 'Fito Páez', 39, 3, 780000, '2024-06-23', '23:00:00', 'COMPRA FICHAS', 780, NULL),
(1033, 'Charly García', 40, 5, 980000, '2024-07-01', '15:30:00', 'COMPRA FICHAS', 980, NULL),
(1034, 'Luis Alberto Spinetta', 2, 5, 4000000, '2024-07-02', '16:30:00', 'INSCRIPCION', NULL, 'Leyendas del Rock'),
(1035, 'Rigoberto Urán', 4, 7, 620000, '2024-08-10', '18:00:00', 'CANJE FICHAS', 620, NULL),
(1036, 'Nairo Quintana', 6, 7, 920000, '2024-08-11', '19:00:00', 'COMPRA FICHAS', 920, NULL),
(1037, 'Egan Bernal', 8, 9, 320000, '2024-09-14', '20:00:00', 'COMPRA FICHAS', 320, NULL),
(1038, 'Mariana Pajón', 10, 9, 2200000, '2024-09-15', '21:00:00', 'INSCRIPCION', NULL, 'Torneo de Campeones Olímpicos'),
(1039, 'Caterine Ibargüen', 12, 11, 710000, '2024-10-20', '22:00:00', 'CANJE FICHAS', 710, NULL),
(1040, 'James Rodríguez', 14, 11, 1300000, '2024-10-21', '23:00:00', 'COMPRA FICHAS', 1300, NULL),
(1041, 'Radamel Falcao', 15, 13, 850000, '2024-11-05', '14:00:00', 'COMPRA FICHAS', 850, NULL),
(1042, 'Juan Guillermo Cuadrado', 16, 13, 3500000, '2024-11-06', '15:00:00', 'INSCRIPCION', NULL, 'Copa de las Estrellas del Fútbol'),
(1043, 'David Ospina', 17, 1, 430000, '2024-12-12', '17:00:00', 'CANJE FICHAS', 430, NULL),
(1044, 'Yerry Mina', 18, 1, 970000, '2024-12-13', '18:00:00', 'COMPRA FICHAS', 970, NULL),
(1045, 'Duván Zapata', 19, 3, 580000, '2025-01-08', '19:00:00', 'COMPRA FICHAS', 580, NULL),
(1046, 'Luis Muriel', 20, 3, 2800000, '2025-01-09', '20:00:00', 'INSCRIPCION', NULL, 'Gran Torneo de Goleadores'),
(1047, 'Mateus Uribe', 21, 5, 680000, '2025-02-15', '21:00:00', 'CANJE FICHAS', 680, NULL),
(1048, 'Wilmar Barrios', 22, 5, 1100000, '2025-02-16', '22:00:00', 'COMPRA FICHAS', 1100, NULL),
(1049, 'Edwin Cardona', 23, 7, 380000, '2025-03-20', '23:00:00', 'COMPRA FICHAS', 380, NULL),
(1050, 'Juan Fernando Quintero', 24, 7, 4500000, '2025-03-21', '23:59:00', 'INSCRIPCION', NULL, 'Torneo de la Magia'),
(1051, 'Cliente Anónimo 1', 2, 1, 100000, '2023-04-01', '10:00:00', 'COMPRA FICHAS', 100, NULL),
(1052, 'Cliente Anónimo 2', 4, 1, 150000, '2023-04-02', '11:00:00', 'CANJE FICHAS', 150, NULL),
(1053, 'Cliente Anónimo 3', 6, 3, 200000, '2023-05-01', '12:00:00', 'COMPRA FICHAS', 200, NULL),
(1054, 'Cliente Anónimo 4', 8, 3, 250000, '2023-05-02', '13:00:00', 'CANJE FICHAS', 250, NULL),
(1055, 'Cliente Anónimo 5', 10, 5, 300000, '2023-06-01', '14:00:00', 'COMPRA FICHAS', 300, NULL),
(1056, 'Cliente Anónimo 6', 12, 5, 350000, '2023-06-02', '15:00:00', 'CANJE FICHAS', 350, NULL),
(1057, 'Cliente Anónimo 7', 14, 7, 400000, '2023-07-01', '16:00:00', 'COMPRA FICHAS', 400, NULL),
(1058, 'Cliente Anónimo 8', 15, 7, 450000, '2023-07-02', '17:00:00', 'CANJE FICHAS', 450, NULL),
(1059, 'Cliente Anónimo 9', 16, 9, 500000, '2023-08-01', '18:00:00', 'COMPRA FICHAS', 500, NULL),
(1060, 'Cliente Anónimo 10', 17, 9, 550000, '2023-08-02', '19:00:00', 'CANJE FICHAS', 550, NULL),
(1061, 'Cliente Anónimo 11', 18, 11, 600000, '2023-09-01', '20:00:00', 'COMPRA FICHAS', 600, NULL),
(1062, 'Cliente Anónimo 12', 19, 11, 650000, '2023-09-02', '21:00:00', 'CANJE FICHAS', 650, NULL),
(1063, 'Cliente Anónimo 13', 20, 13, 700000, '2023-10-01', '22:00:00', 'COMPRA FICHAS', 700, NULL),
(1064, 'Cliente Anónimo 14', 21, 13, 750000, '2023-10-02', '23:00:00', 'CANJE FICHAS', 750, NULL),
(1065, 'Cliente Anónimo 15', 22, 1, 800000, '2023-11-01', '10:30:00', 'COMPRA FICHAS', 800, NULL),
(1066, 'Cliente Anónimo 16', 23, 1, 850000, '2023-11-02', '11:30:00', 'CANJE FICHAS', 850, NULL),
(1067, 'Cliente Anónimo 17', 24, 3, 900000, '2023-12-01', '12:30:00', 'COMPRA FICHAS', 900, NULL),
(1068, 'Cliente Anónimo 18', 25, 3, 950000, '2023-12-02', '13:30:00', 'CANJE FICHAS', 950, NULL),
(1069, 'Cliente Anónimo 19', 26, 5, 1000000, '2024-01-01', '14:30:00', 'COMPRA FICHAS', 1000, NULL),
(1070, 'Cliente Anónimo 20', 27, 5, 1050000, '2024-01-02', '15:30:00', 'CANJE FICHAS', 1050, NULL),
(1071, 'Cliente Anónimo 21', 28, 7, 1100000, '2024-02-01', '16:30:00', 'COMPRA FICHAS', 1100, NULL),
(1072, 'Cliente Anónimo 22', 29, 7, 1150000, '2024-02-02', '17:30:00', 'CANJE FICHAS', 1150, NULL),
(1073, 'Cliente Anónimo 23', 30, 9, 1200000, '2024-03-01', '18:30:00', 'COMPRA FICHAS', 1200, NULL),
(1074, 'Cliente Anónimo 24', 31, 9, 1250000, '2024-03-02', '19:30:00', 'CANJE FICHAS', 1250, NULL),
(1075, 'Cliente Anónimo 25', 32, 11, 1300000, '2024-04-01', '20:30:00', 'COMPRA FICHAS', 1300, NULL),
(1076, 'Cliente Anónimo 26', 33, 11, 1350000, '2024-04-02', '21:30:00', 'CANJE FICHAS', 1350, NULL),
(1077, 'Cliente Anónimo 27', 34, 13, 1400000, '2024-05-01', '22:30:00', 'COMPRA FICHAS', 1400, NULL),
(1078, 'Cliente Anónimo 28', 35, 13, 1450000, '2024-05-02', '23:30:00', 'CANJE FICHAS', 1450, NULL),
(1079, 'Cliente Anónimo 29', 36, 1, 1500000, '2024-06-01', '09:00:00', 'COMPRA FICHAS', 1500, NULL),
(1080, 'Cliente Anónimo 30', 37, 1, 1550000, '2024-06-02', '09:30:00', 'CANJE FICHAS', 1550, NULL),
(1081, 'Cliente Anónimo 31', 38, 3, 1600000, '2024-07-01', '10:00:00', 'COMPRA FICHAS', 1600, NULL),
(1082, 'Cliente Anónimo 32', 39, 3, 1650000, '2024-07-02', '11:00:00', 'CANJE FICHAS', 1650, NULL),
(1083, 'Cliente Anónimo 33', 40, 5, 1700000, '2024-08-01', '12:00:00', 'COMPRA FICHAS', 1700, NULL),
(1084, 'Cliente Anónimo 34', 2, 5, 1750000, '2024-08-02', '13:00:00', 'CANJE FICHAS', 1750, NULL),
(1085, 'Cliente Anónimo 35', 4, 7, 1800000, '2024-09-01', '14:00:00', 'COMPRA FICHAS', 1800, NULL),
(1086, 'Cliente Anónimo 36', 6, 7, 1850000, '2024-09-02', '15:00:00', 'CANJE FICHAS', 1850, NULL),
(1087, 'Cliente Anónimo 37', 8, 9, 1900000, '2024-10-01', '16:00:00', 'COMPRA FICHAS', 1900, NULL),
(1088, 'Cliente Anónimo 38', 10, 9, 1950000, '2024-10-02', '17:00:00', 'CANJE FICHAS', 1950, NULL),
(1089, 'Cliente Anónimo 39', 12, 11, 2000000, '2024-11-01', '18:00:00', 'COMPRA FICHAS', 2000, NULL),
(1090, 'Cliente Anónimo 40', 14, 11, 2050000, '2024-11-02', '19:00:00', 'CANJE FICHAS', 2050, NULL),
(1091, 'Cliente Anónimo 41', 15, 13, 2100000, '2024-12-01', '20:00:00', 'COMPRA FICHAS', 2100, NULL),
(1092, 'Cliente Anónimo 42', 16, 13, 2150000, '2024-12-02', '21:00:00', 'CANJE FICHAS', 2150, NULL),
(1093, 'Cliente Anónimo 43', 17, 1, 2200000, '2025-01-01', '22:00:00', 'COMPRA FICHAS', 2200, NULL),
(1094, 'Cliente Anónimo 44', 18, 1, 2250000, '2025-01-02', '23:00:00', 'CANJE FICHAS', 2250, NULL),
(1095, 'Cliente Anónimo 45', 19, 3, 2300000, '2025-02-01', '08:00:00', 'COMPRA FICHAS', 2300, NULL),
(1096, 'Cliente Anónimo 46', 20, 3, 2350000, '2025-02-02', '08:30:00', 'CANJE FICHAS', 2350, NULL),
(1097, 'Cliente Anónimo 47', 21, 5, 5000000, '2025-03-01', '09:00:00', 'INSCRIPCION', NULL, 'Torneo Final de Temporada'),
(1098, 'Cliente Anónimo 48', 22, 5, 2450000, '2025-03-02', '09:30:00', 'CANJE FICHAS', 2450, NULL),
(1099, 'Cliente Anónimo 49', 23, 7, 2500000, '2025-04-01', '10:00:00', 'COMPRA FICHAS', 2500, NULL),
(1100, 'Cliente Anónimo 50', 24, 7, 2550000, '2025-04-02', '11:00:00', 'CANJE FICHAS', 2550, NULL);

