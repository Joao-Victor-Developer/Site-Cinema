-- ====================================
-- =====================================
IF DB_ID('CinemaDB') IS NULL
    CREATE DATABASE CinemaDB;
GO

USE CinemaDB;
GO


-- =====================================
IF OBJECT_ID('tb_avaliacao', 'U') IS NOT NULL DROP TABLE tb_avaliacao;
IF OBJECT_ID('tb_comentario', 'U') IS NOT NULL DROP TABLE tb_comentario;
IF OBJECT_ID('tb_filme_genero', 'U') IS NOT NULL DROP TABLE tb_filme_genero;
IF OBJECT_ID('tb_filme', 'U') IS NOT NULL DROP TABLE tb_filme;
IF OBJECT_ID('tb_genero', 'U') IS NOT NULL DROP TABLE tb_genero;
IF OBJECT_ID('tb_usuario', 'U') IS NOT NULL DROP TABLE tb_usuario;
IF OBJECT_ID('tb_conta', 'U') IS NOT NULL DROP TABLE tb_conta;
GO

-- =====================================
-- TABELAS
-- =====================================

CREATE TABLE tb_conta (
    conta_id BIGINT IDENTITY(1,1) PRIMARY KEY,
    email NVARCHAR(255) NOT NULL UNIQUE,
    senha_hash NVARCHAR(255) NOT NULL,
    criado_em DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME(),
    ultimo_login DATETIME2 NULL,
    ativo BIT NOT NULL DEFAULT 1
);

CREATE TABLE tb_usuario (
    usuario_id BIGINT IDENTITY(1,1) PRIMARY KEY,
    conta_id BIGINT NOT NULL,
    nome NVARCHAR(150),
    apelido NVARCHAR(150),
    data_nascimento DATE,
    avatar_url NVARCHAR(1000),
    bio NVARCHAR(MAX),
    criado_em DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME(),
    CONSTRAINT FK_usuario_conta FOREIGN KEY (conta_id) REFERENCES tb_conta(conta_id)
);

CREATE TABLE tb_filme (
    filme_id BIGINT IDENTITY(1,1) PRIMARY KEY,
    titulo NVARCHAR(500) NOT NULL,
    titulo_original NVARCHAR(500),
    sinopse NVARCHAR(MAX),
    duracao_min INT,
    data_lancamento DATE,
    idioma NVARCHAR(100),
    criado_em DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME()
);

CREATE TABLE tb_genero (
    genero_id SMALLINT IDENTITY(1,1) PRIMARY KEY,
    nome NVARCHAR(200) NOT NULL
);

CREATE TABLE tb_filme_genero (
    filme_id BIGINT NOT NULL,
    genero_id SMALLINT NOT NULL,
    CONSTRAINT PK_filme_genero PRIMARY KEY (filme_id, genero_id),
    CONSTRAINT FK_fg_filme FOREIGN KEY (filme_id) REFERENCES tb_filme(filme_id),
    CONSTRAINT FK_fg_genero FOREIGN KEY (genero_id) REFERENCES tb_genero(genero_id)
);

CREATE TABLE tb_comentario (
    comentario_id BIGINT IDENTITY(1,1) PRIMARY KEY,
    usuario_id BIGINT NOT NULL,
    filme_id BIGINT NOT NULL,
    texto NVARCHAR(MAX) NOT NULL,
    criado_em DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME(),
    editado_em DATETIME2 NULL,
    status SMALLINT NOT NULL DEFAULT 1,
    CONSTRAINT FK_comentario_usuario FOREIGN KEY (usuario_id) REFERENCES tb_usuario(usuario_id),
    CONSTRAINT FK_comentario_filme FOREIGN KEY (filme_id) REFERENCES tb_filme(filme_id)
);

CREATE TABLE tb_avaliacao (
    avaliacao_id BIGINT IDENTITY(1,1) PRIMARY KEY,
    usuario_id BIGINT NOT NULL,
    filme_id BIGINT NOT NULL,
    nota SMALLINT NOT NULL CHECK (nota BETWEEN 0 AND 10),
    comentario_id BIGINT NULL,
    criado_em DATETIME2 NOT NULL DEFAULT SYSUTCDATETIME(),
    CONSTRAINT FK_avaliacao_usuario FOREIGN KEY (usuario_id) REFERENCES tb_usuario(usuario_id),
    CONSTRAINT FK_avaliacao_filme FOREIGN KEY (filme_id) REFERENCES tb_filme(filme_id),
    CONSTRAINT FK_avaliacao_comentario FOREIGN KEY (comentario_id) REFERENCES tb_comentario(comentario_id)
);
GO

-- =====================================
-- DADOS DE TESTE (opcional)
-- =====================================
INSERT INTO tb_conta (email, senha_hash)
VALUES ('teste@exemplo.com', 'hash123');

INSERT INTO tb_usuario (conta_id, nome, apelido, data_nascimento)
VALUES (1, 'João Victor', 'joaov', '2000-05-15');

INSERT INTO tb_filme (titulo, titulo_original, sinopse, duracao_min, data_lancamento, idioma)
VALUES ('A Origem', 'Inception', 'Um ladrão invade sonhos para roubar segredos.', 148, '2010-07-16', 'Inglês');

INSERT INTO tb_genero (nome)
VALUES ('Ficção Científica'), ('Ação');

INSERT INTO tb_filme_genero (filme_id, genero_id)
VALUES (1, 1), (1, 2);

INSERT INTO tb_comentario (usuario_id, filme_id, texto)
VALUES (1, 1, 'Filme incrível!');

INSERT INTO tb_avaliacao (usuario_id, filme_id, nota, comentario_id)
VALUES (1, 1, 10, 1);

SELECT * FROM tb_usuario;
SELECT * FROM tb_filme;
SELECT * FROM tb_comentario;
SELECT * FROM tb_avaliacao;
GO
