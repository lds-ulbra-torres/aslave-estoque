-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Abr-2016 às 02:52
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `slave_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fin_classification`
--

CREATE TABLE IF NOT EXISTS `fin_classification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `classification_type` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `peoples`
--

CREATE TABLE IF NOT EXISTS `peoples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cpf` varchar(12) DEFAULT NULL,
  `cnpj` varchar(15) DEFAULT NULL,
  `rg` varchar(13) DEFAULT NULL,
  `inscricao_estadual` varchar(10) DEFAULT NULL,
  `adress` varchar(250) NOT NULL,
  `number` varchar(15) NOT NULL,
  `neighborhood` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `date_birth` date NOT NULL,
  `phone1` varchar(13) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name_product` varchar(250) NOT NULL,
  `id_group` int(11) NOT NULL,
  `amount_stock` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `id_group`, `amount_stock`) VALUES
(23, 'Leite', 42, '0'),
(24, 'rs', 42, '0'),
(25, '321', 42, '0'),
(26, '1231', 43, '0'),
(27, '123213', 44, '0'),
(28, 'pato', 46, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_groups`
--

CREATE TABLE IF NOT EXISTS `product_groups` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(250) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Extraindo dados da tabela `product_groups`
--

INSERT INTO `product_groups` (`id_group`, `name_group`) VALUES
(42, 'rs'),
(43, 'rs'),
(44, 'rs'),
(45, 'w42'),
(46, 'rola'),
(47, 'rs'),
(48, 'Não funfa saporra?'),
(49, '3123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_stock_product` int(11) NOT NULL,
  `id_stock_group` int(11) NOT NULL,
  `input` date NOT NULL,
  `output` date NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`id_stock`, `id_stock_product`, `id_stock_group`, `input`, `output`, `price`, `amount`, `total`) VALUES
(19, 23, 0, '2016-04-07', '0000-00-00', '12', '1', '12'),
(20, 24, 0, '2016-04-02', '0000-00-00', '12', '32', '384'),
(21, 26, 0, '2016-04-15', '0000-00-00', '12', '3', '36'),
(22, 24, 0, '2016-04-07', '0000-00-00', '12', '3', '36'),
(23, 23, 0, '2016-04-07', '0000-00-00', '12', '3', '36'),
(24, 23, 0, '2016-04-05', '0000-00-00', '12', '3', '36'),
(25, 23, 0, '2016-04-08', '0000-00-00', '12', '33', '396'),
(26, 25, 0, '2016-04-23', '0000-00-00', '12', '33', '396'),
(27, 27, 0, '0000-00-00', '0000-00-00', '2', '3', '6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
