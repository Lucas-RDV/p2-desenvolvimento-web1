-- Criação da tabela `usuarios` se ela não existir
CREATE TABLE IF NOT EXISTS users (
    userID INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE,
    cpf VARCHAR(30) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    city VARCHAR(30) NOT NULL,
    estate VARCHAR(30) NOT NULL,
    PRIMARY KEY (userID)
);

-- Criação da tabela `veiculos` se ela não existir
CREATE TABLE IF NOT EXISTS veicles (
    VeicleID INT NOT NULL AUTO_INCREMENT,
    model VARCHAR(30) NOT NULL,
    description VARCHAR(300),
    value INT NOT NULL,
    km INT NOT NULL,
    userID INT NOT NULL,
    sold BOOLEAN NOT NULL,
    PRIMARY KEY (VeicleID),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);