# 🚗 Sistema CRUD - Controle de Clientes e Veículos

Desenvolvido por: Beatriz Cristiane Haberman Severo Alves

Um sistema web completo desenvolvido em PHP e MySQL para o gerenciamento de clientes e seus respectivos veículos. O projeto conta com controle de acesso (autenticação), criptografia de senhas, banco de dados relacional e uma interface moderna totalmente personalizada em tons de roxo com imagens de fundo responsivas.

---

## 💜 Funcionalidades Principais

* **Controle de Acesso Seguro:** Sistema de login com validação de credenciais e proteção de páginas através de sessões (`session_start`).
* **Auto-Cadastro de Usuários:** Opção na tela inicial para novos operadores criarem suas próprias contas com senhas seguras (criptografia MD5).
* **Vínculo de Auditoria ("Cadastrado por"):** O banco de dados utiliza uma Chave Estrangeira (`FOREIGN KEY`) para registrar e exibir na tabela exatamente qual usuário do sistema realizou o cadastro de cada veículo.
* **CRUD de Veículos Completo:**
  * **Create:** Cadastro de clientes com dados de contato e informações do carro (Marca, Modelo e Placa).
  * **Read:** Painel (Dashboard) com listagem em tempo real e ótima legibilidade.
  * **Update:** Tela de edição para atualizar dados cadastrais do cliente ou do automóvel.
  * **Delete:** Exclusão de registros com alerta de confirmação em JavaScript.

---

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP 8.2 (com PDO para conexões seguras com o banco de dados).
* **Banco de Dados:** MySQL / MariaDB (com integridade referencial `ON DELETE CASCADE`).
* **Frontend:** Bootstrap 5.3 (para a estrutura responsiva) e CSS3 Personalizado.

---
