<template>
	<div class="card card-body-blog black-color">
		<!-- header with button Create -->
		<div class="card-header w-100">
			<button class="btn btn-success float-right" data-toggle="modal" data-target="#aboutModal" @click="createNew()">Create Info About Me</button>
		</div>

		<!-- table with categories -->
		<div class="card-body">
			<vuetable
			ref="vuetable"
			class="table-hover"
			:css="css.table"
			:api-url="'/api/about-me?paginate=1'"
			:fields="fields"
			data-path="data"
			pagination-path=""
			pagination-component="VuetablePagination"
			@vuetable:pagination-data="onPaginationData">
			<template slot="categoryImage" slot-scope="props">
					<img :src="props.rowData.image" class="br-50" alt="" width="60">
				</template>
			<template slot="actions" slot-scope="props">
				<div class="table-button-container">
					<button class="btn btn-primary" data-toggle="modal" data-target="#aboutModal" @click="viewItem(props.rowData)"><i class="fa fa-pencil  mr-1"></i>Edit</button>
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
	<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ modal_type }} Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!-- Name -->
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control br-dark-blue" v-model="form.name" :placeholder="name" id="about_name">
					</div>

					<!-- Description -->
					<div class="form-group">
						<label>Description</label>
						<vue-editor
						class=" br-dark-blue"
						id="about_description"
						v-model.trim="form.description"
						useCustomImageHandler
						@imageAdded="handleImageAbout"></vue-editor>
					</div>

					<!-- Work Info -->
					<div class="form-group">
						<label>Work Info</label>
						<vue-editor
						class=" br-dark-blue"
						id="about_work_info"
						v-model.trim="form.work_info"
						useCustomImageHandler
						@imageAdded="handleImageAbout"></vue-editor>
					</div>

					<!-- Expirience Info -->
					<div class="form-group">
						<label>Expirience Info</label>
						<vue-editor
						class=" br-dark-blue"
						id="about_exp_info"
						v-model.trim="form.exp_info"
						useCustomImageHandler
						@imageAdded="handleImageAbout"></vue-editor>
					</div>

					<!-- Personal Info -->
					<div class="form-group">
						<label>Personal Info</label>
						<vue-editor
						class=" br-dark-blue"
						id="about_personal_info"
						v-model.trim="form.personal_info"
						useCustomImageHandler
						@imageAdded="handleImageAbout"></vue-editor>
					</div>

					<!-- Hobbies Info -->
					<div class="form-group">
						<label>Hobbies Info</label>
						<vue-editor
						class=" br-dark-blue"
						id="about_hobbies_info"
						v-model.trim="form.hobbies_info"
						useCustomImageHandler
						@imageAdded="handleImageAbout"></vue-editor>
					</div>

					<!-- Skills -->
					<div class="form-group row mt-3">
						<label class="col-md-12">Skills</label>
						<div class="col-md-12" id="post_tags">
							<v-select class="br-dark-blue white selected-tag br-5" multiple v-model="form.skills" :options="skills" :get-option-label="getLabel" label="name"></v-select>
						</div>
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
							id="dropzoneAbout"
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
		props: ['categories_list'],
		data() {
				return {
					name: '',
					skills: [],
					error: false,
					image: false,
					modal_type: 'Create',
					form: {
						image: null
					},
					about: {},
					dropzoneOptions: {
						method: 'POST',
						url: '/api/images/about',
						headers: {},
						dictDefaultMessage: "<h6 class='m-dropzone__msg-title text-center'>DROP YOUR IMAGE HERE</h6>"
					},
					fields: [
				{
					name: 'name',
					title: 'Name'
				},
				{
					name: 'description',
					title: 'Description',
					titleClass: 'mw-500',
					dataClass: 'mw-500'
				},
				{
					name: '__slot:categoryImage',
					title: 'Info Image',
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
				work_info: '',
				exp_info: '',
				personal_info: '',
				hobbies_info: '',
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
					document.getElementById('about_description').focus()
				}
				if(this.form.name == '') {
					document.getElementById('about_name').focus()
				}
				if (this.form.work_info == '') {
					document.getElementById('about_work_info').focus()
				}
				if (this.form.exp_info == '') {
					document.getElementById('about_exp_info').focus()
				}
				if (this.form.personal_info == '') {
					document.getElementById('about_personal_info').focus()
				}
				if (this.form.hobbies_info == '') {
					document.getElementById('about_hobbies_info').focus()
				}
				if(this.form.image == null || this.form.image == '') {
					if(this.form.name !== '' && this.form.description !== '') {
						this.error = true
					}
				}
				if(this.form.name !== '' && this.form.description !== '' && this.form.image !== null) {
					axios.post('/api/about', this.form)
					.then(response => {
						$('#aboutModal').modal('hide')
						// Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Info was Created',
							'',
							'success',
							);
					})
				}
			} else if(this.modal_type == 'Update') {
				if (this.form.description == '') {
					document.getElementById('about_description').focus()
				}
				if(this.form.name == '') {
					document.getElementById('about_name').focus()
				}
				if (this.form.work_info == '') {
					document.getElementById('about_work_info').focus()
				}
				if (this.form.exp_info == '') {
					document.getElementById('about_exp_info').focus()
				}
				if (this.form.personal_info == '') {
					document.getElementById('about_personal_info').focus()
				}
				if (this.form.hobbies_info == '') {
					document.getElementById('about_hobbies_info').focus()
				}
				if(this.form.name !== '' && this.form.description !== '') {
					axios.put('/api/about/' + this.form.id, this.form)
					.then(response => {
						$('#aboutModal').modal('hide')
						Bus.$emit('updateCategory')
						this.$refs.vuetable.reload()
						this.$swal('Info was Updated',
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
				text: 'You are trying delete' + ' ' + this.about + ' ' + item.name,
				icon: 'warning',
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					axios.delete('/api/about/' + item.id)
					.then(response => {
						this.$refs.vuetable.reload();
						swal('Info' + ' ' + 'was Deleted',
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
		handleImageAbout(file, Editor, cursorLocation) {
			var formData = new FormData();
			formData.append('file', file);
			axios({
				url: '/api/images/about',
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
		axios.get('/api/allskills')
		.then(response => {
			this.skills = response.data
		})
	}	
}
</script>