<template>
	<div>
		<b-navbar toggleable="lg" type="dark" variant="info" class="mb-5">
			<b-navbar-brand href="/app">Dashboard</b-navbar-brand>

			<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<b-collapse id="nav-collapse" is-nav>


				<!-- Right aligned nav items -->
				<b-navbar-nav class="ml-auto">
					<b-navbar-nav>
						<b-nav-item href="#">Lançamentos</b-nav-item>
						<b-nav-item href="#">Metas</b-nav-item>
						<b-nav-item href="#">Relatórios</b-nav-item>
					</b-navbar-nav>
					<b-nav-item-dropdown text="Config" right>
						<b-dropdown-item href="/bank">Banco</b-dropdown-item>
						<b-dropdown-item href="#">Categorias</b-dropdown-item>
						<b-dropdown-item href="#">Centro de Custos</b-dropdown-item>
					</b-nav-item-dropdown>

					<b-nav-item-dropdown right>
						<!-- Using 'button-content' slot -->
						<template v-slot:button-content>
							wandilson
						</template>
						<b-dropdown-item href="/profile">Meu Perfil</b-dropdown-item>
						<b-dropdown-divider></b-dropdown-divider>
						<b-dropdown-item href="/users">Usuários</b-dropdown-item>
						<b-dropdown-item href="/tokens">Tokens Ativos</b-dropdown-item>
						<b-dropdown-divider></b-dropdown-divider>
						<b-dropdown-item href="#" @click.prevent="logout">Sair</b-dropdown-item>
					</b-nav-item-dropdown>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
	</div>
</template>

<script>
import Auth from '@/apis/Auth';
export default {
	methods: {
		logout(){
			Auth.logout().then( () => {
				localStorage.removeItem("token");
				this.$router.push({ name: "login"});
			});
		}
	}
}
</script>

<style>

</style>