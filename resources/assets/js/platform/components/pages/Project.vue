<template>
	<section class="section-single-project">
		<div class="row">
			<div class="col-md-12 col-lg-6">
				<open-doc></open-doc>
				<h1 class="expirience-title mt-5 mb-3 ml-5 exp-tags">{{project.name}}</h1>
				<h4 class="text-grey lighter mb-5 ml-5" v-html="project.main_description"></h4>
				<a :href="project.links[0].body" target="_blank"><p class="exp-tags ml-5">{{project.links[0].body}}</p></a>
				<div class="row justify-content-end">
					<router-link :to="{ name: 'platform-projects'}" tag="a">
						<button class="contact-me py-2 px-2 mb-5">
							<p class="text-uppercase my-0">OTHER PROJECTS</p>
						</button>
					</router-link>
				</div>
				<close-doc></close-doc>
			</div>
			<div class="col-md-12 col-lg-6 mt-5">
				<div class="row">
					<div class="col-md-6">
						<h4 class="exp-tags">About project...</h4>
						<h4 class="text-grey lighter mb-5" v-html="project.embedded_experience"></h4>
					</div>
					<div class="col-md-6">
						<h4 class="exp-tags">Applied features...</h4>
						<h4 class="text-grey lighter mb-5"  v-html="project.secondary_description"></h4>
					</div>
				</div>
				<h4 class="exp-tags">Applied Skills</h4>
				<div class="row mb-3">
					<div class="col-sm-6 col-md-4 col-lg-2" v-for="skill in project.skills">
						<p class="text-grey">{{skill.name}}</p>
					</div>
				</div>
				<img class="project-image" :src="project.image" width="100%">
				<h4 class="exp-tags tag-margin">Tags</h4>
				<div class="row mb-3">
					<div class="col-sm-6 col-md-4 col-lg-3" v-for="tag in project.tags">
						<router-link class="my-2" :to="{ name: 'tag', params: { id: tag.id }}" tag="a">
							<p class="exp-tags">{{tag.name}}</p>
						</router-link>
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
				project: {
					links: [{
						body: ''
					}],
				},

			}
		},
		methods: {

		},
		created() {
			axios.get('/api/projects/' + this.$route.params.id)
				.then(response => {
					this.project = response.data
				})
		}
	}
</script>
