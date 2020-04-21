<template>
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-7">
			<div class="card bg-secondary shadow border-0">
				<div class="card-body px-lg-5 py-lg-5">
					<div class="text-center text-muted mb-4">
						<small>Para ter acesso precisamos fazer seu cadastro, é rápido!</small>
					</div>
					<base-alert type="danger" v-show="errors != ''">
						<strong>Humm!</strong> Não conseguimos inserir seu registro!
						<ul class="mt-4">
							<li v-for="(erro, index) of errors" :key="index">{{ erro[0] }}</li>
						</ul>
					</base-alert>
					<form role="form">
						<base-input class="input-group-alternative mb-3"
									placeholder="Cpf"
									addon-left-icon="ni ni-hat-3"
									v-model="form.cpf">
						</base-input>

						<base-input class="input-group-alternative mb-3"
									placeholder="Nome"
									addon-left-icon="ni ni-hat-3"
									v-model="form.name">
						</base-input>

						<base-input class="input-group-alternative mb-3"
									placeholder="Email"
									addon-left-icon="ni ni-email-83"
									v-model="form.email">
						</base-input>

						<base-input class="input-group-alternative"
									placeholder="Senha"
									type="password"
									addon-left-icon="ni ni-lock-circle-open"
									v-model="form.password">
						</base-input>

						<base-input class="input-group-alternative"
									placeholder="Confirmar Senha"
									type="password"
									addon-left-icon="ni ni-lock-circle-open"
									v-model="form.password_confirmation">
						</base-input>

						<!--
							<div class="row my-4">
								<div class="col-12">
									<base-checkbox class="custom-control-alternative">
										<span class="text-muted">Eu concordo com a <a href="#!">Política de Privacidade</a></span>
									</base-checkbox>
								</div>
							</div>
						-->
						<div class="text-center">
							<base-button @click.prevent="register" type="primary" class="my-4">Criar Conta</base-button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import Auth from '@/apis/Auth';
	export default {
		name: 'register',
		data() {
			return {
				form: {
					cpf: '',
					name: '',
					email: '',
					password: '',
					password_confirmation: '',
					device_name: 'Browser'
				},
				errors: []
			}
		},
		methods: {
			register() {
				Auth.register(this.form)
				.then( response => {
					localStorage.setItem("token", response.data.token);
					this.$router.push({ name: "dashboard"});
				})
				.catch(error => {
					if(error.response.status === 422) {
						this.errors = error.response.data.errors;
					}
				});
			}
		}
	}
</script>
<style>
</style>
