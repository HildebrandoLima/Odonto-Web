-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Ago-2020 às 11:54
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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`consulta_id`, `consultorio`, `nome`, `data_marcada`, `modalidade`, `valor_servico`) VALUES
(21, 'Consultorio', 'Teste', '2020-08-04 00:00:00', 'ManutenÃ§Ã£o', '70,00'),
(32, 'Dra Natecia Alves', 'Natalia', '2020-08-28 00:00:00', 'Extrair Dente', '70,00'),
(30, 'Dra Natecia Alves', 'Natecia', '2020-08-15 00:00:00', 'ManutenÃ§Ã£o', '70,00'),
(31, 'Dra Natecia Alves', 'Francilene', '2020-08-15 00:00:00', 'ManutenÃ§Ã£o', '70,00'),
(33, 'Dra Natecia Alves', 'Francilene', '2020-09-15 00:00:00', 'Extrair Dente', '180,00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
