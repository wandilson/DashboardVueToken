<template>
<div>
	<div class="card shadow" :class="type === 'dark' ? 'bg-default': ''">
		<div class="card-header border-0" :class="type === 'dark' ? 'bg-transparent': ''">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="mb-0" :class="type === 'dark' ? 'text-white': ''">
						{{title}}
					</h3>
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<base-table class="table align-items-center table-flush"
						:class="type === 'dark' ? 'table-dark': ''"
						:thead-classes="type === 'dark' ? 'thead-dark': 'thead-light'"
						tbody-classes="list"
						:data="tableData">

				<template slot="columns">
					<th>Usuário</th>
					<th>Local Acesso</th>
					<th>Token</th>
					<th>Dta. Criação</th>
					<th>Dta. Última Utilização</th>
					<th></th>
				</template>

				<template slot-scope="{row}">

					<th scope="row">
						<div class="media align-items-center">
							<div class="media-body">
								<span class="name mb-0 text-sm">{{row.user}}</span>
							</div>
						</div>
					</th>
					<td class="budget">
						{{row.name}}
					</td>
					<td class="budget">
						{{row.token}}
					</td>
					<td>
						{{row.created_at}}
					</td>
					<td>
						{{ row.last_used_at }}
					</td>


					<td class="text-right">
						<base-dropdown style="cursor: pointer" class="dropdown" position="right">
							<a slot="title" class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-ellipsis-v"></i>
							</a>

							<template>
								<a class="dropdown-item text-danger" href="#" @click.prevent="remove">Deletar</a>
							</template>
						</base-dropdown>
					</td>

				</template>

			</base-table>
		</div>
	</div>

</div>
</template>
<script>
  export default {
	name: 'projects-table',
	props: {
	  type: {
		type: String
	  },
	  title: String
	},
	data() {
	  return {
		tableData: [
		  {
			id: 1,
			user: 'wandilson',
			name: 'Browser',
			token: '4252bc6879488e2192b0f5c0305004023e1fcc5bdd2dee51204d483e9c4ed55b',
			created_at: '2020-04-10 08:10:45',
			last_used_at: '2020-04-20 08:10:45'
		  },
		  {
			id: 1,
			user: 'Danielle',
			name: 'Browser',
			token: '1236cf2580c3d27f21bec57847d6d8e37d1e0096f324259fc6b9952947e651da',
			created_at: '2020-03-20 08:10:45',
			last_used_at: '2020-04-20 08:10:45'
		  }
		]
	  }
	},	
	methods: {
		remove(){
			console.log('remover token')
		}
	}
  }
</script>
<style>
</style>
