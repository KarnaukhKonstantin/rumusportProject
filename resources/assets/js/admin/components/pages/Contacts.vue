<template>
	<div class="card card-body-blog black-color">

		<!-- table with contacts -->
		<div class="card-body">
			<vuetable
			ref="vuetable"
			class="table-hover"
			:css="css.table"
			:api-url="'/api/messages?paginate=1'"
			:fields="fields"
			data-path="data"
			pagination-path=""
			pagination-component="VuetablePagination"
			@vuetable:pagination-data="onPaginationData">
			<template slot="actions" slot-scope="props">
				<div class="table-button-container">
					<button class="btn btn-primary" data-toggle="modal" data-target="#messageModal" @click="viewItem(props.rowData)"><i class="fa fa-eye"></i></button>
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
	<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="d-flex justify-content-between">
								<p class="m-0 text-left float-between-left"><b>From:</b></p>
								<p class="m-0 pt-0 text-right float-between-right">{{message.name}}</p>
							</div>
							<div class="d-flex justify-content-between">
								<p class="m-0 text-left float-between-left"><b>Email:</b></p>
								<p class="m-0 pt-0 text-right float-between-right">{{message.email}}</p>
							</div>
						</div>
						<div class="col-md-8">
							<p class="m-0 text-right"><b>Subject:</b></p>
							<p class="m-0 pt-0 text-right">{{message.subject}}</p>
							<p class="mt-5 text-right"><b>Message:</b></p>
							<p class="m-0 pt-0 text-right">{{message.message}}</p>
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>

	import { VueEditor, Quill } from 'vue2-editor'
	import Vuetable from 'vuetable-2/src/components/Vuetable.vue'
	import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
	import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
	import PaginationMixin from 'vuetable-2/src/components/VuetablePaginationMixin.vue'
	import vue2Dropzone from 'vue2-dropzone'

	var AlignStyle = Quill.import('attributors/style/align')

	Quill.register(AlignStyle, true);


	export default {
		components: {
			VueEditor,
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo,
			PaginationMixin,
			vueDropzone: vue2Dropzone
		},
		props: ['categories_list'],
		data() {
				return {
					name: '',
					error: false,

					messages: [],
					message: {},
					fields: [
				{
					name: 'name',
					title: 'Name'
				},
				{
					name: 'email',
					title: 'Email'
				},
				{
					name: 'subject',
					title: 'Subject'
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
		viewItem(item) {
			this.message = item
		},
		deleteItem(item) {
			this.$swal({
				title: 'Are you Sure?',
				text: 'You are trying delete' + ' ' + this.message + ' ' + item.name,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					axios.delete('/api/messages/' + item.id)
					.then(response => {
						this.$refs.vuetable.reload();
						swal('Message' + ' ' + 'was Deleted',
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
		// this.categories = JSON.parse(this.categories_list)
		axios.get('/api/messages')
		.then(response => {
			this.messages = response.data
		})
	}	
}
</script>