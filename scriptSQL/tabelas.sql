CREATE TABLE paciente (
	codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
	sexo VARCHAR(15),
	email VARCHAR(100),
	telefone VARCHAR(10)
);

CREATE TABLE medico (
	codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
	especialidade VARCHAR(15),
	crm VARCHAR(10)
);

CREATE TABLE funcionario (
	codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
	email VARCHAR(100),
	senhahash VARCHAR(100),
	estadoCivil VARCHAR(10),
	dataNascimento DATETIME,
	funcao VARCHAR(30)
);

CREATE TABLE contato (
	codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
	email VARCHAR(100),
	telefone VARCHAR(12),
	mensagem TEXT,
	dataNascimento DATETIME,
	dataHora DATETIME
);

CREATE TABLE agendamento (
	codigo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	codigoMedico INT,
	codigoPaciente INT,
	email VARCHAR(100),
	telefone VARCHAR(12),
	mensagem TEXT,
	dataHora DATETIME,
	FOREIGN KEY (codigoMedico) REFERENCES medico(codigo),
	FOREIGN KEY (codigoPaciente) REFERENCES paciente(codigo)
);
