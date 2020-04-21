<template>
		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-7">
				<div class="card bg-secondary shadow border-0">
					<div class="card-body px-lg-5 py-lg-5">
						<div class="text-center text-muted mb-4">
							<small>Vamos fazer login? Informe seus dados corretamente!</small>
						</div>
						<form role="form">
							<base-input class="input-group-alternative mb-3"
										placeholder="Cpf"
										addon-left-icon="ni ni-lock-circle-open"
										v-model="model.cpf">
							</base-input>

							<base-input class="input-group-alternative"
										placeholder="Password"
										type="password"
										addon-left-icon="ni ni-lock-circle-open"
										v-model="model.password">
							</base-input>

							<base-checkbox class="custom-control-alternative">
								<span class="text-muted">Manter conectado</span>
							</base-checkbox>
							<div class="text-center">
								<base-button type="primary" class="my-4">Sign in</base-button>
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
export default {
	name: 'login',
	data() {
		return {
			model: {
				cpf: '',
				password: ''
			}
		}
	}
}
</script>
<style>
</style>
