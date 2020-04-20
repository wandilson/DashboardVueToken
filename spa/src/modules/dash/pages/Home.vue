<template>
	<themeDash id="home">
		<div class="container">
			<div class="row">
				<h1>Visão Geral</h1>
			</div>

			<div class="row mt-4 mb-4">

				<b-card class="col-md-3">
					Saldo Atual R$ 5.322,17
					<p title="Aumento de 5% comparado ao mês anterior">5% +</p>
					<a href="">detalhes</a>
				</b-card>

				<b-card class="col-md-3">
					Saldo Previsto para o mês  R$ 5.822,17
					<p title="Aumento de 5% comparado ao mês anterior">5% +</p>
					<a href="">detalhes</a>
				</b-card>

				<b-card class="col-md-3">
					Previsão Receita x Despesas
					Colocar gráfico
					<a href="">detalhes</a>
				</b-card>

			</div>

			<div class="row">
				<b-tabs content-class="mt-3" align="center">
					<b-tab title="Receitas">
						
						<p>Tabela contendo as receitas do mês corrente</p>
						<p>Opção de escolher outro mês</p>
						<p>Opção de editar registros</p>
						<p>opção de pesquisar registro</p>

					</b-tab>
					<b-tab title="Despesas" active>
						
						<p>Tabela contendo as despesas do mês corrente</p>
						<p>Opção de escolher outro mês</p>
						<p>Opção de editar registros</p>
						<p>opção de pesquisar registro</p>

					</b-tab>
				</b-tabs>
			</div>
			

		</div>
		
	</themeDash>
</template>

<script>
import themeDash from './../template/Dash'
export default {
	name: 'home',
	components: {
		themeDash
	},
	data(){
		return {
			form: {
				email: '',
				password: '',
				device_name: 'Browser'
			},
			errors: []
		}
	}
}
</script>

<style>

</style>