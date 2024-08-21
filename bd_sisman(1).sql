-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Ago-2024 às 19:30
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_sisman`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE `compras` (
  `cod_compra` int(11) NOT NULL,
  `nota_fiscal` varchar(250) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `fornecedor` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`cod_compra`, `nota_fiscal`, `data`, `fornecedor`) VALUES
(1, 'NF001', '2023-05-15', 'Fornecedor A'),
(2, 'NF002', '2023-08-01', 'Fornecedor B');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entregas`
--

CREATE TABLE `entregas` (
  `cod_entrega` int(11) NOT NULL,
  `cod_paciente` int(11) DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `cod_processo` int(11) DEFAULT NULL,
  `cod_funcionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `entregas`
--

INSERT INTO `entregas` (`cod_entrega`, `cod_paciente`, `data_entrega`, `cod_processo`, `cod_funcionario`) VALUES
(1, 1, '2023-06-01', 1, 1),
(2, 2, '2023-09-15', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `cod_funcionario` int(11) NOT NULL,
  `nome_funcionario` varchar(150) DEFAULT NULL,
  `cpf_funcionario` varchar(15) DEFAULT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `email_funcionario` varchar(200) DEFAULT NULL,
  `senha` varchar(8) DEFAULT NULL,
  `perfil` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`cod_funcionario`, `nome_funcionario`, `cpf_funcionario`, `matricula`, `email_funcionario`, `senha`, `perfil`) VALUES
(1, 'João Silva', '123.456.789-00', '123456', 'joao.silva@exemplo.com', 'senha123', 1),
(2, 'Maria Oliveira', '987.654.321-00', '654321', 'maria.oliveira@exemplo.com', 'senha456', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_entrega`
--

CREATE TABLE `itens_entrega` (
  `item` int(11) NOT NULL,
  `cod_entrega` int(11) DEFAULT NULL,
  `cod_medicamento` int(11) DEFAULT NULL,
  `qtde_medicamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `itens_entrega`
--

INSERT INTO `itens_entrega` (`item`, `cod_entrega`, `cod_medicamento`, `qtde_medicamento`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 5),
(3, 2, 2, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `cod_medicamento` int(11) NOT NULL,
  `cod_compra` int(11) DEFAULT NULL,
  `nome_medicamento` varchar(250) DEFAULT NULL,
  `tipo_medicamento` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `laboratorio` varchar(100) DEFAULT NULL,
  `lote` varchar(20) DEFAULT NULL,
  `validade` date DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `medicamentos`
--

INSERT INTO `medicamentos` (`cod_medicamento`, `cod_compra`, `nome_medicamento`, `tipo_medicamento`, `categoria`, `laboratorio`, `lote`, `validade`, `quantidade`) VALUES
(1, 1, 'Paracetamol', 'Comprimido', 'Analgésico', 'Laboratório X', '12345', '2025-12-31', 500),
(2, 2, 'Amoxicilina', 'Cápsula', 'Antibiótico', 'Laboratório Y', '67890', '2026-06-30', 300);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos_processo`
--

CREATE TABLE `medicamentos_processo` (
  `cod_medicamento_processo` int(11) NOT NULL,
  `cod_processo` int(11) DEFAULT NULL,
  `nome_medicamento` varchar(100) DEFAULT NULL,
  `tipo_medicamento` varchar(100) DEFAULT NULL,
  `categoria_medicamento` varchar(100) DEFAULT NULL,
  `laboratorio` varchar(100) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `medicamentos_processo`
--

INSERT INTO `medicamentos_processo` (`cod_medicamento_processo`, `cod_processo`, `nome_medicamento`, `tipo_medicamento`, `categoria_medicamento`, `laboratorio`, `quantidade`) VALUES
(1, 1, 'Paracetamol', 'Comprimido', 'Analgésico', 'Laboratório X', 10),
(2, 2, 'Amoxicilina', 'Cápsula', 'Antibiótico', 'Laboratório Y', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `cod_medico` int(11) NOT NULL,
  `nome_medico` varchar(250) DEFAULT NULL,
  `cpf_medico` varchar(20) DEFAULT NULL,
  `crm` varchar(20) DEFAULT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`cod_medico`, `nome_medico`, `cpf_medico`, `crm`, `especialidade`, `celular`) VALUES
(1, 'Dr. João Silva', '123.456.789-00', '12345', 'Clínico Geral', '(11) 98765-4321'),
(2, 'Dra. Maria Oliveira', '987.654.321-00', '54321', 'Pediatra', '(21) 87654-3210');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `cod_paciente` int(11) NOT NULL,
  `nome_paciente` varchar(150) DEFAULT NULL,
  `cpf_paciente` varchar(15) DEFAULT NULL,
  `cns_paciente` varchar(20) DEFAULT NULL,
  `logradouro` varchar(250) DEFAULT NULL,
  `numero` int(6) DEFAULT NULL,
  `complemento` varchar(30) DEFAULT NULL,
  `bairro` varchar(150) DEFAULT NULL,
  `cidade` varchar(150) DEFAULT NULL,
  `cep` varchar(12) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`cod_paciente`, `nome_paciente`, `cpf_paciente`, `cns_paciente`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `estado`, `celular`) VALUES
(1, 'Pedro Almeida', '123.456.789-00', '123456789', 'Rua A, 123', 123, 'Apt 456', 'Bairro X', 'Cidade Y', '12345-678', 'SP', '(11) 98765-4321'),
(2, 'Ana Souza', '987.654.321-00', '987654321', 'Avenida B, 456', 456, 'Casa 789', 'Bairro Z', 'Cidade W', '98765-432', 'RJ', '(21) 87654-3210');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE `processos` (
  `cod_processo` int(11) NOT NULL,
  `numero_processo` varchar(50) DEFAULT NULL,
  `cod_paciente` int(11) DEFAULT NULL,
  `copia_processo` varchar(100) DEFAULT NULL,
  `receita` varchar(100) DEFAULT NULL,
  `cod_medico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`cod_processo`, `numero_processo`, `cod_paciente`, `copia_processo`, `receita`, `cod_medico`) VALUES
(1, 'ABC123', 1, 'Arquivo001.pdf', 'Receita001.txt', 1),
(2, 'DEF456', 2, 'Arquivo002.pdf', 'Receita002.txt', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`cod_compra`);

--
-- Índices para tabela `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`cod_entrega`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`cod_funcionario`),
  ADD UNIQUE KEY `cpf_funcionario` (`cpf_funcionario`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- Índices para tabela `itens_entrega`
--
ALTER TABLE `itens_entrega`
  ADD PRIMARY KEY (`item`);

--
-- Índices para tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`cod_medicamento`);

--
-- Índices para tabela `medicamentos_processo`
--
ALTER TABLE `medicamentos_processo`
  ADD PRIMARY KEY (`cod_medicamento_processo`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`cod_medico`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`cod_paciente`),
  ADD UNIQUE KEY `cpf_paciente` (`cpf_paciente`),
  ADD UNIQUE KEY `cns_paciente` (`cns_paciente`);

--
-- Índices para tabela `processos`
--
ALTER TABLE `processos`
  ADD PRIMARY KEY (`cod_processo`),
  ADD UNIQUE KEY `numero_processo` (`numero_processo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `cod_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `entregas`
--
ALTER TABLE `entregas`
  MODIFY `cod_entrega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `cod_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `itens_entrega`
--
ALTER TABLE `itens_entrega`
  MODIFY `item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `cod_medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `medicamentos_processo`
--
ALTER TABLE `medicamentos_processo`
  MODIFY `cod_medicamento_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `cod_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `cod_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `processos`
--
ALTER TABLE `processos`
  MODIFY `cod_processo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
