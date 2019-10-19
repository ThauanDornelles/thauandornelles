-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Jul-2019 às 14:42
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(21) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(3, 'Categoria 1'),
(4, 'Categoria 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `membros`
--

CREATE TABLE `membros` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(21) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `membros`
--

INSERT INTO `membros` (`id`, `pseudo`, `email`, `mdp`) VALUES
(4, 'pajezao', 'matheus.2017316580@gmail.com', '12345678'),
(5, 'moderador', 'moderador@gmail.com', '12345678'),
(6, 'teste56', 'matheus.@gmail.com', '12345678'),
(7, 'mamamu', '1ejQUQ@GMAIL.COM', '12345678');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posttopico`
--

CREATE TABLE `posttopico` (
  `id` int(11) NOT NULL,
  `propriedades` int(11) NOT NULL,
  `conteudo` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `topico` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `posttopico`
--

INSERT INTO `posttopico` (`id`, `propriedades`, `conteudo`, `date`, `topico`) VALUES
(1, 5, 'este serve pra testar samerda', '2019-07-14 18:04:26', 'testando123'),
(2, 5, 'khkhkhkhkhkkhkh', '2019-07-14 18:06:33', 'teste2'),
(3, 4, 'olÃ¡', '2019-07-14 18:45:29', 'teste2'),
(4, 4, 'tudo bom\r\n', '2019-07-14 18:45:36', 'teste2'),
(5, 4, 'kkkkk', '2019-07-14 18:46:29', 'teste2'),
(6, 5, 'oi', '2019-07-14 18:46:43', 'teste2'),
(7, 4, 'kkkkk', '2019-07-14 18:49:19', 'teste2'),
(8, 4, 'testei agora', '2019-07-14 19:01:35', 'teste4'),
(9, 4, 'nÃ©', '2019-07-14 19:03:41', 'testando123'),
(10, 4, 'kakakaka', '2019-07-18 17:36:08', 'thauan lindo'),
(11, 4, 'uguyg', '2019-07-18 17:36:17', 'thauan lindo'),
(12, 7, 'ijj', '2019-07-18 17:37:33', 'thauan lindo'),
(13, 7, 'ddddddddd', '2019-07-18 17:37:38', 'thauan lindo'),
(14, 7, 'dddddddddddd', '2019-07-18 17:37:41', 'thauan lindo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `topico`
--

CREATE TABLE `topico` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` varchar(21) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `topico`
--

INSERT INTO `topico` (`id`, `nome`, `categoria`) VALUES
(1, 'thauan lindo', 'Categoria 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membros`
--
ALTER TABLE `membros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posttopico`
--
ALTER TABLE `posttopico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topico`
--
ALTER TABLE `topico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membros`
--
ALTER TABLE `membros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posttopico`
--
ALTER TABLE `posttopico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `topico`
--
ALTER TABLE `topico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
