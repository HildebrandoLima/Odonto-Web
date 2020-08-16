-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Ago-2020 às 16:26
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `consultorio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `consulta_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultorio` varchar(50) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `data_marcada` datetime DEFAULT NULL,
  `modalidade` varchar(100) DEFAULT NULL,
  `valor_servico` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`consulta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`consulta_id`, `consultorio`, `nome`, `data_marcada`, `modalidade`, `valor_servico`) VALUES
(21, 'Consultorio', 'Teste', '2020-08-04 00:00:00', 'ManutenÃ§Ã£o', '70,00'),
(32, 'Dra Natecia Alves', 'Natalia', '2020-08-28 00:00:00', 'Extrair Dente', '70,00'),
(30, 'Dra Natecia Alves', 'Natecia', '2020-08-15 00:00:00', 'ManutenÃ§Ã£o', '70,00'),
(31, 'Dra Natecia Alves', 'Francilene', '2020-08-15 00:00:00', 'ManutenÃ§Ã£o', '70,00'),
(33, 'Dra Natecia Alves', 'Francilene', '2020-09-15 00:00:00', 'Extrair Dente', '180,00'),
(34, 'Dra Natecia Alves', 'Natecia', '2020-09-25 00:00:00', 'ManutenÃ§Ã£o do Aprelho', '70,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `custos_diretos`
--

DROP TABLE IF EXISTS `custos_diretos`;
CREATE TABLE IF NOT EXISTS `custos_diretos` (
  `custo_direto_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultorio` varchar(50) DEFAULT NULL,
  `equipamento` varchar(50) DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `valor_custo_direto` varchar(10) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`custo_direto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `custos_diretos`
--

INSERT INTO `custos_diretos` (`custo_direto_id`, `consultorio`, `equipamento`, `quantidade`, `valor_custo_direto`, `data_registro`) VALUES
(1, 'Dra Natecia Alves', 'Aparelho', 5, '65,00', '2020-07-09 12:36:45'),
(2, 'Dra Natecia Alves', 'MÃ¡scara1', 2, '2,00', '2020-07-14 16:06:16'),
(3, 'Dra Natecia Alves', 'MÃ¡scara2', 3, '2,00', '2020-07-14 16:13:15'),
(5, 'Dra Natecia Alves', 'Teste', 2, '33,00', '2020-07-14 16:54:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `custos_fixos`
--

DROP TABLE IF EXISTS `custos_fixos`;
CREATE TABLE IF NOT EXISTS `custos_fixos` (
  `custo_fixo_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultorio` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `valor_custo_fixo` varchar(10) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`custo_fixo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `custos_fixos`
--

INSERT INTO `custos_fixos` (`custo_fixo_id`, `consultorio`, `categoria`, `valor_custo_fixo`, `data_registro`) VALUES
(1, 'Dra Natecia Alves', 'Aluguel', '700,00', '2020-07-14 16:05:20'),
(2, 'Dra Natecia Alves', 'Ãgua', '75,00', '2020-07-12 11:30:42'),
(5, 'Dra Natecia Alves', 'Energia', '70,00', '2020-07-14 17:14:20'),
(6, 'Dra Natecia Alves', 'FuncionÃ¡riox', '1045,00', '2020-07-14 17:16:39'),
(7, 'Dra Natecia Alves', 'FuncionÃ¡rioy', '1045,00', '2020-07-14 17:17:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `demonstracao_lucro`
--

DROP TABLE IF EXISTS `demonstracao_lucro`;
CREATE TABLE IF NOT EXISTS `demonstracao_lucro` (
  `demonstracao_lucro_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultorio` varchar(50) DEFAULT NULL,
  `total_custos_fixos` varchar(10) DEFAULT NULL,
  `total_custos_diretos` varchar(10) DEFAULT NULL,
  `total_valor_consultas` varchar(10) DEFAULT NULL,
  `demonstracao_lucro` varchar(10) DEFAULT NULL,
  `data_entrada` datetime DEFAULT NULL,
  PRIMARY KEY (`demonstracao_lucro_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `demonstracao_lucro`
--

INSERT INTO `demonstracao_lucro` (`demonstracao_lucro_id`, `consultorio`, `total_custos_fixos`, `total_custos_diretos`, `total_valor_consultas`, `demonstracao_lucro`, `data_entrada`) VALUES
(1, 'Dra Natecia Alves', '2935,00', '401,00', '280,00', NULL, '2020-10-17 00:00:00'),
(2, 'Dra Natecia Alves', '2.935,00', '401,00', '280,00', NULL, '2020-07-17 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidades`
--

DROP TABLE IF EXISTS `modalidades`;
CREATE TABLE IF NOT EXISTS `modalidades` (
  `modalidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultorio` varchar(50) DEFAULT NULL,
  `modalidade` varchar(50) DEFAULT NULL,
  `valor_modalidade` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`modalidade_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modalidades`
--

INSERT INTO `modalidades` (`modalidade_id`, `consultorio`, `modalidade`, `valor_modalidade`) VALUES
(1, 'Dra Natecia Alves', 'ManutenÃ§Ã£o do Aprelho', '70,00'),
(2, 'Dra Natecia Alves', 'Extrair Dente', '180,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis_acessos`
--

DROP TABLE IF EXISTS `niveis_acessos`;
CREATE TABLE IF NOT EXISTS `niveis_acessos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `niveis_acessos`
--

INSERT INTO `niveis_acessos` (`id`, `nome`, `created`, `modified`) VALUES
(1, 'Administrador', '2016-02-19 00:00:00', NULL),
(2, 'Financeiro', '2016-02-19 00:00:00', NULL),
(3, 'Consultorio', '2016-02-19 00:00:00', NULL),
(4, 'Colaborador', '2020-07-03 00:00:00', NULL),
(5, 'Cliente', '2020-07-18 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `consultorio` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `data_marcada` datetime DEFAULT NULL,
  `modalidade` varchar(50) DEFAULT NULL,
  `pagamento` varchar(10) DEFAULT NULL,
  `parcelas` int(10) DEFAULT NULL,
  `valor_servico` varchar(8) DEFAULT NULL,
  `entrada` varchar(1) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`status_id`, `consultorio`, `nome`, `data_marcada`, `modalidade`, `pagamento`, `parcelas`, `valor_servico`, `entrada`, `status`) VALUES
(13, 'Dra Natecia Alves', 'Francilene', '2020-08-07 00:00:00', 'Extrair Dente', 'Dinheiro', 0, '180,00', 'N', 'Presente'),
(14, 'Dra Natecia Alves', 'Natalia', '2020-08-07 00:00:00', 'Manu', 'CartÃ£o', 0, '70,00', 'S', 'Presente'),
(15, 'Dra Natecia Alves', 'Natecia', '2020-08-13 00:00:00', 'Manu', 'Nullo', 0, '00,00', 'N', 'Ausente'),
(16, 'Dra Natecia Alves', 'Teste', '2020-08-26 00:00:00', 'Extrair Dente', 'CartÃ£o', 2, '180,00', 'S', 'Presente'),
(17, 'Dra Natecia Alves', 'Teste3', '2020-08-15 00:00:00', 'Manu', 'Dinheiro', 0, '70,00', 'N', 'Presente'),
(18, 'Dra Natecia Alves', 'Francilene', '2020-09-15 00:00:00', 'Extrair Dente', 'Dinheiro', 0, '180,00', 'N', 'Presente'),
(20, 'Dra Natecia Alves', 'Natecia', '2020-09-25 00:00:00', 'ManutenÃ§Ã£o do Aprelho', 'Dinheiro', 0, '70,00', 'N', 'Presente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `consultorio` varchar(50) DEFAULT NULL,
  `inicio_plano` date DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `situacoe_id` int(11) NOT NULL DEFAULT 0,
  `niveis_acesso_id` int(11) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `num` varchar(5) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `status_vencimento` varchar(1) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nome`, `senha`, `consultorio`, `inicio_plano`, `data_nascimento`, `telefone`, `situacoe_id`, `niveis_acesso_id`, `endereco`, `num`, `bairro`, `status_vencimento`, `codigo`, `data_registro`) VALUES
(22, 'Dell', '872871bf2e3457e85d87aa1639d09bf1', 'Dell', '2020-07-03', '2020-07-03', '558591069314', 1, 1, 'Teste', '000', 'Messejana', 'N', 'dd2299fa2599853d216100e1b59c7798', '2020-07-03 12:48:31'),
(23, 'Dra Natecia Alves', '872871bf2e3457e85d87aa1639d09bf1', 'Dra Natecia Alves', '2020-07-03', '2020-07-03', '111111111111', 1, 2, 'Teste', '000', 'Messejana', 'N', '1656ba33fa21ff304ed8a583cee7c9cd', '2020-07-03 12:48:31'),
(24, 'Dra NatÃ¡lia Alves', 'a6dc21f53ce8d4b37d748bb0ce51199d', 'Dra NatÃ¡lia Alves', '2020-07-03', '2020-06-03', '558591069314', 1, 3, 'Rua: Cabo Eduardo', '555', 'Centro', 'N', '632154a1e3bbb4668340b7c5d434095d', '2020-07-03 16:04:06'),
(29, 'Natecia', NULL, 'Dra Natecia Alves', '2020-07-15', '2020-07-15', '111111111111', 1, 5, 'Teste', '000', 'Centro', 'N', '0b67132714006843f87354b2b54de366', '2020-07-15 11:04:57'),
(27, 'Francilene', NULL, 'Dra Natecia Alves', '2020-07-06', '2020-07-06', '111111111111', 1, 5, 'Teste', '000', 'Teste', 'N', '9ed0a47ecddfbd5d44d4a46f3855c609', '2020-07-06 18:13:24'),
(28, 'Natalia', '872871bf2e3457e85d87aa1639d09bf1', 'Dra Natecia Alves', '2020-07-06', '2020-07-06', '111111111111', 1, 5, 'Teste', '000', 'Teste', 'N', 'b900a4ef276abb33e98895c341c1aaa5', '2020-07-06 18:22:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
