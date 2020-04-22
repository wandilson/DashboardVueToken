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
					<th>Local Acesso</th>
					<th>Dta. Criação</th>
					<th>Dta. Última Utilização</th>
					<th></th>
				</template>

				<template slot-scope="{row}">
					<td class="budget">
						{{row.name}}
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
								<a class="dropdown-item text-danger" href="#" @click.prevent="remove(row.id)">Deletar</a>
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
	import Auth from '@/apis/Auth';
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
				tableData: []
			}
		},
		mounted() {
			this.listTokens()
		},
		methods: {
			listTokens(){
				Auth.tokens()
				.then( response => {
					console.log(response);
					this.tableData = response.data.token
				})
				.catch(error => {
					console.log(error)
				});
			},
			remove(item){
				Auth.removeToken(item)
				.then( response => {
					console.log(response);
				})
				.catch(error => {
					console.log(error)
				});
			}
		}
	}
</script>
<style>
</style>
