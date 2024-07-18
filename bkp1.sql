-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/07/2024 às 05:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projatendimentos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimento`
--

CREATE TABLE `atendimento` (
  `idAtendimento` int(11) NOT NULL,
  `idFormaAtendimento` int(11) NOT NULL,
  `idPerguntaPublico` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` enum('S','N') NOT NULL,
  `respostaAtendimento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `idCadastro` int(11) NOT NULL,
  `nomeCadastro` varchar(255) NOT NULL,
  `telefoneCadastro` varchar(45) DEFAULT NULL,
  `emailCadastro` varchar(255) NOT NULL,
  `cpfCadastro` char(11) DEFAULT NULL,
  `cnpjCadastro` varchar(30) DEFAULT NULL,
  `tipoCadastro` int(1) NOT NULL,
  `perfilCadastro` int(1) NOT NULL,
  `descricao` text DEFAULT NULL,
  `idUsuario` int(1) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `idPerguntaPublico` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `formaatendimento`
--

CREATE TABLE `formaatendimento` (
  `idFormaAtendimento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nomeAtendimento` varchar(255) DEFAULT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE `perfil` (
  `idPerfil` int(11) NOT NULL,
  `nomePeril` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfilsessao`
--

CREATE TABLE `perfilsessao` (
  `idPerfil` int(11) NOT NULL,
  `idSessao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntapublico`
--

CREATE TABLE `perguntapublico` (
  `idPerguntaPublico` int(11) NOT NULL,
  `descricaoPergunta` text NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `perguntapublico`
--

INSERT INTO `perguntapublico` (`idPerguntaPublico`, `descricaoPergunta`, `dataCadastro`) VALUES
(1, 'Carteira de Trabalho, SD, Vagas', '2024-07-09 00:48:06'),
(2, 'Programa Gaúcho do Artesanato', '2024-07-09 00:48:06'),
(3, 'Vida Centro Humanístico', '2024-07-09 00:48:06'),
(4, 'Orientação sobre Empreendedorismo', '2024-07-09 00:48:06'),
(5, 'Orientação sobre Cursos de Qualificação', '2024-07-09 00:48:06'),
(6, 'Orientação sobre Mercado de Trabalho', '2024-07-09 00:48:06'),
(7, 'Outra', '2024-07-09 00:48:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `publico`
--

CREATE TABLE `publico` (
  `idPublico` int(11) NOT NULL,
  `nomePublico` varchar(255) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `publico`
--

INSERT INTO `publico` (`idPublico`, `nomePublico`, `ativo`) VALUES
(1, 'empregador', 'S'),
(2, 'trabalhador', 'S'),
(3, 'outras agencias', 'S'),
(4, 'ads', 'S'),
(5, 'setores da fgtas', 'S'),
(6, 'Outros', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessao`
--

CREATE TABLE `sessao` (
  `idSessao` int(11) NOT NULL,
  `nomeSessao` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoatendimento`
--

CREATE TABLE `tipoatendimento` (
  `idTipoAtendimento` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipoatendimento`
--

INSERT INTO `tipoatendimento` (`idTipoAtendimento`, `descricao`) VALUES
(1, 'whatsapp'),
(2, 'telefone'),
(3, 'email'),
(4, 'presencial'),
(5, 'teams'),
(6, 'redesocial'),
(7, 'Outros');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(255) NOT NULL,
  `emailUsuario` varchar(255) NOT NULL,
  `loginUsuario` varchar(255) NOT NULL,
  `senhaUsuario` varchar(255) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `telefoneCelular` varchar(45) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `loginUsuario`, `senhaUsuario`, `dataCadastro`, `telefoneCelular`, `ativo`) VALUES
(3, '', '', 'guilherme', '$2y$10$nF37//I3ngJiHSuSugoraOpUHR1dh9GehBCBA2R05slNgG8aU1r/S', '2024-07-09 16:10:46', '', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atendimento`
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`idAtendimento`),
  ADD KEY `idFormaAtendimento` (`idFormaAtendimento`),
  ADD KEY `idPerguntaPublico` (`idPerguntaPublico`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`idCadastro`),
  ADD KEY `cadastro_ibfk_2` (`perfilCadastro`),
  ADD KEY `cadastro_ibfk_1` (`tipoCadastro`),
  ADD KEY `idusuario_ibfk_3` (`idUsuario`),
  ADD KEY `fk_idPerguntaPublico` (`idPerguntaPublico`);

--
-- Índices de tabela `formaatendimento`
--
ALTER TABLE `formaatendimento`
  ADD PRIMARY KEY (`idFormaAtendimento`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idPerfil`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Índices de tabela `perfilsessao`
--
ALTER TABLE `perfilsessao`
  ADD KEY `idPerfil` (`idPerfil`),
  ADD KEY `idSessao` (`idSessao`);

--
-- Índices de tabela `perguntapublico`
--
ALTER TABLE `perguntapublico`
  ADD PRIMARY KEY (`idPerguntaPublico`);

--
-- Índices de tabela `publico`
--
ALTER TABLE `publico`
  ADD PRIMARY KEY (`idPublico`);

--
-- Índices de tabela `sessao`
--
ALTER TABLE `sessao`
  ADD PRIMARY KEY (`idSessao`);

--
-- Índices de tabela `tipoatendimento`
--
ALTER TABLE `tipoatendimento`
  ADD PRIMARY KEY (`idTipoAtendimento`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `idAtendimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `idCadastro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `formaatendimento`
--
ALTER TABLE `formaatendimento`
  MODIFY `idFormaAtendimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perguntapublico`
--
ALTER TABLE `perguntapublico`
  MODIFY `idPerguntaPublico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `publico`
--
ALTER TABLE `publico`
  MODIFY `idPublico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `sessao`
--
ALTER TABLE `sessao`
  MODIFY `idSessao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipoatendimento`
--
ALTER TABLE `tipoatendimento`
  MODIFY `idTipoAtendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atendimento`
--
ALTER TABLE `atendimento`
  ADD CONSTRAINT `atendimento_ibfk_1` FOREIGN KEY (`idFormaAtendimento`) REFERENCES `formaatendimento` (`idFormaAtendimento`),
  ADD CONSTRAINT `atendimento_ibfk_2` FOREIGN KEY (`idPerguntaPublico`) REFERENCES `perguntapublico` (`idPerguntaPublico`),
  ADD CONSTRAINT `atendimento_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `cadastro_ibfk_1` FOREIGN KEY (`tipoCadastro`) REFERENCES `tipoatendimento` (`idTipoAtendimento`),
  ADD CONSTRAINT `cadastro_ibfk_2` FOREIGN KEY (`perfilCadastro`) REFERENCES `publico` (`idPublico`),
  ADD CONSTRAINT `fk_idPerguntaPublico` FOREIGN KEY (`idPerguntaPublico`) REFERENCES `perguntapublico` (`idPerguntaPublico`),
  ADD CONSTRAINT `idusuario_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `formaatendimento`
--
ALTER TABLE `formaatendimento`
  ADD CONSTRAINT `formaatendimento_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Restrições para tabelas `perfilsessao`
--
ALTER TABLE `perfilsessao`
  ADD CONSTRAINT `perfilsessao_ibfk_1` FOREIGN KEY (`idPerfil`) REFERENCES `perfil` (`idPerfil`),
  ADD CONSTRAINT `perfilsessao_ibfk_2` FOREIGN KEY (`idSessao`) REFERENCES `sessao` (`idSessao`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
