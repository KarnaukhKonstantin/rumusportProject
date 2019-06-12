<template>
	<section class="projects-section">
		<div class="row pt-5 pr-2">
			<div class="col-md-6">
					
			</div>
			<div class="col-md-6">
				<div class="row project-simple">
					<div class="col-md-6" v-for="project in projects">
						<img :src="project.image" width="100%">
					</div>
				</div>
			</div>
		</div>
		
	</section>
</template>
<script>
	export default {
		data() {
			return {
				projects: [],
			}
		},
		methods: {

		},
		created() {
			axios.get('/api/projects/without-paginate')
				.then(response => {
					this.projects = response.data
				})
		}	
	}
</script>