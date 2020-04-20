<template>
	<div id="login">
		<div class="login-page">
			<b-card title="Acesso Cliente" sub-title="Cliente informe seus dados de acesso">

				<b-form>
					
					<!-- Group e-mail -->
					<b-form-group
						id="cpf"
						label="CPF:">

						<b-form-input
							v-model="form.cpf"
							type="text"
							required
							placeholder="Informe seu cpf para login">
						</b-form-input>
					</b-form-group>

					<b-form-group id="password" label="Senha:" label-for="password">
						<b-form-input
							v-model="form.password"
							type="password"
							required
							placeholder="Informe sua senha">
						</b-form-input>
					</b-form-group>

					<b-button type="reset" variant="danger btn-sm">Limpar</b-button>
					<b-button @click.prevent="login" type="submit" variant="primary ml-2  btn-sm">Acessar</b-button>

				</b-form>
				<ul>
					<li v-for="(erro, index) of errors" :key="index">{{ erro }}</li>
				</ul>
				<hr>

				<b-card-text>
					NÃO É CLIENTE? Faça um teste gratuido em nosso plataforma, <a href="">TESTAR!</a>
				</b-card-text>

			</b-card>
		</div>
	</div>
</template>

<script>
import Auth from '@/apis/Auth';

export default {
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
				this.$router.push({ name: "app"});
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
			width: 325px;
		}
	}
</style>