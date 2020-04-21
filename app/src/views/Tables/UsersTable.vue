<template>
<div>
	<div class="card shadow" :class="type === 'dark' ? 'bg-default': ''">
		<div class="card-header border-0" :class="type === 'dark' ? 'bg-transparent': ''">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="mb-0" :class="type === 'dark' ? 'text-white': ''">
						{{title}}
					</h3>
				</div>
				<div class="col text-right">
					<base-button type="primary" size="sm" @click.prevent="newUser">Novo</base-button>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<base-table class="table align-items-center table-flush"
						:class="type === 'dark' ? 'table-dark': ''"
						:thead-classes="type === 'dark' ? 'thead-dark': 'thead-light'"
						tbody-classes="list"
						:data="tableData">

				<template slot="columns">
					<th>Nome</th>
					<th>Cpf</th>
					<th>E-mail</th>
					<th>Stats</th>
					<th></th>
				</template>

				<template slot-scope="{row}">

					<th scope="row">
						<div class="media align-items-center">
							<div class="media-body">
								<span class="name mb-0 text-sm">{{row.name}}</span>
							</div>
						</div>
					</th>
					<td class="budget">
						{{row.cpf}}
					</td>
					<td>
						{{row.email}}
					</td>
					<td>
						<badge v-if="row.stats == 1" class="badge-dot mr-4 badge-success">
							<i class="bg-success"></i>
							<span class="status">Ativo</span>
						</badge>
						<badge v-if="row.stats == 0" class="badge-dot mr-4 badge-danger">
							<i class="bg-danger"></i>
							<span class="status">Inativo</span>
						</badge>
					</td>


					<td class="text-right">
						<base-dropdown style="cursor: pointer" class="dropdown" position="right">
						<a slot="title" class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-ellipsis-v"></i>
						</a>

						<template>
							<a class="dropdown-item" href="#"  @click.prevent="edit(row)">Editar</a>
							<a class="dropdown-item" href="#">Desabilitar</a>
							<a class="dropdown-item text-danger" href="#">Deletar</a>
						</template>
						</base-dropdown>
					</td>

				</template>

			</base-table>
		</div>
	</div>


	<!-- 
		Modal Novo User / Edit User
	-->
	<modal :show.sync="modals.modal" body-classes="p-0" modal-classes="modal-dialog-centered modal-sm">
		<card type="secondary" shadow
				header-classes="bg-white pb-5"
				body-classes="px-lg-5 py-lg-5"
				class="border-0">
				
			<template>

				<div class="text-center text-muted mb-4">
					<h2 v-if="!form.id">Inserir novo Usuário</h2>
					<h2 v-if="form.id">Editar Dados do Usuário</h2>
				</div>

				<base-alert type="success" v-show="alertSuccess = false">
					<strong>Olá!</strong> Registro Inserido com Sucesso!
				</base-alert>
				<base-alert type="danger" v-show="alertError = false">
					<strong>Humm!</strong> Não conseguimos inserir seu registro!
					<ul class="mt-4">
						<li>CPF já esta em uso!</li>
						<li>E-mail ja esta sendo usado!</li>
						<li>Senha não confere!</li>
					</ul>
				</base-alert>

				<form role="form">
					<base-input alternative
								class="mb-3"
								placeholder="CPF"
								addon-left-icon="ni ni-paper-diploma"
								v-model="form.cpf">
					</base-input>
					<base-input alternative
								class="mb-3"
								placeholder="Nome"
								addon-left-icon="ni ni-single-02"
								v-model="form.name">
					</base-input>
					<base-input alternative
								class="mb-3"
								placeholder="E-mail"
								addon-left-icon="ni ni-email-83"
								v-model="form.email">
					</base-input>
					<base-input alternative
								type="password"
								placeholder="Senha"
								addon-left-icon="ni ni-lock-circle-open"
								v-model="form.password">
					</base-input>
					<base-input alternative
								type="password"
								placeholder="Confirmar Senha"
								addon-left-icon="ni ni-lock-circle-open"
								v-model="form.password_confirmation">
					</base-input>

					<div class="text-center">
						<base-button type="secondary" @click="modals.modal = false">Sair</base-button>
						<base-button type="primary" class="my-4" @click.prevent="save" :disabled="!isValid">Salvar</base-button>
					</div>
				</form>
			</template>
		</card>

	</modal>

</div>
</template>
<script>
  export default {
	name: 'projects-table',
	props: {
	  type: {
		type: String
	  },
	  title: String
	},
	data() {
	  return {
		modals: {
			modal: false
		},
		form:{},
		tableData: [
		  {
			id: 1,
			name: 'wandilson oliveira',
			email: 'wandilson.oliver@gmail.com',
			stats: '1',
			cpf: '002.362.971-12'
		  },
		  {
			id: 2,
			name: 'Danielle',
			email: 'dani@gmail.com',
			stats: '0',
			cpf: '002.362.971-15'
		  }
		]
	  }
	},
	computed: {
		isValid: function () {
			return  this.form.cpf != null && this.form.cpf != '' &&
					this.form.name != null && this.form.name != '' &&
					this.form.email != null && this.form.email != '';
		}
	},	
	methods: {
		newUser(){
			this.form = {};
			this.modals.modal = true;
		},
		edit(row){
			this.form = row;
			this.modals.modal = true;
		},
		
		save(){
			if(this.form.id){
				console.log(this.form)
			}else{
				console.log(this.form)
			}
		}
	}
  }
</script>
<style>
</style>
