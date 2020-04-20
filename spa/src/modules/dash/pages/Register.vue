<template>
	<div id="register">
		<div class="login-page">
			<b-card title="Novo Registro" sub-title="Olá, precha os dados abaixo para testar nossa plataforma">

				<b-form @submit.prevent="register()">
					
					<!-- Group CPF -->
					<b-form-group
						label="CPF:">

						<b-form-input
							v-model="form.cpf"
							type="text"
							required
							placeholder="Informe seu cpf para login">
						</b-form-input>
					</b-form-group>

					<!-- Group Nome -->
					<b-form-group
						label="Nome:">

						<b-form-input
							v-model="form.name"
							type="text"
							required
							placeholder="Informe seu nome">
						</b-form-input>
					</b-form-group>

					<!-- Group E-mail -->
					<b-form-group
						label="E-mail:">

						<b-form-input
							v-model="form.email"
							type="email"
							required
							placeholder="Informe seu e-mail">
						</b-form-input>
					</b-form-group>


					<!-- Group Senha -->
					<div class="row">
						<b-form-group class="col-md-6" label="Senha:" label-for="password">
							<b-form-input
								v-model="form.password"
								type="password"
								required
								placeholder="Cadastre uma senha">
							</b-form-input>
						</b-form-group>

						<!-- Group Confirmação de senha -->
						<b-form-group
							class="col-md-6"
							label="Confirme sua senha:">

							<b-form-input
								v-model="form.password_confirmation"
								type="password"
								required
								placeholder="">
							</b-form-input>
						</b-form-group>


					</div>

					<b-button type="reset" variant="danger btn-sm">Limpar</b-button>
					<b-button type="submit" variant="primary ml-2  btn-sm">Me cadastrar</b-button>

				</b-form>
				<hr>
				<ul>
					<li v-for="(erro, index) of errors" :key="index">{{ erro }}</li>
				</ul>

			</b-card>
		</div>
	</div>
</template>

<script>

import User from '@/apis/Auth';

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
			User.register(this.form)
			.then( response => {
				localStorage.setItem("token", response.data.token);
				this.$router.push({ name: "app"});
				console.log(response);
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

<style scoped lang="scss">
	.login-page {
		height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
		.card {
			width: 425px;
		}
	}
</style>