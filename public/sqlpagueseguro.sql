/******************************************************
****   SCRIPT DE GERAÇÃO DAS TABELAS PARA MYSQL    ****
******************************************************/


CREATE TABLE PagSeguroTransacoes (
       TransacaoID VARCHAR(36) PRIMARY KEY NOT NULL,
       VendedorEmail VARCHAR(200) NOT NULL,
       Referencia VARCHAR(200) NULL,
       TipoFrete CHAR(2) NULL,
       ValorFrete DECIMAL(10,2) NULL,
       Extras DECIMAL(10,2) NULL,
       Anotacao TEXT NULL,
       TipoPagamento VARCHAR(50) NOT NULL,
       StatusTransacao VARCHAR(50) NOT NULL,
       CliNome VARCHAR(200) NOT NULL,
       CliEmail VARCHAR(200) NOT NULL,
       CliEndereco VARCHAR(200) NOT NULL,
       CliNumero VARCHAR(10) NULL,
       CliComplemento VARCHAR(100) NULL,
       CliBairro VARCHAR(100) NOT NULL,
       CliCidade VARCHAR(100) NOT NULL,
       CliEstado CHAR(2) NOT NULL,
       CliCEP VARCHAR(9) NOT NULL,
       CliTelefone VARCHAR(14) NULL,
       NumItens INT NOT NULL 
) ;
CREATE TABLE PagSeguroTransacoesProdutos (
       TransProdID INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
       TransacaoID VARCHAR(36) NOT NULL,
       ProdID VARCHAR(100) NOT NULL,
       ProdDescricao VARCHAR(100) NOT NULL,
       ProdValor DECIMAL(10,2) NOT NULL,
       ProdQuantidade INTEGER NOT NULL,
       ProdFrete DECIMAL(10,2) NULL,
       ProdExtras DECIMAL(10,2) NULL
) ;

