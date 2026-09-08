-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/09/2026 às 01:50
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
-- Banco de dados: `marmitaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairros`
--

CREATE TABLE `bairros` (
  `id_bairro` bigint(20) NOT NULL,
  `nm_bairro` varchar(100) DEFAULT NULL,
  `nr_frete` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bairros`
--

INSERT INTO `bairros` (`id_bairro`, `nm_bairro`, `nr_frete`) VALUES
(1, 'Centro', 2.00),
(2, 'Paraná D\'Oeste', 10.00),
(3, 'Vila Belém', 8.00),
(4, 'Vila Gianello', 8.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` bigint(20) NOT NULL,
  `nm_cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nm_cargo`) VALUES
(1, 'Cozinheiro(a)'),
(2, 'Atendente'),
(3, 'Entregador(a)'),
(4, 'Gerente'),
(5, 'Auxiliar de Cozinha');

-- --------------------------------------------------------

--
-- Estrutura para tabela `diasemana`
--

CREATE TABLE `diasemana` (
  `id_dia` bigint(20) NOT NULL,
  `nm_dia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `diasemana`
--

INSERT INTO `diasemana` (`id_dia`, `nm_dia`) VALUES
(1, 'Segunda'),
(2, 'Terça'),
(3, 'Quarta'),
(4, 'Quinta'),
(5, 'Sexta'),
(6, 'Sábado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dia_marmita`
--

CREATE TABLE `dia_marmita` (
  `id_marmita` bigint(20) NOT NULL,
  `id_dia` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dia_marmita`
--

INSERT INTO `dia_marmita` (`id_marmita`, `id_dia`) VALUES
(7, 1),
(8, 2),
(9, 3),
(10, 4),
(11, 5),
(12, 6),
(13, 6),
(14, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` bigint(20) NOT NULL,
  `nm_funcionario` varchar(100) NOT NULL,
  `nr_telefone` varchar(20) DEFAULT NULL,
  `nr_salario` decimal(10,2) NOT NULL,
  `id_cargo` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`id_funcionario`, `nm_funcionario`, `nr_telefone`, `nr_salario`, `id_cargo`) VALUES
(1, 'Matheus Antonio Milam Luiz', '44997408403', 15000.00, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `marmita`
--

CREATE TABLE `marmita` (
  `id_marmita` bigint(20) NOT NULL,
  `nm_marmita` varchar(100) NOT NULL,
  `ds_marmita` varchar(200) DEFAULT NULL,
  `nr_preco` decimal(5,2) DEFAULT NULL,
  `img_marmita` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marmita`
--

INSERT INTO `marmita` (`id_marmita`, `nm_marmita`, `ds_marmita`, `nr_preco`, `img_marmita`) VALUES
(7, 'Frango com batata', 'Frango com batata com macarrão, farofa, arroz e feijão, acompanhados de salada', 22.90, 'frango.jpg'),
(8, 'Bife acebolado', 'Bife acebolado com macarrão, farofa, arroz e feijão, acompanhado de salada', 20.92, 'bife.jpg'),
(9, 'Strogonoff de frango', 'Strogonoff de frango com batata palha, farofa, arroz e feijão, acompanhado de salada', 24.90, 'strogonoff.jpg'),
(10, 'Porco no tacho', 'Carne de porco frita no tacho com farofa, macarrão, arroz e feijão, acompanhado de salada', 22.90, 'porco.jpg'),
(11, 'Carne de boi com batata', 'Carne de boi cozida com batata, macarrão, farofa, arroz e feijão, acompanhada de salada', 21.90, 'boi.jpg'),
(12, 'Feijoada', 'Feijoada com farofa, arroz acompanhada de torresmo e salada de couve', 24.90, 'feijoada.jpg'),
(13, 'Lasanha', 'Lasanha, arroz e feijão, acompanhados de salada de alface', 25.90, 'lasanha.jpg'),
(14, 'Frango frito', 'Asinhas de frango fritas, arroz, feijão e farofa acompanhadas de salada de tomate', 23.90, 'frito.jpg');

--
-- Acionadores `marmita`
--
DELIMITER $$
CREATE TRIGGER `marmita_preco_positivo_insert` BEFORE INSERT ON `marmita` FOR EACH ROW BEGIN
    SET NEW.nr_preco = ABS(NEW.nr_preco);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `marmita_preco_positivo_update` BEFORE UPDATE ON `marmita` FOR EACH ROW BEGIN
    SET NEW.nr_preco = ABS(NEW.nr_preco);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_marmita` bigint(20) NOT NULL,
  `nr_qnt` int(11) NOT NULL,
  `nm_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_marmita`, `nr_qnt`, `nm_cliente`) VALUES
(4, 8, 2, 'Brendha Eduarda da Silva Barbosa'),
(5, 9, 10, 'Matheus Antonio Milam Luiz'),
(6, 10, 50, 'Matheus Lopes');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_ranking_clientes`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_ranking_clientes` (
`nm_cliente` varchar(100)
,`total_gasto` decimal(37,2)
,`qtd_pedidos` bigint(21)
,`posicao_ranking` bigint(21)
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_ranking_clientes`
--
DROP TABLE IF EXISTS `vw_ranking_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ranking_clientes`  AS WITH valor_por_pedido AS (SELECT `p`.`id_pedido` AS `id_pedido`, `p`.`nm_cliente` AS `nm_cliente`, `m`.`nr_preco`* `p`.`nr_qnt` AS `valor_total` FROM (`pedido` `p` join `marmita` `m` on(`m`.`id_marmita` = `p`.`id_marmita`))), gasto_por_cliente AS (SELECT `valor_por_pedido`.`nm_cliente` AS `nm_cliente`, sum(`valor_por_pedido`.`valor_total`) AS `total_gasto`, count(0) AS `qtd_pedidos` FROM `valor_por_pedido` GROUP BY `valor_por_pedido`.`nm_cliente`) SELECT `gasto_por_cliente`.`nm_cliente` AS `nm_cliente`, `gasto_por_cliente`.`total_gasto` AS `total_gasto`, `gasto_por_cliente`.`qtd_pedidos` AS `qtd_pedidos`, rank() over ( order by `gasto_por_cliente`.`total_gasto` desc) AS `posicao_ranking` FROM `gasto_por_cliente``gasto_por_cliente`  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id_bairro`);

--
-- Índices de tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Índices de tabela `diasemana`
--
ALTER TABLE `diasemana`
  ADD PRIMARY KEY (`id_dia`);

--
-- Índices de tabela `dia_marmita`
--
ALTER TABLE `dia_marmita`
  ADD PRIMARY KEY (`id_marmita`,`id_dia`),
  ADD KEY `id_dia` (`id_dia`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `fk_funcionario_cargo` (`id_cargo`);

--
-- Índices de tabela `marmita`
--
ALTER TABLE `marmita`
  ADD PRIMARY KEY (`id_marmita`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_marmita` (`id_marmita`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id_bairro` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `diasemana`
--
ALTER TABLE `diasemana`
  MODIFY `id_dia` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `marmita`
--
ALTER TABLE `marmita`
  MODIFY `id_marmita` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dia_marmita`
--
ALTER TABLE `dia_marmita`
  ADD CONSTRAINT `dia_marmita_ibfk_1` FOREIGN KEY (`id_marmita`) REFERENCES `marmita` (`id_marmita`),
  ADD CONSTRAINT `dia_marmita_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `diasemana` (`id_dia`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_marmita` FOREIGN KEY (`id_marmita`) REFERENCES `marmita` (`id_marmita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
