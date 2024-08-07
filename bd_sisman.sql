-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Ago-2024 às 20:44
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

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
  `nota_fiscal` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `fornecedor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `compras`
--

INSERT INTO `compras` (`cod_compra`, `nota_fiscal`, `data`, `fornecedor`) VALUES
(1, 'NF001', '2024-07-01', 'Fornecedor A'),
(2, 'NF002', '2024-07-05', 'Fornecedor B'),
(3, 'NF003', '2024-07-10', 'Fornecedor C'),
(4, 'NF004', '2024-07-15', 'Fornecedor D');

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
(1, 1, '2024-08-10', 1, 1),
(2, 2, '2024-08-11', 2, 2),
(3, 3, '2024-08-12', 3, 3),
(4, 4, '2024-08-13', 4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `cod_funcionario` int(11) NOT NULL,
  `nome_funcionario` varchar(100) DEFAULT NULL,
  `cpf_funcionario` varchar(14) DEFAULT NULL,
  `matricula` varchar(20) DEFAULT NULL,
  `email_funcionario` varchar(100) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`cod_funcionario`, `nome_funcionario`, `cpf_funcionario`, `matricula`, `email_funcionario`, `senha`, `perfil`) VALUES
(1, 'João Silva', '12345678901', 'F001', 'joao.silva@email.com', 'senha123', 1),
(2, 'Maria Santos', '23456789012', 'F002', 'maria.santos@email.com', 'senha456', 2),
(3, 'Pedro Oliveira', '34567890123', 'F003', 'pedro.oliveira@email.com', 'senha789', 1),
(4, 'Ana Rodrigues', '45678901234', 'F004', 'ana.rodrigues@email.com', 'senha012', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_entrega`
--

CREATE TABLE `itens_entrega` (
  `item` int(11) NOT NULL,
  `cod_entrega` int(11) NOT NULL,
  `cod_medicamento` int(11) DEFAULT NULL,
  `qtde_medicamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `itens_entrega`
--

INSERT INTO `itens_entrega` (`item`, `cod_entrega`, `cod_medicamento`, `qtde_medicamento`) VALUES
(1, 1, 1, 30),
(1, 2, 3, 15),
(1, 3, 4, 10),
(2, 1, 2, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `cod_medicamento` int(11) NOT NULL,
  `cod_compra` int(11) DEFAULT NULL,
  `nome_medicamento` varchar(100) DEFAULT NULL,
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
(1, 1, 'Paracetamol', 'Comprimido', 'Analgésico', 'Lab A', 'LOTE001', '2025-12-31', 1000),
(2, 2, 'Amoxicilina', 'Cápsula', 'Antibiótico', 'Lab B', 'LOTE002', '2025-10-31', 500),
(3, 3, 'Omeprazol', 'Comprimido', 'Antiácido', 'Lab C', 'LOTE003', '2026-06-30', 750),
(4, 4, 'Dipirona', 'Gotas', 'Analgésico', 'Lab D', 'LOTE004', '2025-08-31', 300),
(5, 1, 'Ibuprofeno', 'Comprimido', 'Analgésico', 'Lab A', 'LOTE005', '2025-09-30', 400),
(6, 2, 'Ibuprofeno', 'Gel', 'Analgésico', 'Lab A', 'LOTE006', '2025-11-30', 450),
(7, 3, 'Amoxicilina', 'Cápsula', 'Antibiótico', 'Lab B', 'LOTE007', '2026-01-31', 350),
(8, 4, 'Amoxicilina', 'Suspensão', 'Antibiótico', 'Lab B', 'LOTE008', '2025-12-31', 600),
(9, 1, 'Omeprazol', 'Comprimido', 'Antiácido', 'Lab C', 'LOTE009', '2026-03-31', 800),
(10, 2, 'Omeprazol', 'Cápsula', 'Antiácido', 'Lab C', 'LOTE010', '2026-02-28', 500),
(11, 3, 'Dipirona', 'Gotas', 'Analgésico', 'Lab D', 'LOTE011', '2025-10-31', 450),
(12, 4, 'Dipirona', 'Comprimido', 'Analgésico', 'Lab D', 'LOTE012', '2026-04-30', 700),
(13, 1, 'Paracetamol', 'Comprimido', 'Analgésico', 'Lab E', 'LOTE013', '2026-05-31', 600),
(14, 2, 'Paracetamol', 'Xarope', 'Analgésico', 'Lab E', 'LOTE014', '2026-06-30', 550),
(15, 3, 'Cefalexina', 'Cápsula', 'Antibiótico', 'Lab F', 'LOTE015', '2026-07-31', 500),
(16, 4, 'Cefalexina', 'Suspensão', 'Antibiótico', 'Lab F', 'LOTE016', '2025-09-30', 300),
(17, 1, 'Loratadina', 'Comprimido', 'Antialérgico', 'Lab G', 'LOTE017', '2026-08-31', 400),
(18, 2, 'Loratadina', 'Xarope', 'Antialérgico', 'Lab G', 'LOTE018', '2025-10-31', 450),
(19, 3, 'Salbutamol', 'Spray', 'Broncodilatador', 'Lab H', 'LOTE019', '2025-12-31', 600),
(20, 4, 'Salbutamol', 'Xarope', 'Broncodilatador', 'Lab H', 'LOTE020', '2026-01-31', 500),
(21, 1, 'Metformina', 'Comprimido', 'Antidiabético', 'Lab I', 'LOTE021', '2026-03-31', 800),
(22, 2, 'Metformina', 'Xarope', 'Antidiabético', 'Lab I', 'LOTE022', '2026-04-30', 400),
(23, 3, 'Fluconazol', 'Cápsula', 'Antifúngico', 'Lab J', 'LOTE023', '2026-05-31', 500),
(24, 4, 'Fluconazol', 'Creme', 'Antifúngico', 'Lab J', 'LOTE024', '2026-06-30', 300),
(25, 1, 'Cetoprofeno', 'Comprimido', 'Anti-inflamatório', 'Lab K', 'LOTE025', '2025-10-31', 450),
(26, 2, 'Cetoprofeno', 'Gel', 'Anti-inflamatório', 'Lab K', 'LOTE026', '2026-07-31', 350),
(27, 3, 'Lansoprazol', 'Comprimido', 'Antiácido', 'Lab L', 'LOTE027', '2026-01-31', 700),
(28, 4, 'Lansoprazol', 'Cápsula', 'Antiácido', 'Lab L', 'LOTE028', '2026-08-31', 600),
(29, 1, 'Atenolol', 'Comprimido', 'Anti-hipertensivo', 'Lab M', 'LOTE029', '2026-02-28', 550),
(30, 2, 'Atenolol', 'Suspensão', 'Anti-hipertensivo', 'Lab M', 'LOTE030', '2025-09-30', 300),
(31, 3, 'Losartana', 'Comprimido', 'Anti-hipertensivo', 'Lab N', 'LOTE031', '2026-03-31', 400),
(32, 4, 'Losartana', 'Xarope', 'Anti-hipertensivo', 'Lab N', 'LOTE032', '2026-04-30', 450),
(33, 1, 'Levotiroxina', 'Comprimido', 'Hormonal', 'Lab O', 'LOTE033', '2026-05-31', 500),
(34, 2, 'Levotiroxina', 'Suspensão', 'Hormonal', 'Lab O', 'LOTE034', '2026-06-30', 600),
(35, 3, 'Clonazepam', 'Comprimido', 'Ansiolítico', 'Lab P', 'LOTE035', '2026-07-31', 300),
(36, 4, 'Clonazepam', 'Gotas', 'Ansiolítico', 'Lab P', 'LOTE036', '2025-09-30', 200),
(37, 1, 'Sertralina', 'Comprimido', 'Antidepressivo', 'Lab Q', 'LOTE037', '2026-08-31', 400),
(38, 2, 'Sertralina', 'Suspensão', 'Antidepressivo', 'Lab Q', 'LOTE038', '2025-10-31', 300),
(39, 3, 'Budesonida', 'Spray', 'Corticosteroide', 'Lab R', 'LOTE039', '2025-12-31', 600),
(40, 4, 'Budesonida', 'Inalador', 'Corticosteroide', 'Lab R', 'LOTE040', '2026-01-31', 500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos_processo`
--

CREATE TABLE `medicamentos_processo` (
  `cod_medicamento` int(11) NOT NULL,
  `cod_processo` int(11) NOT NULL,
  `nome_medicamento` varchar(100) DEFAULT NULL,
  `tipo_medicamento` varchar(50) DEFAULT NULL,
  `categoria_medicamento` varchar(50) DEFAULT NULL,
  `laboratorio` varchar(100) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `medicamentos_processo`
--

INSERT INTO `medicamentos_processo` (`cod_medicamento`, `cod_processo`, `nome_medicamento`, `tipo_medicamento`, `categoria_medicamento`, `laboratorio`, `quantidade`) VALUES
(1, 1, 'Paracetamol', 'Comprimido', 'Analgésico', 'Lab A', 30),
(2, 2, 'Amoxicilina', 'Cápsula', 'Antibiótico', 'Lab B', 20),
(3, 3, 'Omeprazol', 'Comprimido', 'Antiácido', 'Lab C', 15),
(4, 4, 'Dipirona', 'Gotas', 'Analgésico', 'Lab D', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `cod_medico` int(11) NOT NULL,
  `nome_medico` varchar(100) DEFAULT NULL,
  `cpf_medico` varchar(14) DEFAULT NULL,
  `crm` varchar(20) DEFAULT NULL,
  `especialidade` varchar(50) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`cod_medico`, `nome_medico`, `cpf_medico`, `crm`, `especialidade`, `celular`) VALUES
(1, 'Dr. Carlos Ferreira', '56789012345', 'CRM12345', 'Cardiologia', '11987654321'),
(2, 'Dra. Juliana Alves', '67890123456', 'CRM23456', 'Pediatria', '11976543210'),
(3, 'Dr. Roberto Souza', '78901234567', 'CRM34567', 'Ortopedia', '11965432109'),
(4, 'Dra. Camila Lima', '89012345678', 'CRM45678', 'Dermatologia', '11954321098');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `cod_paciente` int(11) NOT NULL,
  `nome_paciente` varchar(100) DEFAULT NULL,
  `cpf_paciente` varchar(14) DEFAULT NULL,
  `cns_paciente` varchar(20) DEFAULT NULL,
  `logradouro` varchar(100) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`cod_paciente`, `nome_paciente`, `cpf_paciente`, `cns_paciente`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `estado`, `celular`) VALUES
(1, 'Fernanda Costa', '90123456789', 'CNS111222333', 'Rua das Flores', 123, 'Apto 101', 'Centro', 'São Paulo', '01234-567', 'SP', '11912345678'),
(2, 'Ricardo Nunes', '01234567890', 'CNS222333444', 'Av. Principal', 456, NULL, 'Jardim', 'Rio de Janeiro', '23456-789', 'RJ', '21923456789'),
(3, 'Mariana Barbosa', '12345678901', 'CNS333444555', 'Rua do Comércio', 789, 'Casa', 'Vila Nova', 'Belo Horizonte', '34567-890', 'MG', '31934567890'),
(4, 'Lucas Ferreira', '23456789012', 'CNS444555666', 'Alameda dos Anjos', 1010, 'Bloco B', 'Boa Vista', 'Porto Alegre', '45678-901', 'RS', '51945678901');

-- --------------------------------------------------------

--
-- Estrutura da tabela `processos`
--

CREATE TABLE `processos` (
  `cod_processo` int(11) NOT NULL,
  `numero_processo` varchar(20) DEFAULT NULL,
  `cod_paciente` int(11) DEFAULT NULL,
  `copia_processo` varchar(100) DEFAULT NULL,
  `receita` varchar(100) DEFAULT NULL,
  `cod_medico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `processos`
--

INSERT INTO `processos` (`cod_processo`, `numero_processo`, `cod_paciente`, `copia_processo`, `receita`, `cod_medico`) VALUES
(1, 'PROC2024001', 1, 'Cópia 001', 'Receita 001', 1),
(2, 'PROC2024002', 2, 'Cópia 002', 'Receita 002', 2),
(3, 'PROC2024003', 3, 'Cópia 003', 'Receita 003', 3),
(4, 'PROC2024004', 4, 'Cópia 004', 'Receita 004', 4);

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
  ADD PRIMARY KEY (`cod_entrega`),
  ADD KEY `cod_paciente` (`cod_paciente`),
  ADD KEY `cod_processo` (`cod_processo`),
  ADD KEY `cod_funcionario` (`cod_funcionario`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`cod_funcionario`);

--
-- Índices para tabela `itens_entrega`
--
ALTER TABLE `itens_entrega`
  ADD PRIMARY KEY (`item`,`cod_entrega`),
  ADD KEY `cod_entrega` (`cod_entrega`),
  ADD KEY `cod_medicamento` (`cod_medicamento`);

--
-- Índices para tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`cod_medicamento`),
  ADD KEY `cod_compra` (`cod_compra`);

--
-- Índices para tabela `medicamentos_processo`
--
ALTER TABLE `medicamentos_processo`
  ADD PRIMARY KEY (`cod_medicamento`,`cod_processo`),
  ADD KEY `cod_processo` (`cod_processo`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`cod_medico`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`cod_paciente`);

--
-- Índices para tabela `processos`
--
ALTER TABLE `processos`
  ADD PRIMARY KEY (`cod_processo`),
  ADD KEY `cod_paciente` (`cod_paciente`),
  ADD KEY `cod_medico` (`cod_medico`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `entregas`
--
ALTER TABLE `entregas`
  ADD CONSTRAINT `entregas_ibfk_1` FOREIGN KEY (`cod_paciente`) REFERENCES `pacientes` (`cod_paciente`),
  ADD CONSTRAINT `entregas_ibfk_2` FOREIGN KEY (`cod_processo`) REFERENCES `processos` (`cod_processo`),
  ADD CONSTRAINT `entregas_ibfk_3` FOREIGN KEY (`cod_funcionario`) REFERENCES `funcionarios` (`cod_funcionario`);

--
-- Limitadores para a tabela `itens_entrega`
--
ALTER TABLE `itens_entrega`
  ADD CONSTRAINT `itens_entrega_ibfk_1` FOREIGN KEY (`cod_entrega`) REFERENCES `entregas` (`cod_entrega`),
  ADD CONSTRAINT `itens_entrega_ibfk_2` FOREIGN KEY (`cod_medicamento`) REFERENCES `medicamentos` (`cod_medicamento`);

--
-- Limitadores para a tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamentos_ibfk_1` FOREIGN KEY (`cod_compra`) REFERENCES `compras` (`cod_compra`);

--
-- Limitadores para a tabela `medicamentos_processo`
--
ALTER TABLE `medicamentos_processo`
  ADD CONSTRAINT `medicamentos_processo_ibfk_1` FOREIGN KEY (`cod_medicamento`) REFERENCES `medicamentos` (`cod_medicamento`),
  ADD CONSTRAINT `medicamentos_processo_ibfk_2` FOREIGN KEY (`cod_processo`) REFERENCES `processos` (`cod_processo`);

--
-- Limitadores para a tabela `processos`
--
ALTER TABLE `processos`
  ADD CONSTRAINT `processos_ibfk_1` FOREIGN KEY (`cod_paciente`) REFERENCES `pacientes` (`cod_paciente`),
  ADD CONSTRAINT `processos_ibfk_2` FOREIGN KEY (`cod_medico`) REFERENCES `medicos` (`cod_medico`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
