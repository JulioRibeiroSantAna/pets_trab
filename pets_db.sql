-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31/08/2025 às 04:56
-- Versão do servidor: 8.0.41
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pets_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `especies`
--

CREATE TABLE `especies` (
  `id_especie` int NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `especies`
--

INSERT INTO `especies` (`id_especie`, `nome`) VALUES
(1, 'Cachorro'),
(2, 'Gato'),
(3, 'Pássaro'),
(4, 'Peixe'),
(5, 'Coelho'),
(6, 'Hamster'),
(7, 'Tartaruga'),
(8, 'Furão'),
(9, 'Porquinho-da-índia'),
(10, 'Iguana'),
(11, 'Julio Ribeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pets`
--

CREATE TABLE `pets` (
  `id_pet` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `id_especie` int NOT NULL,
  `prontuario` text,
  `genero` enum('Macho','Fêmea') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pets`
--

INSERT INTO `pets` (`id_pet`, `nome`, `nascimento`, `id_especie`, `prontuario`, `genero`) VALUES
(1, 'Rex', '2020-05-15', 1, 'Animal saudável, vacinas em dia. Alergia a alguns tipos de ração.', 'Macho'),
(2, 'Luna', '2019-11-20', 2, 'Castrada. Necessita acompanhamento dental anual.', 'Fêmea'),
(3, 'Piu-Piu', '2022-02-10', 3, 'Canto muito alto pela manhã. Alimentação com ração específica para calopsitas.', 'Macho'),
(4, 'Nemo', '2023-01-05', 4, 'Aquário de 50 litros com temperatura controlada. Alimenta-se 3x ao dia.', 'Macho'),
(6, 'Nibbles', '2022-09-15', 6, 'Gosta de correr na rodinha à noite. Cuidado com barulhos altos.', 'Fêmea'),
(7, 'Shelly', '2018-04-22', 7, 'Tartaruga aquática. Troca de casco anual. Aquário com área seca.', 'Fêmea'),
(10, 'Spike', '2021-10-25', 10, 'Iguana verde. Terrário com controle de umidade e temperatura.', 'Macho'),
(11, 'Thor', '2019-08-12', 1, 'Cachorro grande porte. Adestrado. Gosta de nadar.', 'Macho'),
(12, 'Mel', '2020-04-05', 2, 'Gata siamesa. Olhos azuis. Muito carinhosa.', 'Fêmea'),
(15, 'Snowball', '2021-12-20', 5, 'Coelho anão. Pelagem branca. Muito tranquilo.', 'Macho');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(1, 'user', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id_especie`);

--
-- Índices de tabela `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id_pet`),
  ADD KEY `id_especie` (`id_especie`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `especies`
--
ALTER TABLE `especies`
  MODIFY `id_especie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `pets`
--
ALTER TABLE `pets`
  MODIFY `id_pet` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
