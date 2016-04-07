-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Abr-2016 às 11:55
-- Versão do servidor: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slave_db_teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_stock_product` int(11) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `id_stock_product_idx` (`id_stock_product`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`id_stock`, `id_stock_product`, `unit_price`, `amount`) VALUES
(43, 30, '0.00', '6'),
(46, 98, '0.00', '-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock_input`
--

DROP TABLE IF EXISTS `stock_input`;
CREATE TABLE IF NOT EXISTS `stock_input` (
  `id_stock` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_stock_product` bigint(20) NOT NULL,
  `input_amount` int(11) NOT NULL,
  `input_date` date NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `input_type` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `stock_input`
--

INSERT INTO `stock_input` (`id_stock`, `id_stock_product`, `input_amount`, `input_date`, `unit_price`, `input_type`) VALUES
(10, 30, 10, '2016-04-06', '3.00', 1),
(11, 30, 12, '2016-04-06', '1.00', 1),
(12, 30, 12, '2016-04-06', '1.00', 1),
(13, 31, 12, '2016-04-06', '123.00', 1),
(14, 30, 6, '2016-04-06', '3.00', 2),
(15, 98, 123, '2016-04-06', '123.00', 1),
(16, 98, 23, '2016-04-06', '123.00', 2),
(17, 98, 3, '2016-04-06', '123.00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock_output`
--

DROP TABLE IF EXISTS `stock_output`;
CREATE TABLE IF NOT EXISTS `stock_output` (
  `id_stock` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_stock_product` bigint(20) NOT NULL,
  `output_date` date NOT NULL,
  `output_amount` int(11) NOT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `stock_output`
--

INSERT INTO `stock_output` (`id_stock`, `id_stock_product`, `output_date`, `output_amount`, `unit_price`) VALUES
(3, 98, '2016-04-06', 2, '1.00'),
(4, 98, '2016-04-06', 23, '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock_products`
--

DROP TABLE IF EXISTS `stock_products`;
CREATE TABLE IF NOT EXISTS `stock_products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name_product` varchar(250) NOT NULL,
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `stock_products`
--

INSERT INTO `stock_products` (`id_product`, `name_product`, `id_group`) VALUES
(30, 'Leite', 53),
(31, 'cafe', 53),
(32, 'Sabonete', 52),
(34, 'Arroz', 53),
(35, 'Feijao', 53),
(36, 'fraldas', 56),
(98, '123', 53);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock_product_groups`
--

DROP TABLE IF EXISTS `stock_product_groups`;
CREATE TABLE IF NOT EXISTS `stock_product_groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(250) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `stock_product_groups`
--

INSERT INTO `stock_product_groups` (`id_group`, `name_group`) VALUES
(52, 'Higiene'),
(53, 'Alimenticios'),
(54, 'Roupas');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
