<template>
	<themeDash id="users">

		<div class="container">
			<div class="row justify-content-between">
				<div class="col-md-7 mt-4">
					
					<h4>Usuários com acesso</h4>
					<b-button class="ml-2 mb-2 btn-sm float-right" type="submit" variant="primary" @click.prevent="newRegister">Novo Registro</b-button>

					<b-table :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" responsive="sm">

						<!-- A custom formatted column -->
						<template v-slot:cell(stats)="row">
							<span v-show="row.item.stats == 1">Ativo</span>
							<span v-show="row.item.stats == 0">Inativo</span>
						</template>

						<template v-slot:cell(actions)="row">
							<b-dropdown size="sm" id="dropdown-1" text="Opções" variant="outline-primary">
								<b-dropdown-item @click.prevent="edit(row.item)">Editar</b-dropdown-item>
								<b-dropdown-item>Bloquear</b-dropdown-item>
								<b-dropdown-divider v-if="row.item['type'] != 1"></b-dropdown-divider>
								<b-dropdown-item v-if="row.item['type'] != 1" variant="danger" @click.prevent="remove(row.item['id'])">Deletar</b-dropdown-item>
							</b-dropdown>
						</template>

					</b-table>

				</div>

				<b-card class="col-md-4">
					<h3>{{titleForm}}</h3>

					<b-alert show v-show="success" dismissible>
						Registro Atualizado com Sucesso
					</b-alert>

					<ul>
						<li v-for="(erro, index) of errors" :key="index">{{ erro }}</li>
					</ul>

					<b-form @submit.prevent="save">
						<b-form-group class="mr-2" label="CPF:">
							<b-form-input v-model="form.cpf" type="text" required></b-form-input>
						</b-form-group>

						<b-form-group class="mr-2" label="Nome:">
							<b-form-input v-model="form.name" required></b-form-input>
						</b-form-group>

						<b-form-group class="mr-2" label="E-mail:">
							<b-form-input v-model="form.email" required></b-form-input>
						</b-form-group>

						<b-form-group class="mr-2" label="Password:">
							<b-form-input v-model="form.password"></b-form-input>
						</b-form-group>


						<b-form-group class="mr-2" label="Confirmar Password:">
							<b-form-input v-model="form.password_confirmation"></b-form-input>
						</b-form-group>

						<div class="row">
							<div class="col-md-12 mt-2">
								<b-button class="ml-2 btn-sm" type="reset" variant="warning" @click.prevent="newRegister">Limpar Formulário</b-button>
								<b-button class="ml-2 btn-sm" type="submit" variant="primary">Salvar</b-button>
							</div>
						</div>
						
					</b-form>
				</b-card>
			</div>
		</div>

	</themeDash>
</template>

<script>
import themeDash from './../template/Dash'
import Users from '@/apis/Users'
export default {
	components: {
		themeDash
	},
	data() {
		return {
			form: {},
			titleForm: 'Novo Registro',
			errors: [],
			success: false,

			sortBy: 'age',
			sortDesc: false,
			fields: [
				{ key: 'name', label: 'Nome', sortable: true },
				{ key: 'email', label: 'E-mail',  sortable: true },
				{ key: 'stats', label: 'Stats', sortable: false },
				{ key: 'actions', label: 'Opções'}
			],
			items: []
		}
	},
	created(){
		this.loadUser()
	},
	methods: {
		loadUser(){
			Users.list()
			.then( response => {
				this.items = response.data;
			})
		},




		newRegister(){
			this.form = {};
			this.errors = [];
			this.titleForm = 'Novo Registro'
		},
		edit(row){
			this.form = row;
			this.errors = [];
			this.statsForm = true;
			this.titleForm = 'Editar Registro'
		},




		save(){
			if(this.form.id){
				Users.update(this.form)
				.then( () => {
					this.success = true;
					this.loadUser();
				}).catch( error => {
					this.errors = error.response.data.errors;
				})
			}else{
				Users.create(this.form)
				.then( () => {
					this.loadUser()
					this.errors = [];
				}).catch( error => {
					this.errors = error.response.data.errors;
				})
			}
		},




		remove(id){
			Users.remove(id)
			.then( () => {
				this.loadUser();
			}).catch( error => {
				this.errors = error.response.data.errors;
			})
		}
	}
}
</script>

<style>

</style>