CREATE DATABASE IF NOT EXISTS sistema_crud;
USE sistema_crud;

CREATE TABLE IF NOT EXISTS usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS clientes;

-- 2. Cria a tabela nova com a coluna do usuário e as colunas do carro juntas
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    carro_marca VARCHAR(50) NOT NULL,
    carro_modelo VARCHAR(50) NOT NULL,
    carro_placa VARCHAR(10) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Cria o relacionamento direto sem dar erro
    CONSTRAINT fk_usuario_cliente 
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) 
    ON DELETE CASCADE
);

ALTER TABLE clientes ADD COLUMN usuario_id INT NOT NULL AFTER id;

ALTER TABLE clientes ADD CONSTRAINT fk_usuario_cliente
FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE;



UPDATE clientes SET usuario_id = 1 WHERE usuario_id = 0;


ALTER TABLE clientes ADD CONSTRAINT fk_usuario_cliente FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE; 



select * from usuarios;
select * from clientes;

INSERT INTO usuarios (nome, email, senha) VALUES 
('Administrador', 'admin@teste.com', MD5('123456'))
ON DUPLICATE KEY UPDATE id=id;