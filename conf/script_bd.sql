CREATE SCHEMA banco;

CREATE TABLE pessoa_fisica(
	pf_id INT auto_increment,
    pf_cpf varchar(45),
    pf_nome varchar(250),
    pf_dt_nascimento date,
    PRIMARY KEY (pf_id));

CREATE TABLE contatos(
	cont_id INT auto_increment,
    cont_tipo varchar(45),
    cont_descricao varchar(250),
    cont_pf_id INT,
    PRIMARY KEY (cont_id),
    FOREIGN KEY (cont_pf_id) references pessoa_fisica (pf_id));

CREATE TABLE conta_corrente(
	cc_numero varchar(10),
    cc_saldo decimal(16,3),
    cc_pf_id INT,
    cc_dt_ultima_alteracao date,
    PRIMARY KEY (cc_numero),
    FOREIGN KEY (cc_pf_id) references pessoa_fisica (pf_id));