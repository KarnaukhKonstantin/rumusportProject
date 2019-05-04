<template>
	<div class="card card-body-blog black-color">
		<!-- header with button Create -->
		<div class="card-header w-100">
			<button class="btn btn-success float-right" data-toggle="modal" data-target="#postModal" @click="createNew()">Create Post</button>
		</div>

		<!-- live search (name) -->
		<div class="card-body">
			<input type="text" class="form-control" v-model="name" placeholder="Name">
		</div>

		<!-- table with posts -->
		<div class="card-body">
			<vuetable
			ref="vuetable"
			class="table-hover"
			:css="css.table"
			:api-url="'/api/posts?paginate=1&name=' + name"
			:fields="fields"
			data-path="data"
			pagination-path=""
			pagination-component="VuetablePagination"
			@vuetable:pagination-data="onPaginationData">
			<template slot="postImage" slot-scope="props">
					<img :src="props.rowData.image" class="br-50" alt="" width="60">
				</template>
			<template slot="actions" slot-scope="props">
				<div class="table-button-container">
					<button class="btn btn-primary" data-toggle="modal" data-target="#postModal" @click="viewItem(props.rowData)"><i class="fa fa-pencil  mr-1"></i>Edit</button>
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
	<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ modal_type }} Post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!-- Name -->
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control br-dark-blue" v-model="form.name" :placeholder="name" id="post_name">
					</div>

					<!-- Description -->
					<div class="form-group">
						<label>Description</label>
						<vue-editor
						class=" br-dark-blue"
						id="category_description"
						v-model.trim="form.description"
						useCustomImageHandler
						@imageAdded="handleImageCategory"></vue-editor>
					</div>

					<!-- Image -->
					<div class="form-group row">
						<label class="col-12">Image</label>
						<div class="col-12" v-if="image == false">
							<img class="mb-4 d-block mx-auto br-50" width="200" :src="form.image" @click="image = true">
						</div>
						<div class="col-12">
							<p class="mb-3 bg-danger text-center text-white py-3" v-if="error">
								Please, upload Image!!!
							</p>
							<vue-dropzone
							v-if="image == true || form.image == '' || form.image == null"
							ref="myVueDropzone"
							class="br-dark-blue"
							id="dropzoneCategory"
							:options="dropzoneOptions"
							v-on:vdropzone-success="showSuccess"></vue-dropzone>
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
					image: false,
					modal_type: 'Create',
					form: {
						image: null
					},
					categories: [],
					dropzoneOptions: {
						method: 'POST',
						url: '/api/images/categories',
						headers: {},
						dictDefaultMessage: "<h6 class='m-dropzone__msg-title text-center'>DROP YOUR IMAGE HERE</h6>"
					},
					fields: [
				{
					name: 'name',
					title: 'Name'
				},
				{
					name: '__slot:postImage',
					title: 'Category Image',
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
			this.image = false
			this.error = false
			this.modal_type = 'Create'
			this.form = {
				name: '',
				description: '',
				image: null
			}
		},
		viewItem(item) {
			this.modal_type = 'Update'
			this.form = item
		},
		save() {
			if(this.modal_type == 'Create') {
				if (this.form.description == '') {
					document.getElementById('category_description').focus()
				}
				if(this.form.name == '') {
					document.getElementById('post_name').focus()
				}
				if(this.form.image == null || this.form.image == '') {
					if(this.form.name !== '' && this.form.description !== '') {
						this.error = true
					}
				}
				if(this.form.name !== '' && this.form.description !== '' && this.form.image !== null) {
					axios.post('/api/categories', this.form)
					.then(response => {
						$('#postModal').modal('hide')
						// Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Category was Created',
							'',
							'success',
							);
					})
				}
			} else if(this.modal_type == 'Update') {
				if (this.form.description == '') {
					document.getElementById('category_description').focus()
				}
				if(this.form.name == '') {
					document.getElementById('post_name').focus()
				}
				if(this.form.name !== '' && this.form.description !== '') {
					axios.put('/api/categories/' + this.form.id, this.form)
					.then(response => {
						$('#postModal').modal('hide')
						Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Category was Updated',
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
				text: 'You are trying delete' + ' ' + this.category + ' ' + item.name,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					axios.delete('/api/categories/' + item.id)
					.then(response => {
						this.$refs.vuetable.reload();
						swal('Category' + ' ' + 'was Deleted',
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
		showSuccess(response) {
			let resp = JSON.parse(response.xhr.response)
			console.log(response)
			this.form.image = resp.image_url
			this.image = false
			this.error = false
			this.$refs.myVueDropzone.removeAllFiles()
		},
		handleImageCategory(file, Editor, cursorLocation) {
			var formData = new FormData();
			formData.append('file', file);
			axios({
				url: '/api/images/categories',
				method: 'POST',
				data: formData
			})
			.then((result) => {
				let url = result.data.image_url
				Editor.insertEmbed(cursorLocation, 'image', url);
			})
			.catch((err) => {
			})
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
		axios.get('/api/categories')
		.then(response => {
			this.categories = response.data
		})
	}	
}
</script>