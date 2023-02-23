-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 22-Fev-2023 às 20:38
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
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `nome_categoria`) VALUES
(1, 'COMPUTADOR/NOTEBOOK'),
(2, 'REDE/INTERNET'),
(3, 'IMPRESSORA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamados`
--

DROP TABLE IF EXISTS `chamados`;
CREATE TABLE IF NOT EXISTS `chamados` (
  `chamado_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `usuarios_usuario_id` int(10) UNSIGNED NOT NULL,
  `perfis_perfil_id` int(10) UNSIGNED NOT NULL,
  `setores_setor_id` int(10) UNSIGNED NOT NULL,
  `categorias_categoria_id` int(10) UNSIGNED NOT NULL,
  `endereco_chamado` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_chamado` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao_chamado` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `chamado_ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `status_chamado` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `situacao_chamado` text COLLATE utf8mb4_unicode_ci,
  `cod_img_chamado` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_cad_chamado` datetime NOT NULL,
  `data_mod_chamado` datetime DEFAULT NULL,
  PRIMARY KEY (`chamado_id`),
  KEY `fk_chamados_categorias` (`categorias_categoria_id`),
  KEY `fk_chamados_usuarios` (`usuarios_usuario_id`),
  KEY `fk_chamados_perfis` (`perfis_perfil_id`),
  KEY `fk_chamados_setores` (`setores_setor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `chamados`
--

INSERT INTO `chamados` (`chamado_id`, `usuarios_usuario_id`, `perfis_perfil_id`, `setores_setor_id`, `categorias_categoria_id`, `endereco_chamado`, `telefone_chamado`, `descricao_chamado`, `chamado_ativo`, `status_chamado`, `situacao_chamado`, `cod_img_chamado`, `data_cad_chamado`, `data_mod_chamado`) VALUES
(00001, 1, 3, 1, 1, 'PSF 05', NULL, 'PC NÃO LIGA DE FORMA ALGUMA', 'S', NULL, NULL, NULL, '2022-11-22 16:04:11', NULL),
(00002, 2, 2, 2, 3, 'ESCOLA HILDA MORAES', NULL, 'IMPRESSORA NÃO ESTÁ IMPRIMINDO', 'S', NULL, NULL, NULL, '2022-11-22 16:13:29', NULL),
(00003, 3, 3, 1, 2, 'SECRETARIA DE SAÚDE', NULL, 'ESTAMOS SEM INTERNET DESDE 16/04/2022', 'S', NULL, NULL, NULL, '2022-11-22 16:56:57', NULL),
(00004, 1, 3, 1, 3, 'PSF 05', NULL, 'NOSSA IMPRESSORA ESTÁ COM UM BARULHO ESTRANHO AO IMPRIMIR', 'S', NULL, NULL, NULL, '2022-11-22 17:50:19', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfis`
--

DROP TABLE IF EXISTS `perfis`;
CREATE TABLE IF NOT EXISTS `perfis` (
  `perfil_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_perfil` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil_ativo` enum('S','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `data_cad_perfil` datetime NOT NULL,
  `data_mod_perfil` datetime DEFAULT NULL,
  PRIMARY KEY (`perfil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `perfis`
--

INSERT INTO `perfis` (`perfil_id`, `nome_perfil`, `perfil_ativo`, `data_cad_perfil`, `data_mod_perfil`) VALUES
(1, 'SUPER USUÁRIO', 'S', '2022-11-22 15:58:14', NULL),
(2, 'TÉCNICO', 'S', '2022-11-22 15:58:14', NULL),
(3, 'USUÁRIO', 'S', '2022-11-22 15:58:14', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores`
--

DROP TABLE IF EXISTS `setores`;
CREATE TABLE IF NOT EXISTS `setores` (
  `setor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_setor` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`setor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `setores`
--

INSERT INTO `setores` (`setor_id`, `nome_setor`) VALUES
(1, 'SAÚDE'),
(2, 'EDUCAÇÃO'),
(3, 'ASSISTÊNCIA SOCIAL'),
(4, 'OBRAS'),
(5, 'MEIO AMBIENTE'),
(6, 'CULTURA,ESPORTE E LAZER'),
(7, 'AGRICULTURA'),
(8, 'ENGENHARIA'),
(9, 'POLICIA MILITAR'),
(10, 'POLICIA CIVIL'),
(11, 'SUB PREFEITURA CACH.ESCURA'),
(12, 'SUB PREFEITURA BRAÚNAS'),
(13, 'SUB PREFEITURA B.J.DO BAGRE'),
(14, 'ABRIGO MUNICIPAL'),
(15, 'CONSELHO TUTELAR'),
(16, 'CRAS'),
(17, 'CREAS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perfis_perfil_id` int(10) UNSIGNED NOT NULL,
  `setores_setor_id` int(10) UNSIGNED NOT NULL,
  `nome_usuario` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_usuario` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_usuario` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone_usuario` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_usuario` enum('ATIVO','INATIVO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ATIVO',
  `data_cad_usuario` datetime NOT NULL,
  `data_mod_usuario` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `fk_usuarios_perfis` (`perfis_perfil_id`),
  KEY `fk_usuarios_setores` (`setores_setor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `perfis_perfil_id`, `setores_setor_id`, `nome_usuario`, `email_usuario`, `senha_usuario`, `telefone_usuario`, `status_usuario`, `data_cad_usuario`, `data_mod_usuario`) VALUES
(1, 3, 1, 'MARIA RITA', 'mariarita@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'INATIVO', '2022-11-22 16:02:25', NULL),
(2, 2, 2, 'MATEUS ROCHA', 'mateusrocha@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'ATIVO', '2022-11-22 16:02:25', NULL),
(3, 3, 1, 'NILMA ANDRADE', 'nilma@teste.com.br', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'ATIVO', '2022-11-22 16:53:50', NULL);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `chamados`
--
ALTER TABLE `chamados`
  ADD CONSTRAINT `fk_chamados_categorias` FOREIGN KEY (`categorias_categoria_id`) REFERENCES `categorias` (`categoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chamados_perfis` FOREIGN KEY (`perfis_perfil_id`) REFERENCES `perfis` (`perfil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chamados_setores` FOREIGN KEY (`setores_setor_id`) REFERENCES `setores` (`setor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chamados_usuarios` FOREIGN KEY (`usuarios_usuario_id`) REFERENCES `usuarios` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_perfis` FOREIGN KEY (`perfis_perfil_id`) REFERENCES `perfis` (`perfil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_setores` FOREIGN KEY (`setores_setor_id`) REFERENCES `setores` (`setor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
