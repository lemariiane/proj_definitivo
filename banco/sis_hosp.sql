-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/04/2024 às 00:51
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sis_hosp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `nomepac` varchar(65) NOT NULL,
  `ficha` int(8) NOT NULL,
  `telefonepac` int(11) NOT NULL,
  `data` date NOT NULL,
  `horario` varchar(5) NOT NULL,
  `departamento` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `nome` varchar(65) NOT NULL,
  `numcar` int(15) NOT NULL,
  `email` varchar(65) NOT NULL,
  `telefone` int(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `password` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`nome`, `numcar`, `email`, `telefone`, `cpf`, `user`, `password`) VALUES
('Oliver Pontes Nunes', 123, 'oli@gmail.com', 2147483647, 51548, 'oli123', 123),
('Aline de Ramos', 124, 'ali@gmail.com', 2147483647, 878454, 'ali124', 1234);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_paciente`
--

CREATE TABLE `cadastro_paciente` (
  `ficha` int(8) DEFAULT NULL,
  `nomepac` varchar(65) NOT NULL,
  `endereco` varchar(65) NOT NULL,
  `datanasc` date NOT NULL,
  `telefonepac` int(11) NOT NULL,
  `cpfpac` int(11) NOT NULL,
  `pagamento` enum('convenio','particular') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logar`
--

CREATE TABLE `logar` (
  `numcar` int(15) NOT NULL,
  `password` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `relembra_senha`
--

CREATE TABLE `relembra_senha` (
  `cpf` int(11) NOT NULL,
  `email` varchar(65) NOT NULL,
  `numcar` int(15) NOT NULL,
  `new_password` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`ficha`);

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`numcar`,`cpf`,`user`,`password`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `telefone` (`telefone`) USING BTREE;

--
-- Índices de tabela `cadastro_paciente`
--
ALTER TABLE `cadastro_paciente`
  ADD PRIMARY KEY (`cpfpac`);

--
-- Índices de tabela `logar`
--
ALTER TABLE `logar`
  ADD PRIMARY KEY (`numcar`);

--
-- Índices de tabela `relembra_senha`
--
ALTER TABLE `relembra_senha`
  ADD PRIMARY KEY (`cpf`,`numcar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
