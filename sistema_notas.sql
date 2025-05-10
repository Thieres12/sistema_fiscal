-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/05/2025 às 21:46
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
-- Banco de dados: `sistema_notas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `ie` varchar(20) DEFAULT NULL,
  `endereco` text NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cnpj`, `ie`, `endereco`, `telefone`) VALUES
(1, 'Logistica Varejjo', '12312312332', '12312312313', 'Rua testo landia', '986060591'),
(2, 'Frios Itapira', '61282709282', '092999', 'Disney Landia', '19282828282');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa_perfil`
--

CREATE TABLE `empresa_perfil` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `ie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresa_perfil`
--

INSERT INTO `empresa_perfil` (`id`, `nome`, `cnpj`, `ie`) VALUES
(1, 'Tech LTDA', '19919919982', '202020');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notas`
--

INSERT INTO `notas` (`id`, `cliente_id`, `data`) VALUES
(1, 1, '2025-02-08'),
(2, 2, '2025-06-09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_nota`
--

CREATE TABLE `produtos_nota` (
  `id` int(11) NOT NULL,
  `nota_id` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `emb` varchar(20) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos_nota`
--

INSERT INTO `produtos_nota` (`id`, `nota_id`, `descricao`, `emb`, `quantidade`, `valor_unitario`) VALUES
(1, 1, 'Teclado', 'sadasdasd', 4, 20.00),
(2, 1, 'Mouse', '133123', 1, 10.00),
(3, 1, 'Fone', '12312313', 1, 10.00),
(4, 2, 'Carregador', '123123', 1, 12.00);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `empresa_perfil`
--
ALTER TABLE `empresa_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `produtos_nota`
--
ALTER TABLE `produtos_nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_id` (`nota_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `empresa_perfil`
--
ALTER TABLE `empresa_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produtos_nota`
--
ALTER TABLE `produtos_nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Restrições para tabelas `produtos_nota`
--
ALTER TABLE `produtos_nota`
  ADD CONSTRAINT `produtos_nota_ibfk_1` FOREIGN KEY (`nota_id`) REFERENCES `notas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
