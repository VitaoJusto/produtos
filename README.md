
# 📦 Sistema de Cadastro de Produtos em PHP + MySQL

Este projeto é uma aplicação simples de **cadastro de produtos** (CRUD) feita com **PHP** e **MySQL**, ideal para rodar em ambiente local usando o **XAMPP**.

A interface é limpa, responsiva e sem dependência de frameworks. Todo o sistema está contido em **um único arquivo PHP** com CSS embutido.

---

## ✅ Funcionalidades

O sistema permite realizar as seguintes operações com produtos:

| Operação   | Descrição                                                                 |
|------------|---------------------------------------------------------------------------|
| **Criar**  | Cadastrar novos produtos com nome, preço e descrição                      |
| **Listar** | Exibir todos os produtos cadastrados em uma tabela                       |
| **Editar** | Atualizar informações de um produto existente                             |
| **Excluir**| Remover um produto da base de dados                                       |
| **Validação** | Impede cadastro de produtos com nomes duplicados                      |
| **Mensagens de erro** | Mostra aviso em vermelho se nome já existir, sem redirecionar  |

---

## 🧰 Requisitos

- [XAMPP](https://www.apachefriends.org/) com **Apache** e **MySQL** ativados
- PHP 7.0+ instalado (incluso no XAMPP)
- Navegador moderno (Chrome, Firefox, etc.)

---

## 🚀 Como executar o projeto com XAMPP

### 1. Coloque a pasta correta
- Copie a pasta `produtos` para:
  ```
  C:\xampp\htdocs\
  ```

### 2. Inicie os serviços
- Abra o **XAMPP Control Panel**
- Clique em **Start** nos módulos:
  - Apache
  - MySQL

### 3. Crie o banco de dados e tabela
- Acesse o phpMyAdmin:
  ```
  http://localhost/phpmyadmin
  ```
- Clique na aba **SQL** e execute o seguinte script:

```sql
CREATE DATABASE IF NOT EXISTS produtos;
USE produtos;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    preco DECIMAL(10,2) NOT NULL,
    descricao TEXT
);
```

### 4. Acesse o sistema
Abra seu navegador e vá até:
```
http://localhost/produtos/
```

---



## 🎨 Estilo Visual

- CSS embutido direto no arquivo
- Tabela de produtos estilizada
- Formulários com campos responsivos
- Botões arredondados
- Mensagens de erro visíveis em vermelho

