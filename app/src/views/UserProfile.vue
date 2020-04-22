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
						<h1 class="display-2 text-white">Olá {{form.name_first}}</h1>
						<p class="text-white mt-0 mb-5">{{form.information}}</p>
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
									{{form.name_first}}<span class="font-weight-light">, {{birth}}</span>
								</h3>
								<div class="h5 font-weight-300">
									<i class="ni location_pin mr-2"></i>Sinop/MT
								</div>
								<hr class="my-4" />
								<p>{{form.information}}</p>
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

							<base-alert v-show="statsSuccess" type="success" dismissible>
								<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
								<span class="alert-inner--text"><strong> Olá!</strong> Registro modificado com sucesso!</span>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</base-alert>
							<form @submit.prevent>
								<h6 class="heading-small text-muted mb-4">Informações Pessoais</h6>
								<div class="pl-lg-4">
									<div class="row">
										<div class="col-lg-3">
											<base-input alternative=""
														label="CPF"
														placeholder="Seu CPF"
														input-classes="form-control-alternative"
														v-model="form.cpf"
														v-mask="'###.###.###-##'"
											/>
										</div>
										<div class="col-lg-4">
											<base-input alternative=""
														label="Celular"
														placeholder="(00) 0 0000-0000"
														input-classes="form-control-alternative"
														v-model="form.cell_phone"
														v-mask="'(##) # ####-####'"
											/>
										</div>
										<div class="col-lg-5">
											<base-input alternative=""
														label="E-mail"
														placeholder="Infome um e-mail válido"
														input-classes="form-control-alternative"
														v-model="form.email"
											/>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4">
											<base-input alternative=""
														label="Primeiro nome"
														placeholder="Qual seu primeiro nome"
														input-classes="form-control-alternative"
														v-model="form.name_first"
											/>
										</div>
										<div class="col-lg-4">
											<base-input alternative=""
														label="Último nome"
														placeholder="Seu ultimo nome"
														input-classes="form-control-alternative"
														v-model="form.name_last"
											/>
										</div>
										
										<div class="col-lg-4">
											<base-input alternative=""
														label="Data de Nascimento"
														type="date"
														input-classes="form-control-alternative"
														v-model="form.birth"
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
														v-model="form.address"
											/>
										</div>
									</div>
									<div class="row">
										
										<div class="col-lg-2">
											<label class="form-control-label">
												UF
											</label>
											<div class="has-label">
												<select class="form-control" v-model="form.state_id" @change='getCity()'>
													<option disabled>UF</option>
													<option v-for='data in listState' :value='data.id' :key='data.id' :selected="form.state_id == data.id">{{ data.name }}</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-3">
											<label class="form-control-label">
												Cidade
											</label>
											<div class="has-label">
												<select class="form-control" v-model="form.city_id">
													<option disabled>Cidade </option>
													<option v-for='data in listCities' :value='data.id' :key='data.id' :selected="form.city_id == data.id">{{ data.name }}</option>
												</select>
											</div>
										</div>

										<div class="col-lg-4">
											<base-input alternative=""
														label="Qual seu CEP"
														input-classes="form-control-alternative"
														v-model="form.zip_code"
														v-mask="'#####-###'"
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
											<textarea v-model="form.information" rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">Insira aqui informações adicionais...</textarea>
										</base-input>
									</div>
								</div>
								<button type="button" class="btn base-button btn-primary float-right" @click="update"><!---->Salvar Alteração</button>
							
							</form>
						</template>
					</card>
				</div>
			</div>
		</div>
	</div>
</template>
<script>

	import moment from 'moment'
	import 'moment/locale/pt-br';

	import Auth from '@/apis/Auth';
	export default {
		name: 'user-profile',
		data() {
			return {
				form: {},
				birth: null,
				listState: {},
				listCities: {},
				statsSuccess: false
			}
		},
		mounted() {
			this.profile()
			this.state()
		},
		methods: {
			profile(){
				Auth.loadUser()
				.then( response => {
					this.form = response.data
					this.birth = moment().diff(response.data.birth, 'years')
					this.getCity()
					console.log(response)
				})
				.catch(error => {
					console.log(error)
				});
			},
			update(){
				Auth.updateProfile(this.form)
				.then( response => {
					this.profile()
					this.statsSuccess = true
				})
				.catch(error => {
					console.log(error.response)
				});
			},
			state(){
				Auth.uf()
				.then( response => {
					this.listState = response.data
				})
				.catch(error => {
					console.log(error)
				});
			},
			getCity(){
				Auth.city(this.form.state_id)
				.then( response => {
					this.listCities = response.data
				})
				.catch(error => {
					console.log(error)
				});
			}
		}
	};
</script>
<style></style>
