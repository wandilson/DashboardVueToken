<template>
	<themeDash id="profile">
		<b-container>
			<b-row>
				<b-card title="Meus Dados">
					<b-alert show dismissible v-show="success">
						Dados atualizados com sucesso!
					</b-alert>
					<b-form inline>
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
							<b-form-input v-model="form.password" required></b-form-input>
						</b-form-group>


						<b-form-group class="mr-2" label="Confirmar Password:">
							<b-form-input v-model="form.password_confirmation" required></b-form-input>
						</b-form-group>

						<b-button @click.prevent="update" class="mt-2" type="submit" variant="primary">Salvar</b-button>
						<hr>
						<ul class="mt-4">
							<li v-for="(erro, index) of errors" :key="index">{{ erro }}</li>
						</ul>
					</b-form>
				</b-card>
			</b-row>
		</b-container>
	</themeDash>
</template>

<script>
import themeDash from './../template/Dash'
import Auth from '@/apis/Auth'
export default {
	name: 'profile',
	components: {
		themeDash
	},
	data() {
		return {
			form: {},
			success: false,
			errors: []
		}
	},
	created() {
		Auth.loadUser()
		.then( response => {
			this.form = response.data;
			console.log(response);
		})
	},
	methods: {
		update(){
			Auth.updateProfile(this.form)
			.then( () => {
				this.success = true;
			}).catch(error => {
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