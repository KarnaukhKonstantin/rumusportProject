<template>
	<div class="card card-body-blog black-color">
		<!-- header with button Create -->
		<div class="card-header w-100">
			<button class="btn btn-success float-right" data-toggle="modal" data-target="#nodelineModal" @click="createNew()">Create Node Line</button>
		</div>

		<!-- live search (name) -->
		<div class="card-body">
			<input type="text" class="form-control" v-model="name" placeholder="Name">
		</div>

		<!-- table with tags -->
		<div class="card-body">
			<vuetable
			ref="vuetable"
			class="table-hover"
			:css="css.table"
			:api-url="'/api/all-graphs?paginate=1'"
			:fields="fields"
			data-path="data"
			pagination-path=""
			pagination-component="VuetablePagination"
			@vuetable:pagination-data="onPaginationData">

			<template slot="actions" slot-scope="props">
				<div class="table-button-container">
					<button class="btn btn-primary" data-toggle="modal" data-target="#nodelineModal" @click="viewItem(props.rowData)"><i class="fa fa-pencil  mr-1"></i>Edit</button>
					<button class="btn btn-danger text-white" @click="deleteItem(props.rowData)"><i class="fa fa-trash-o  mr-1"></i>Delete</button>
				</div>
			</template>
		</vuetable>
		<div class="vuetable-pagination ui basic segment grid">
			<vuetable-pagination ref="pagination"
			@vuetable-pagination:change-page="onChangePage"
			:css="css.pagination"
			:icons="css.icons"
			></vuetable-pagination>
		</div>
	</div>

	<!-- Create Modal -->
	<div class="modal fade" id="nodelineModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ modal_type }} Tag</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!-- Node 1 -->
					<div class="row form-group">
						<label class="col-md-12">Node 1</label>
						<div class="col-md-12">
							<select class="form-control br-dark-blue" id="sid" v-model.trim="form.sid">
								<option :value="node.id" v-for="node in nodes">{{ node.name }}</option> 
							</select>
						</div>
					</div>
					
					<!-- Node 2 -->
					<div class="row form-group">
						<label class="col-md-12">Node 1</label>
						<div class="col-md-12">
							<select class="form-control br-dark-blue" id="tid" v-model.trim="form.tid">
								<option :value="node.id" v-for="node in nodes">{{ node.name }}</option> 
							</select>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn" :class="{ 'btn-success': modal_type == 'Update', 'bg-dark-orange': modal_type == 'Create'}" @click="save()">{{ modal_type }}</button>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	
	import vSelect from 'vue-select'
	import Vuetable from 'vuetable-2/src/components/Vuetable.vue'
	import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
	import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
	import PaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin.vue'

	export default {
		components: {
			vSelect,
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo,
			PaginationMixin,
		},
		props: ['categories_list', 'tags_list'],
		data() {
				return {
					name: '',
					error: false,
					image: false,
					modal_type: 'Create',
					form: {},
					nodes: [],
					categories: [],

					fields: [
				{
					name: 'sid',
					title: 'Node id 1'
				},
				{
					name: 'tid',
					title: 'Node id 2'
				},
				{
					name: '__slot:actions',
					title: 'Actions',
					titleClass: 'text-right',
					dataClass: 'text-right'
				},
				],
				css: {
					table: {
						tableClass: 'vuetable ui blue selectable celled stackable attached table',
						ascendingIcon: 'glyphicon glyphicon-chevron-up',
						descendingIcon: 'glyphicon glyphicon-chevron-down'
					},
					pagination: {
						infoClass: 'pull-left',
						wrapperClass: 'vuetable-pagination text-center',
						activeClass: 'btn-primary btn text-black',
						disabledClass: 'disabled',
						pageClass: 'btn btn-border',
						linkClass: 'btn btn-border',
						icons: {
							first: '',
							prev: '',
							next: '',
							last: '',
						}
					}
				},
			}
		},
	methods: {
		createNew() {
			this.error = false
			this.modal_type = 'Create'
			this.form = {
				sid: '',
				tid: ''
			}
		},
		viewItem(item) {
			this.modal_type = 'Update'
			this.form = item
		},
		save() {
			if(this.modal_type == 'Create') {
				if(this.form.sid == '') {
					document.getElementById('sid').focus()
				}
				if(this.form.tid == '') {
					document.getElementById('tid').focus()
				}
				if(this.form.sid !== '' && this.form.tid !== '') {
					axios.post('/api/add-graph-line', this.form)
					.then(response => {
						$('#nodelineModal').modal('hide')
						// Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Node Line was Created',
							'',
							'success',
							);
					})
				}
			} else if(this.modal_type == 'Update') {
				if(this.form.sid == '') {
					document.getElementById('sid').focus()
				}
				if(this.form.tid == '') {
					document.getElementById('tid').focus()
				}
				if(this.form.sid !== '' && this.form.tid !== '') {
					axios.put('/api/update-graph-line/' + this.form.id, this.form)
					.then(response => {
						$('#nodelineModal').modal('hide')
						// Bus.$emit('updateTag')
						this.$refs.vuetable.reload()
						this.$swal('Node Line was Updated',
							'',
							'success',
							);
					})
				}
			}
		},
		deleteItem(item) {
			this.$swal({
				title: 'Are you Sure?',
				text: 'You are trying delete' + ' ' + this.node + ' ' + item.name,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					axios.delete('/api/delete-graph-line/' + item.id)
					.then(response => {
						this.$refs.vuetable.reload();
						swal('Node Line' + ' ' + 'was Deleted',
							'',
							'success',
							);
					})
					.catch(error => {
						this.$swal('Error',
							'',
							'error',
							);
					})
				} else {
					swal('Delete was declined');
				}
			});
		},
		onPaginationData(paginationData) {
			this.$refs.pagination.setPaginationData(paginationData);
		},
		onChangePage(page) {
			this.$refs.vuetable.changePage(page);
		}
	},
	created() {
		this.categories = JSON.parse(this.categories_list)
		axios.get('/api/all-nodes')
		.then(response => {
			this.nodes = response.data
		})
	}	
}
</script>