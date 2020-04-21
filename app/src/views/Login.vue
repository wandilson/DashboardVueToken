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
						<a href="#" class="text-light"><small>Esqueceu sua senha?</small></a>
					</div>
					<div class="col-6 text-right">
						<router-link to="/register" class="text-light"><small>Criar Conta</small></router-link>
					</div>
				</div>
			</div>
		</div>
</template>



<script>
	import Auth from '@/apis/Auth';
	export default {
		name: 'login',
		data() {
			return {
				form: {
					cpf: '',
					password: '',
					device_name: 'Browser'
				},
				errors: []
			}
		},
		methods: {
			login(){
				Auth.login(this.form)
				.then( response => {
					localStorage.setItem("token", response.data.token);
					this.$router.push({ name: "dashboard"});
					console.log(response)
				})
				.catch(error => {
					if(error.response.status === 401) {
						this.errors = error.response.data;
					}
					if(error.response.status === 422) {
						this.errors = error.response.data.errors;
					}
					console.log(error)
				});
			}
		}
	}
</script>
<style>
</style>
