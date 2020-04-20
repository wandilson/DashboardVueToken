# Dashboard: API Laravel + Vuejs
### Introdução
Aplicativo SPA multitenant, usa vuejs 2 e se conecta a uma Api Laravel, efetua login usando **token** de acesso "Laravel/Sanctum", sendo o mesmo gravado em localStorage.

**OBJETIVO:** Compartilhar o código, **aprender** com possiveis sugestões, **e melhorar** o código com o auxilio da comunidade.

&nbsp;
### COMO POSSO TESTAR?
Baixe as duas pastas e dentro de suas respectivos diretórios execute os comandos:

##### VUEJS: Setup Inicial
```
npm install
```

##### VUEJS: Rodar server
```
npm run serve
```


##### API: Criar tabelas no banco
```
php artisan migrate
```
##### API: Rodar servidor PHP
```
php artisan serve
```
**Não esqueça de configurar e criar o banco de dados**


&nbsp;

### RECURSOS USADOS NA APLICAÇÃO

- [x] Laravel 7.0
- [X] laravel/sanctum
---
- [x] Vuejs 2
- [x] Bootstrap-vue
- [x] Vue-Router
- [x] Axios
- [ ] Vuex



&nbsp;
#### Funcionalidades Comuns
##### Register
Todo novo registro gera um tenant/empresa, assim todo o conteudo gerado fica relacionado ao tenant.
O usuário ao se registrar se torna administrador do tenant.

```
## Novo Registro

Method: POST
API: localhost:8000/api/register

Dados enviados:
{
	cpf: '',
	name: '',
	email: '',
	password: '',
	password_confirmation: '',
	device_name: 'Browser'
}
```

Após o registro passar pelas validações e ser inserido o usuário é logado automaticamente:
```
## Retorno após registro

 Dados retornados:
 {
	 user: {
		 tenant_id: '',
		 type: '', 	// 1 = Administrador, 2 = Usuario Comum
		 stats: '',	// 0 = Inativo, 1 = Ativo
		 cpf: '',
		 name: '',
		 email: ''
	 },
	 token: ''
 }
```

 Após o retorno o token é gravado no localStorage, apartir disso é usado em todos os cabeçalhos de requisições, autorizando o usuário.


&nbsp;
##### Profile
Recurso que permite o usuário editar suas informações pessoais assim como trocar sua senha.
```
## Retorna dados do perfil

Method: Get
API: localhost:8000/api/config/loadUser

Dados retornados:
{
	tenant_id: '',
	stats: '',	// 0 = Inativo, 1 = Ativo
	cpf: '',
	name: '',
	email: '',
}
```

```
## Atualiza dados do perfil

Method: Put
API: localhost:8000/api/config/users

Dados enviados:
{
	id: '',
	stats: '',	// 0 = Inativo, 1 = Ativo
	cpf: '',
	name: '',
	email: '',
	password: '',
	password_confirmation: ''
}
```


&nbsp;
##### Users
A aplicação permite adicionar outros usuários ao tenant, assim vão poder gerenciar todas as informações.

```
## Listar Usuário

Method: Get
API: localhost:8000/api/config/users

Lista de Usuários:
{
	id: '',
	type: '', 	// 1 = Administrador, 2 = Usuario Comum
	stats: '',	// 0 = Inativo, 1 = Ativo
	cpf: '',
	name: '',
	email: ''
}
```


```
## Novo Usuário

Method: Post
API: localhost:8000/api/config/users

 Dados enviados:
 {
	cpf: '',
	name: '',
	email: '',
	password: '',
	password_confirmation: ''
 }
```


É possivel habilitar e desabilitar o usuário enviando somente o id para a rota expecifica, exceto o de type = 1 "Administrador"
```
## Habilitar/Desabilitar usuário

Method: Put
API: localhost:8000/api/config/users/disable

Dados enviados:
{
	id: ''
}
```


&nbsp;
#### Features
Uma feature é uma funcionalidade do sistema que entrega um benefício ou resolve um problema real do cliente

> 20/04
- [x] Editar perfil do usuário logado
- [x] Gerenciar usuários por tenant:
- [x] O adm pode excluir usuários exceto seu proprio cadastro.
- [x] Habilitar/Desabilitar usuários.
- [ ] Usuários desabilitados não podem acessar o sistema.
- [ ] Acrescentar Mensagem "Registro deletado com Sucesso"
- [ ] Visualizar/Remover tokens ativos
- [ ] Ao se registrar enviar e-mail de boas vindas
- [ ] Redefinir Senha
- [ ] Opção de avatar no perfil do usuário






&nbsp;
#### Refatoração
Refatoração é o processo de modificar um sistema de software para melhorar a estrutura interna do código sem alterar seu comportamento externo.
