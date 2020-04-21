<template>
	<div>
		<base-header class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
					style="min-height: 600px; background-image: url(img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
			<!-- Mask -->
			<span class="mask bg-gradient-success opacity-8"></span>
			<!-- Header container -->
			<div class="container-fluid d-flex align-items-center">
				<div class="row">
					<div class="col-lg-7 col-md-10">
						<h1 class="display-2 text-white">Olá Wandilson</h1>
						<p class="text-white mt-0 mb-5">"Perder tempo em aprender coisas que não interessam, priva-nos de descobrir coisas interessantes."</p>
					</div>
				</div>
			</div>
		</base-header>



		<div class="container-fluid mt--7">
			<div class="row">
				<div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">

					<div class="card card-profile shadow">
						<div class="row justify-content-center">
							<div class="col-lg-3 order-lg-2">
								<div class="card-profile-image">
									<a href="#">
										<img src="img/theme/team-4-800x800.jpg" class="rounded-circle">
									</a>
								</div>
							</div>
						</div>
						<div class="card-body pt-0 pt-md-4 mt-8">
							
							<div class="text-center">
								<h3>
									Wandilson Oliveira<span class="font-weight-light">, 34</span>
								</h3>
								<div class="h5 font-weight-300">
									<i class="ni location_pin mr-2"></i>Sinop/MT
								</div>
								<hr class="my-4" />
								<p>"Perder tempo em aprender coisas que não interessam, priva-nos de descobrir coisas interessantes."</p>
							</div>
						</div>
					</div>
				</div>


				<div class="col-xl-8 order-xl-1">
					<card shadow type="secondary">
						<div slot="header" class="bg-white border-0">
							<div class="row align-items-center">
								<div class="col-8">
									<h3 class="mb-0">Meus Dados</h3>
								</div>
							</div>
						</div>
						<template>
							<form @submit.prevent>
								<h6 class="heading-small text-muted mb-4">Informações Pessoais</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-lg-3">
											<base-input alternative=""
														label="CPF"
														placeholder="Seu CPF"
														input-classes="form-control-alternative"
														v-model="model.name"
											/>
										</div>
										<div class="col-lg-4">
											<base-input alternative=""
														label="Celular"
														placeholder="(00) 0 0000-0000"
														input-classes="form-control-alternative"
														v-model="model.cell"
											/>
										</div>
										<div class="col-lg-5">
											<base-input alternative=""
														label="E-mail"
														placeholder="Infome um e-mail válido"
														input-classes="form-control-alternative"
														v-model="model.email"
											/>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<base-input alternative=""
														label="Primeiro nome"
														placeholder="Qual seu primeiro nome"
														input-classes="form-control-alternative"
														v-model="model.firstName"
											/>
										</div>
										<div class="col-lg-4">
											<base-input alternative=""
														label="Último nome"
														placeholder="Seu ultimo nome"
														input-classes="form-control-alternative"
														v-model="model.lastName"
											/>
										</div>
									</div>
								</div>


								<hr class="my-4" />


								<!-- Address -->
								<h6 class="heading-small text-muted mb-4">Endereço</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-md-12">
											<base-input alternative=""
														label="Endereço"
														placeholder="Nome da Rua, bairro, numero"
														input-classes="form-control-alternative"
														v-model="model.address"
											/>
										</div>
									</div>
									<div class="row">
										
										<div class="col-lg-2">
											<label class="form-control-label">
												UF
											</label>
											<div class="has-label">
												<select class="form-control">
													<option>MT</option>
													<option>SP</option>
													<option>RJ</option>
													<option>TO</option>
													<option>DF</option>
												</select>
											</div>
										</div>

										<div class="col-lg-3">
											<label class="form-control-label">
												Cidade
											</label>
											<div class="has-label">
												<select class="form-control">
													<option>Sinop</option>
													<option>Rio Janeiro</option>
													<option>São Paulo</option>
													<option>Cuiabá</option>
													<option>Sorriso</option>
												</select>
											</div>
										</div>

										<div class="col-lg-4">
											<base-input alternative=""
														label="Qual seu CEP"
														input-classes="form-control-alternative"
														v-model="model.zipCode"
											/>
										</div>
									</div>
								</div>
								<hr class="my-4" />

								<!-- Description -->
								<h6 class="heading-small text-muted mb-4">+ Informações</h6>
								<div class="pl-lg-4">
									<div class="form-group">
										<base-input alternative="">
											<textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">Insira aqui informações adicionais...</textarea>
										</base-input>
									</div>
								</div>
								<button type="button" class="btn base-button btn-primary float-right"><!---->Salvar Alteração</button>
							
							</form>
						</template>
					</card>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
  export default {
	name: 'user-profile',
	data() {
	  return {
		model: {
		  username: '',
		  email: '',
		  firstName: '',
		  lastName: '',
		  address: '',
		  city: '',
		  country: '',
		  zipCode: '',
		  about: '',
		  foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn']
		}
	  }
	},
  };
</script>
<style></style>
