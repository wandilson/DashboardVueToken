<template>
	<themeDash id="bank">
		<b-container>
			<h1>Banco</h1>
				<b-card class="col-md-8">
					<h3>{{titleForm}}</h3>

					<b-alert show v-show="success" dismissible>
						Registro Atualizado com Sucesso
					</b-alert>

					<ul>
						<li v-for="(erro, index) of errors" :key="index">{{ erro }}</li>
					</ul>

					<b-form inline @submit.prevent="save">
						<b-form-group class="mr-2" label="Nome do Banco:">
							<b-form-input v-model="form.name" type="text" required></b-form-input>
						</b-form-group>

						<b-form-group class="mr-2" label="Saldo:">
							<b-form-input v-model="form.amount" required></b-form-input>
						</b-form-group>

						
						<div class="mt-4">
							<b-button class="" type="reset" variant="warning">Limpar Formulário</b-button>
							<b-button class="ml-2" type="submit" variant="primary">Salvar</b-button>
						</div>
						
					</b-form>
				</b-card>
		</b-container>
	</themeDash>
</template>

<script>
import themeDash from './../template/Dash'
export default {
	name: 'bank',
	components: {
		themeDash
	},
	data() {
		return {
			form: ''
		}
	}
}
</script>

<style>

</style>