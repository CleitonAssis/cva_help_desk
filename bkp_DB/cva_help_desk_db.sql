-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 30-Set-2022 às 14:16
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cva_help_desk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

DROP TABLE IF EXISTS `chamados`;
CREATE TABLE IF NOT EXISTS `chamados` (
  `chamado_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `chamado_perfil_id` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setor` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `status` text COLLATE utf8mb4_unicode_ci,
  `img_upload` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_cad` datetime NOT NULL,
  `data_mod` datetime DEFAULT NULL,
  PRIMARY KEY (`chamado_id`),
  KEY `chamado_perfil_id` (`chamado_perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `chamados`
--

INSERT INTO `chamados` (`chamado_id`, `chamado_perfil_id`, `categoria`, `setor`, `endereco`, `nome`, `email`, `telefone`, `descricao`, `ativo`, `status`, `img_upload`, `data_cad`, `data_mod`) VALUES
(00103, 3, 'CRIAÃ‡ÃƒO DE USUÃRIO', 'SAÃšDE', 'PSF 08', 'Maria Rita', 'user@teste.com.br', '(55) 55555-5555', 'CRIE UM USUÃRIO PRA MIM', 'S', NULL, NULL, '2022-01-06 08:50:56', NULL),
(00104, 3, 'CRIAÃ‡ÃƒO DE USUÃRIO', 'SAÃšDE', 'PSF 08', 'Maria Rita', 'user@teste.com.br', '(88) 88888-8888', 'EU QUERO UM USER TBM', 'N', NULL, NULL, '2022-01-06 09:38:34', NULL),
(00105, 3, 'CRIAÃ‡ÃƒO DE USUÃRIO', 'SAÃšDE', 'PSF 08', 'Maria Rita', 'user@teste.com.br', '(33) 33333-3333', 'OPA TBM QUERO USER', 'S', NULL, NULL, '2022-01-06 09:41:51', NULL),
(00106, 3, 'COMPUTADOR/NOTEBOOK', 'SAÃšDE', 'PSF 08', 'Maria Rita', 'user@teste.com.br', '(11) 11111-1111', 'MEU PC NÃƒO LIGA', 'S', NULL, 'Maria Rita_ac3d9b46b2560a6f9eb4f44126c6c825.jpg', '2022-01-06 09:47:57', NULL),
(00107, 2, 'OUTRO', 'EDUCAÃ‡ÃƒO', 'ESCOLA HILDA MORAIS', 'Italo de Oliveira', 'tecnico@teste.com.br', '(44) 44444-4444', 'PC MUITO LENTO', 'S', NULL, 'Italo de Oliveira_bb6b0bbe4ca466ac3566e1bb029b338e.jpg', '2022-01-06 10:12:04', NULL),
(00108, 2, 'OUTRO', 'EDUCAÃ‡ÃƒO', 'ESCOLA HILDA MORAIS', 'Italo de Oliveira', 'tecnico@teste.com.br', '(66) 66666-6666', 'ESTAMOS SEM INTERNET', 'S', NULL, NULL, '2022-01-06 10:14:04', NULL),
(00109, 1, 'OUTRO', 'OUTRO', 'SEM ENDEREÃ‡O', 'Administrador', 'adm@teste.com.br', '(00) 00000-0000', 'ISSO Ã‰ APENAS UM TESTE', 'S', NULL, 'Administrador_6a995c0f70b9d6b0a89ccad10533ebb3.jpg', '2022-01-06 10:22:00', NULL),
(00110, 3, 'IMPRESSORA', 'SAÃšDE', 'PSF 08', 'Maria Rita', 'user@teste.com.br', '(44) 44444-4444', 'MINHA IMPRESSORA TÃ FAZENDO MUITO BARULHO AO IMPRIMIR', 'S', NULL, 'Maria Rita_8262bd2515b5d0f009190f83e49f314f.jpg', '2022-01-06 10:31:19', NULL),
(00111, 3, 'INSTALAÃ‡ÃƒO DE CÃ‚MERA', 'PONTO DE APOIO ESPERANÃ‡A', 'ESPERANÃ‡A', 'Maria Rita', 'user@teste.com.br', '(44) 44444-4444', 'ESTAMOS PRECISANDO URGENTEMENTE DE CÃ‚MERAS AQUI NO PONTO DE APOIO', 'S', NULL, NULL, '2022-01-07 09:13:06', NULL),
(00112, 3, '', '', 'RUA AMAZONAS 198 NOVO ORIENTE', 'Renato souza', 'renato@teste.com.br', '(31) 99696-6666', 'IMPRESSORA COM BARULHO ESTRANHO AO IMPRIMIR', 'S', NULL, NULL, '2022-09-20 18:31:27', '2022-09-23 09:51:00'),
(00113, 3, 'INSTALAÃ‡ÃƒO DE CÃ‚MERA', '', 'RUA PRIMEIRO DE MARÃ‡O,199,CENTRO', 'Renato souza', 'renato@teste.com.br', '(45) 45464-5645', 'SOLICITO A INSTALAÃ‡ÃƒO DE CAMERAS DE SEGURANÃ‡A NESTE SETOR.\r\nGRATO', 'S', NULL, NULL, '2022-09-20 18:35:58', NULL),
(00114, 3, '', '', 'PSF 05', 'Renato souza', 'renato@teste.com.br', '(31) 99693-4187', 'PC LIGA PORÃ‰M FICA REINICIANDO COM FREQUÃŠNCIA.\r\nOBS: NECESSITAMOS DELE PARA RATIVIDADESEALIZAR AS ATIVIDADES DIÃRIAS.', 'S', NULL, 'Renato souza_b28875cf02e6620c5828480ae5760577.png', '2022-09-23 09:10:24', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login_nome` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_senha` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_perfil_id` int(10) UNSIGNED NOT NULL,
  `login_data_cad` datetime NOT NULL,
  `login_data_mod` datetime DEFAULT NULL,
  PRIMARY KEY (`login_id`),
  KEY `fk_login_perfis` (`login_perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`login_id`, `login_nome`, `login_email`, `login_senha`, `login_perfil_id`, `login_data_cad`, `login_data_mod`) VALUES
(1, 'Administrador', 'adm@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2021-12-02 00:00:00', NULL),
(2, 'Maria Rita', 'user@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', 3, '2021-12-16 00:00:00', NULL),
(3, 'Italo de Oliveira', 'tecnico@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', 2, '2021-12-19 00:00:00', NULL),
(4, 'Renato souza', 'renato@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', 3, '2022-09-20 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE IF NOT EXISTS `perfis` (
  `perfil_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perfil` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `perfil_data_cad` datetime NOT NULL,
  `perfil_data_mod` datetime DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`perfil_id`, `perfil`, `ativo`, `perfil_data_cad`, `perfil_data_mod`) VALUES
(1, 'Administrador', 'S', '2021-12-16 14:23:22', NULL),
(2, 'Técnico', 'S', '2021-12-16 14:25:39', NULL),
(3, 'Usuário', 'S', '2021-12-16 14:26:22', NULL);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `chamados`
--
ALTER TABLE `chamados`
  ADD CONSTRAINT `fk_chamados_perfis` FOREIGN KEY (`chamado_perfil_id`) REFERENCES `perfis` (`perfil_id`);

--
-- Limitadores para a tabela `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_login_perfis` FOREIGN KEY (`login_perfil_id`) REFERENCES `perfis` (`perfil_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
