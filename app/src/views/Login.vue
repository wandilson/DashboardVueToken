<template>
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-7">
				<div class="card bg-secondary shadow border-0">
					<div class="card-body px-lg-5 py-lg-5">
						<div class="text-center text-muted mb-4">
							<small>Vamos fazer login? Informe seus dados corretamente!</small>
						</div>

						<base-alert type="danger" v-show="errors != ''">
							<strong>Humm!</strong> Não conseguimos fazer seu login!
							<ul class="mt-4">
								<li v-for="(erro, index) of errors" :key="index">{{ erro[0] }}</li>
							</ul>
						</base-alert>

						<form role="form">
							<base-input class="input-group-alternative mb-3"
										placeholder="Cpf"
										addon-left-icon="ni ni-lock-circle-open"
										v-model="form.cpf">
							</base-input>

							<base-input class="input-group-alternative"
										placeholder="Password"
										type="password"
										addon-left-icon="ni ni-lock-circle-open"
										v-model="form.password">
							</base-input>

							<base-checkbox class="custom-control-alternative">
								<span class="text-muted">Manter conectado</span>
							</base-checkbox>
							<div class="text-center">
								<base-button type="primary" class="my-4" @click.prevent="login">Acessar</base-button>
							</div>
						</form>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-6">
						<a href="#" class="text-light" @click.prevent="modalRedefineOpen"><small>Esqueceu sua senha?</small></a>
					</div>
					<div class="col-6 text-right">
						<router-link to="/register" class="text-light"><small>Criar Conta</small></router-link>
					</div>
				</div>
			</div>


	<!-- 
		Modal Redefinir Senha
	-->
	<modal :show.sync="modals.modal" body-classes="p-0" modal-classes="modal-dialog-centered modal-sm">
		<card type="secondary" shadow
				header-classes="bg-white pb-5"
				body-classes="px-lg-5 py-lg-5"
				class="border-0">
				
			<template>
				<div class="text-center text-muted mb-4">
					<h2>Oi, vamos redefinir sua senha!</h2>
				</div>

				<base-alert type="success" v-show="success">
					<strong>Olá!</strong> Enviamos sua nova senha por e-mail!
				</base-alert>
				
				<base-alert type="danger" v-show="errorRedefine != ''">
					<strong>Humm!</strong> Não conseguimos inserir seu registro!
					<ul class="mt-4">
						<li>{{errorRedefine}}</li>
					</ul>
				</base-alert>

				<form role="form">
					<base-input alternative
						class="mb-3"
						placeholder="E-mail"
						addon-left-icon="ni ni-email-83"
						v-model="form.email">
					</base-input>

					<div class="text-center">
						<base-button type="secondary" @click="modals.modal = false">Sair</base-button>
						<base-button type="primary" class="my-4" @click.prevent="redefinePass">Redefinir</base-button>
					</div>
				</form>
			</template>
		</card>
	</modal>



		</div>
</template>



<script>
	import Auth from '@/apis/Auth';
	export default {
		name: 'login',
		data() {
			return {
				modals: {
					modal: false
				},
				form: {
					email: '',
					cpf: '',
					password: '',
					device_name: 'Browser'
				},
				errors: [],
				errorRedefine: [],
				success: false
			}
		},
		methods: {
			modalRedefineOpen(){
				this.errorRedefine = '';
				this.modals.modal = true;
			},
			redefinePass(){
				Auth.redefinePass(this.form)
				.then( response => {
					this.success = true;
				})
				.catch(error => {
					this.errorRedefine = error.response.data;
				});
			},
			login(){
				Auth.login(this.form)
				.then( response => {
					localStorage.setItem("token", response.data.token);
					this.$router.push({ name: "dashboard"});
				})
				.catch(error => {
					if(error.response.status === 401) {
						this.errors = error.response.data;
					}
					if(error.response.status === 422) {
						this.errors = error.response.data.errors;
						console.log(error.response.data.errors);
					}
					console.log(error)
				});
			}
		}
	}
</script>
<style>
</style>
