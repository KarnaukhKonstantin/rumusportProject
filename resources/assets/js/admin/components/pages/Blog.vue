<template>
	<div class="card card-body-blog black-color">
		<!-- header with button Create -->
		<div class="card-header w-100">
			<button class="btn btn-success float-right" data-toggle="modal" data-target="#postModal" @click="createNew()">Create Post</button>
		</div>

		<!-- live search (name) -->
		<div class="card-body">
			<input type="text" class="form-control" v-model="title" placeholder="Title">
		</div>

		<!-- table with posts -->
		<div class="card-body">
			<vuetable
			ref="vuetable"
			class="table-hover"
			:css="css.table"
			:api-url="'/api/posts?paginate=1&title=' + title"
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
						<label>Title</label>
						<input type="text" class="form-control br-dark-blue" v-model="form.title" :placeholder="title" id="post_name">
					</div>

					<!-- Description -->
					<div class="form-group">
						<label>Description</label>
						<vue-editor
						class=" br-dark-blue"
						id="post_description"
						v-model.trim="form.description"
						useCustomImageHandler
						@imageAdded="handleImageCategory"></vue-editor>
					</div>

					<!-- Short Description -->
					<div class="form-group">
						<label>Short Description</label>
						<textarea type="text" class="form-control br-dark-blue" v-model="form.short_description" :placeholder="short_description" id="post_short_description"></textarea>
					</div>
					
					<!-- Category -->
					<div class="row form-group">
						<label class="col-md-12">Categories</label>
						<div class="col-md-12">
							<select class="form-control br-dark-blue" id="post_category" v-model.trim="form.category_id">
								<option :value="category.id" v-for="category in categories">{{ category.name }}</option> 
							</select>
						</div>
					</div>

					<!-- Tags -->
					<div class="form-group row mt-3">
						<label class="col-md-12">Tags</label>
						<div class="col-md-12" id="post_tags">
							<v-select class="br-dark-blue white selected-tag br-5" multiple v-model="form.tags" :options="tags" :get-option-label="getLabel" label="name"></v-select>
						</div>
					</div>

					<!-- Links -->
					<div class="form-group">
						<label>Links</label>
							<div class="row justify-content-center align-items-center mb-3" v-for="(link, index) in form.links" :id="'link-' + index" :key="index" >
								<div class="col-md-12">
									<input type="text" class="form-control br-dark-blue" v-model="form.links[index].body" :key="index" id="post_link">
								</div>
							</div>
					</div>
					<div class="col-12 mt-3">
						<button class="btn btn-primary d-block mx-auto mb-2" @click="addNewForm()">Add Link</button>
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
	
	import vSelect from 'vue-select'
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
			vSelect,
			VueEditor,
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo,
			PaginationMixin,
			vueDropzone: vue2Dropzone
		},
		props: ['categories_list', 'tags_list'],
		data() {
				return {
					title: '',
					short_description: '',
					link: '',
					error: false,
					image: false,
					modal_type: 'Create',
					form: {
						image: null,
						links: []
					},
					tags: [],
					categories: [],
					dropzoneOptions: {
						method: 'POST',
						url: '/api/images/posts',
						headers: {},
						dictDefaultMessage: "<h6 class='m-dropzone__msg-title text-center'>DROP YOUR IMAGE HERE</h6>"
					},
					fields: [
				{
					name: 'title',
					title: 'Title'
				},
				{
					name: '__slot:postImage',
					title: 'Post Image',
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
				title: '',
				description: '',
				short_description: '',
				category_id: '',
				tags: '',
				links: [{
					body: ''
				}],
				image: null
			}
		},
		addNewForm() {
			this.form.links.push({
				body: '',
				delete: false
			})
		},
		viewItem(item) {
			this.modal_type = 'Update'
			this.form = item
		},
		save() {
			if(this.modal_type == 'Create') {
				if (this.form.description == '') {
					document.getElementById('post_description').focus()
				}
				if (this.form.short_description == '') {
					document.getElementById('post_short_description').focus()
				}
				if(this.form.title == '') {
					document.getElementById('post_name').focus()
				}
				if(this.form.image == null || this.form.image == '') {
					if(this.form.title !== '' && this.form.description !== '') {
						this.error = true
					}
				}
				if(this.form.title !== '' && this.form.description !== '' && this.form.short_description !== '' && this.form.image !== null) {
					axios.post('/api/posts', this.form)
					.then(response => {
						$('#postModal').modal('hide')
						// Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Post was Created',
							'',
							'success',
							);
					})
				}
			} else if(this.modal_type == 'Update') {
				if (this.form.description == '') {
					document.getElementById('post_description').focus()
				}
				if (this.form.short_description == '') {
					document.getElementById('post_short_description').focus()
				}
				if(this.form.title == '') {
					document.getElementById('post_name').focus()
				}
				if(this.form.title !== '' && this.form.description !== '' && this.form.short_description !== '') {
					axios.put('/api/posts/' + this.form.id, this.form)
					.then(response => {
						$('#postModal').modal('hide')
						Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Post was Updated',
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
				text: 'You are trying delete' + ' ' + this.post + ' ' + item.title,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					axios.delete('/api/posts/' + item.id)
					.then(response => {
						this.$refs.vuetable.reload();
						swal('Post' + ' ' + 'was Deleted',
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
				url: '/api/images/posts',
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
		},
		getLabel(option) {
			return option.name
		},
	},
	created() {
		this.tags = JSON.parse(this.tags_list)
		this.categories = JSON.parse(this.categories_list)
		axios.get('/api/posts')
		.then(response => {
			this.posts = response.data
		})
	}	
}
</script>