-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/11/2024 às 18:19
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbmat`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexos`
--

CREATE TABLE `anexos` (
  `aid` int(11) NOT NULL,
  `relatorioFinal` varchar(255) DEFAULT NULL,
  `relatorioComando` varchar(255) DEFAULT NULL,
  `fotos` varchar(255) DEFAULT NULL,
  `outrosDocumentos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anexos`
--

INSERT INTO `anexos` (`aid`, `relatorioFinal`, `relatorioComando`, `fotos`, `outrosDocumentos`) VALUES
(1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `efetivo`
--

CREATE TABLE `efetivo` (
  `eid` int(11) NOT NULL,
  `participantes` varchar(225) DEFAULT NULL,
  `participantesEb` tinyint(1) DEFAULT NULL,
  `participantesMb` tinyint(1) DEFAULT NULL,
  `participantesFab` tinyint(1) DEFAULT NULL,
  `participantesOs` tinyint(1) DEFAULT NULL,
  `participantesGov` tinyint(1) DEFAULT NULL,
  `participantesPv` tinyint(1) DEFAULT NULL,
  `participantesCv` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `efetivo`
--

INSERT INTO `efetivo` (`eid`, `participantes`, `participantesEb`, `participantesMb`, `participantesFab`, `participantesOs`, `participantesGov`, `participantesPv`, `participantesCv`) VALUES
(1, 'adf', 12, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `infos`
--

CREATE TABLE `infos` (
  `iid` int(11) NOT NULL,
  `outrasInfos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `infos`
--

INSERT INTO `infos` (`iid`, `outrasInfos`) VALUES
(1, 'sads');

-- --------------------------------------------------------

--
-- Estrutura para tabela `operacao`
--

CREATE TABLE `operacao` (
  `opid` int(11) NOT NULL,
  `operador` varchar(255) DEFAULT NULL,
  `operacao` varchar(350) DEFAULT NULL,
  `estado` varchar(350) DEFAULT NULL,
  `missao` varchar(350) DEFAULT NULL,
  `cma` varchar(100) DEFAULT NULL,
  `rm` varchar(50) DEFAULT NULL,
  `comandoOp` varchar(199) DEFAULT NULL,
  `comandoApoio` varchar(200) DEFAULT NULL,
  `inicioOp` date DEFAULT NULL,
  `fimOp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `operacao`
--

INSERT INTO `operacao` (`opid`, `operador`, `operacao`, `estado`, `missao`, `cma`, `rm`, `comandoOp`, `comandoApoio`, `inicioOp`, `fimOp`) VALUES
(1, 'victor', 'sada', 'Acre', 'sada', 'Comando Militar do Planalto', '7ª região militar', 'sda', 'hbhv', '0012-02-12', '0012-02-21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `recursos`
--

CREATE TABLE `recursos` (
  `rid` int(11) NOT NULL,
  `recebidos` tinyint(1) DEFAULT NULL,
  `descentralizados` tinyint(1) DEFAULT NULL,
  `empenhados` tinyint(1) DEFAULT NULL,
  `devolvidos` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `recursos`
--

INSERT INTO `recursos` (`rid`, `recebidos`, `descentralizados`, `empenhados`, `devolvidos`) VALUES
(1, 12, 127, 12, 127);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoop`
--

CREATE TABLE `tipoop` (
  `tid` int(11) NOT NULL,
  `tipoOp` varchar(225) DEFAULT NULL,
  `acaoOuApoio` varchar(225) DEFAULT NULL,
  `transporte` varchar(255) DEFAULT NULL,
  `manutencao` varchar(255) DEFAULT NULL,
  `aviacao` varchar(255) DEFAULT NULL,
  `suprimento` varchar(255) DEFAULT NULL,
  `desTransporte` varchar(255) DEFAULT NULL,
  `desManutencao` varchar(255) DEFAULT NULL,
  `desSuprimento` varchar(255) DEFAULT NULL,
  `desAviacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipoop`
--

INSERT INTO `tipoop` (`tid`, `tipoOp`, `acaoOuApoio`, `transporte`, `manutencao`, `aviacao`, `suprimento`, `desTransporte`, `desManutencao`, `desSuprimento`, `desAviacao`) VALUES
(1, 'Emprego', 'logística para Operações de Garantia da Soberania', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`aid`);

--
-- Índices de tabela `efetivo`
--
ALTER TABLE `efetivo`
  ADD PRIMARY KEY (`eid`);

--
-- Índices de tabela `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`iid`);

--
-- Índices de tabela `operacao`
--
ALTER TABLE `operacao`
  ADD PRIMARY KEY (`opid`);

--
-- Índices de tabela `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`rid`);

--
-- Índices de tabela `tipoop`
--
ALTER TABLE `tipoop`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `efetivo`
--
ALTER TABLE `efetivo`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `infos`
--
ALTER TABLE `infos`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `operacao`
--
ALTER TABLE `operacao`
  MODIFY `opid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `recursos`
--
ALTER TABLE `recursos`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tipoop`
--
ALTER TABLE `tipoop`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
