#CREATE database PEWS;

USE PEWS;

DROP TABLE IF EXISTS pews;

DROP TABLE IF EXISTS medico;

DROP TABLE IF EXISTS enfermeira;

DROP TABLE IF EXISTS paciente;

USE PEWS;
CREATE TABLE enfermeira (
    coren INT(50) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    funcao VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE medico(
    estado VARCHAR(2),
    crm INT(50) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE paciente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    responsavel VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    anos INT NOT NULL,
    meses INT NOT NULL,
    telefone VARCHAR(15),
    genero ENUM('masculino', 'feminino', 'outro', 'prefiro_nao_dizer') NOT NULL,
    data_nascimento DATE NOT NULL,
    data_entrada DATE NOT NULL,
    alergias TEXT,
    remedios TEXT,
    tipo_sanguineo ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL

);

CREATE TABLE pews (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identificador único para cada avaliação
    crm INT NOT NULL,                           -- Chave estrangeira referenciando o CRM do médico
    nome_paciente VARCHAR(255) NOT NULL,        -- Nome do paciente
    idade INT NOT NULL,                         -- Idade do paciente
    f_cardiaca INT NOT NULL,                    -- Frequência cardíaca
    f_respiratoria INT NOT NULL,                -- Frequência respiratória
    aval_neurologica INT NOT NULL,              -- Avaliação neurológica (valor 0-3)
    aval_cardiovascular INT NOT NULL,           -- Avaliação cardiovascular (valor 0-3)
    aval_respiratoria INT NOT NULL,             -- Avaliação respiratória (valor 0-3)
    nebulizacao_resgate INT NOT NULL,           -- Se nebulização de resgate foi utilizada (0 ou 2)
    intervencao VARCHAR(255) NOT NULL,          -- Descrição de intervenção
    pontuacao INT NOT NULL,                     -- Pontuação total
    FOREIGN KEY (crm) REFERENCES medico(crm)   -- Chave estrangeira referenciando a tabela 'medico'
        ON DELETE CASCADE
        ON UPDATE CASCADE
)