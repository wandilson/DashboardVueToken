# Dashboard + SPA
### Introdução
Aplicativo SPA multitenant, usa vuejs 2 que se conecta a uma Api Laravel, autoriza acesso usando **token**, "Laravel/Sanctum", sendo o mesmo gravado em localStorage e banco de dados.

**OBJETIVO:** Compartilhar aplicação, **aprender** com possíveis sugestões, **e melhorar** o código com o auxílio da comunidade.

## API
Feita em Laravel 7, usando Sanctum para geração de token.


&nbsp;
## APP: VueJs
Feito em ***Vuejs2***, e templates free para agilizar o desenvolvimento.

- [x] Vue Argon Dashboard Free - https://www.creative-tim.com/
- [x] Vuejs
- [x] Vue-Router
- [x] Axios
- [x] momentjs
- [x] v-mask
- [ ] Vuex


### Features
> 21/04
- [x] Register
	- [x] Envia e-mail de boas vindas ao se registrar.
	- [x] Eu concordo com a Política de Privacidade.

- [x] Login
	- [x] Me manter conectado
	- [x] Bloqueia acesso de usuários inativos.

- [x] Logout
	- [ ] Deslogar ao fechar aba do navegador "***Não Faço idéia de como fazer***".

- [x] Redefinir Senha
- [x] Profile
	- [ ] Incrementar Avatar
- [ ] Users
	- [ ] Usuários com o ***Type:1*** não podem ser excluidos nem bloqueados.




&nbsp;
#### Register
Todo novo registro gera um tenant/empresa, assim todo o conteúdo gerado fica relacionado ao tenant.
O usuário ao se registrar torna-se administrador do tenant.

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
Após o registro passar pelas validações e ser inserido, o usuário é logado automaticamente:
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
	- Após o retorno o token é gravado no localStorage
	- Token é usado em todos os cabeçalhos de requisições, autorizando o usuário.
	- Ao termino do registro é enviado um e-mail de boas vindas ao usuário.
 

&nbsp;
#### Login
Usuários bloqueados não tem acesso ao sistema.
```
## Login

Method: POST
API: localhost:8000/api/login

Dados enviados:
{
	cpf: '',
	password: ''
	device_name: 'Browser'
}
```

```
## Retorno após login

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
	- Após o retorno o token é gravado no localStorage
	- Token é usado em todos os cabeçalhos de requisições, autorizando o usuário.


&nbsp;
#### Profile
Funcionalidade que permite o usuário editar suas informações pessoais assim como trocar sua senha.

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
#### Users
A aplicação permite adicionar outros usuários ao tenant, que poderão gerenciar todas as informações.

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
},
{
	...
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
#### Tokens
Ao logar é gerado um token que é armazenado no banco de dados, permanecendo até o usuário ser deslogado ou o token excluído.

```
## Listar Tokens

Method: Get
API: localhost:8000/api/config/tokens

Retorna lista de tokens:
{
	tokenable_id: '',	// Relaciona ao usuário
	name: '', 		// Onde o token foi gerado
	token: '',		
	abilities: '',		// Define oque o usuário pode acessar
	last_used_at: '',
	created_at: ''
},
{
	...
}
```
```
## Remover Token do Banco de dados

Method: Delete
API: localhost:8000/api/config/tokens/id

Retorno após token removido:
{
	response: 'Token removido com sucesso',
	stats: 201
}
```

&nbsp;
#### Errors Code
Lista de possiveis erros gerados.


---

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