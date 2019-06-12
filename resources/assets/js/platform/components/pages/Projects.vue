<template>
	<section class="projects-section">
		<div class="row pt-5 pr-2">
			<div class="col-md-6" v-for="project in projects">

				<div class="row mb-5">
					<div class="col-md-2 col-lg-2">
						<div class="block-skills">
							<div class="row my-3" v-for="skill in project.skills">
								<img :src="skill.image" class="project-skill mx-auto d-block">
							</div>
						</div>
					</div>

					<div class="col-md-10">
						<img :src="project.image" class="img-fluid">
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