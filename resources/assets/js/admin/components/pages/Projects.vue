<template>
	<div class="card card-body-blog black-color">
		<!-- header with button Create -->
		<div class="card-header w-100">
			<button class="btn btn-success float-right" data-toggle="modal" data-target="#projectModal" @click="createNew()">Create Project</button>
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
			:api-url="'/api/projects?paginate=1&name=' + name"
			:fields="fields"
			:http-fetch="myFetch"
			data-path="data"
			pagination-path=""
			pagination-component="VuetablePagination"
			@vuetable:pagination-data="onPaginationData">
			<template slot="projectImage" slot-scope="props">
					<img :src="props.rowData.image" class="br-50" alt="" width="60">
				</template>
			<template slot="actions" slot-scope="props">
				<div class="table-button-container">
					<button class="btn btn-primary" data-toggle="modal" data-target="#projectModal" @click="viewItem(props.rowData)"><i class="fa fa-pencil  mr-1"></i>Edit</button>
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
	<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ modal_type }} Project</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!-- Name -->
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control br-dark-blue" v-model="form.name" :placeholder="name" id="project_name">
					</div>

					<!-- Main Description -->
					<div class="form-group">
						<label>Main Description</label>
						<vue-editor
						class=" br-dark-blue"
						id="project_main_description"
						v-model.trim="form.main_description"
						useCustomImageHandler
						@imageAdded="handleImageProject"></vue-editor>
					</div>

					<!-- Secondary Description -->
					<div class="form-group">
						<label>Secondary Description</label>
						<vue-editor
						class=" br-dark-blue"
						id="project_secondary_description"
						v-model.trim="form.secondary_description"
						useCustomImageHandler
						@imageAdded="handleImageProject"></vue-editor>
					</div>

					<!-- Embadded Expirience -->
					<div class="form-group">
						<label>Embadded Expirience</label>
						<vue-editor
						class=" br-dark-blue"
						id="project_embedded_experience"
						v-model.trim="form.embedded_experience"
						useCustomImageHandler
						@imageAdded="handleImageProject"></vue-editor>
					</div>
					
					<!-- Category -->
					<div class="row form-group">
						<label class="col-md-12">Categories</label>
						<div class="col-md-12">
							<select class="form-control br-dark-blue" id="project_category" v-model.trim="form.category_id">
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
									<input type="text" class="form-control br-dark-blue" v-model="form.links[index].body" :key="index" id="project_link">
								</div>
							</div>
					</div>

					<!-- Skills -->
					<div class="form-group row mt-3">
						<label class="col-md-12">Skills</label>
						<div class="col-md-12" id="post_tags">
							<v-select class="br-dark-blue white selected-tag br-5" multiple v-model="form.skills" :options="skills" :get-option-label="getLabel" label="name"></v-select>
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
							id="dropzoneProject"
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
					name: '',
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
					skills: [],
					categories: [],
					dropzoneOptions: {
						method: 'POST',
						url: '/api/images/projects',
						headers: {},
						dictDefaultMessage: "<h6 class='m-dropzone__msg-title text-center'>DROP YOUR IMAGE HERE</h6>"
					},
					fields: [
				{
					name: 'name',
					title: 'Title'
				},
				{
					name: '__slot:projectImage',
					title: 'Project Image',
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
		myFetch(apiUrl, httpOptions) {
	      return axios.get(apiUrl, httpOptions)
	    },
		createNew() {
			this.image = false
			this.error = false
			this.modal_type = 'Create'
			this.form = {
				name: '',
				main_description: '',
				secondary_description: '',
				embedded_experience: '',
				category_id: '',
				tags: '',
				links: [{
					body: ''
				}],
				skills: '',
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
				if (this.form. main_description == '') {
					document.getElementById('project_main_description').focus()
				}
				if (this.form.secondary_description == '') {
					document.getElementById('project_secondary_description').focus()
				}
				if (this.form.embedded_experience == '') {
					document.getElementById('project_embedded_experience').focus()
				}
				if(this.form.name == '') {
					document.getElementById('project_name').focus()
				}
				if(this.form.image == null || this.form.image == '') {
					if(this.form.name !== '' && this.form.main_description !== '' && this.form.secondary_description !== '' && this.form.embedded_experience !== '') {
						this.error = true
					}
				}
				if(this.form.name !== '' && this.form.main_description !== '' && this.form.secondary_description !== '' && this.form.embedded_experience !== '' && this.form.image !== null) {
					axios.post('/api/projects', this.form)
					.then(response => {
						$('#projectModal').modal('hide')
						// Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Project was Created',
							'',
							'success',
							);
					})
				}
			} else if(this.modal_type == 'Update') {
				if (this.form.main_description == '') {
					document.getElementById('project_main_description').focus()
				}
				if (this.form.secondary_description == '') {
					document.getElementById('project_secondary_description').focus()
				}
				if (this.form.embedded_experience == '') {
					document.getElementById('project_embedded_experience').focus()
				}
				if(this.form.name == '') {
					document.getElementById('project_name').focus()
				}
				if(this.form.name !== '' && this.form.main_description !== '' && this.form.secondary_description !== '' && this.form.embedded_experience !== '') {
					axios.put('/api/projects/' + this.form.id, this.form)
					.then(response => {
						$('#projectModal').modal('hide')
						Bus.$emit('updateProject')
						this.$refs.vuetable.reload()
						this.$swal('Project was Updated',
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
				text: 'You are trying delete' + ' ' + this.project + ' ' + item.title,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					axios.delete('/api/projects/' + item.id)
					.then(response => {
						this.$refs.vuetable.reload();
						swal('Project' + ' ' + 'was Deleted',
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
		handleImageProject(file, Editor, cursorLocation) {
			var formData = new FormData();
			formData.append('file', file);
			axios({
				url: '/api/images/projects',
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
		axios.get('/api/projects')
			.then(response => {
				this.projects = response.data
		}),
		axios.get('/api/allskills')
			.then(response => {
				this.skills = response.data
			})
	}	
}
</script>