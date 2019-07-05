<template>
	<section class="text-grey section-single-tag">
		<div class="row">
			<div class="col-md-12 col-lg-2 mt-5 block-category pr-4">
				<h1 class="text-right exp-tags">{{tag.name}}</h1>
			</div>
			<div class="col-md-12 col-lg-10 pl-4">
				
				<h3 class="my-5 exp-tags" v-if="projects.length > 0">Projects</h3>
				<div class="row mb-4 pb-2 align-items-end" v-if="projects.length > 0" v-for="project in projects">
					<div class="col-md-2">
						<router-link class="my-2" :to="{ name: 'project', params: { id: project.id }}" tag="a">
							<img :src="project.image" width="100%">
						</router-link>
					</div>
					<div class="col-md-10 post">
						<p class="text-left text-xl" v-html="project.secondary_description"></p>
					</div>
				</div>

				<h3 class="my-5 exp-tags" v-if="posts.length > 0">Posts</h3>
				<div class="row mb-4 pb-2 align-items-end" v-if="posts.length > 0" v-for="post in posts">
					<div class="col-md-2">
						<router-link class="my-2" :to="{ name: 'post', params: { id: post.id }}" tag="a">
							<img :src="post.image" width="100%">
						</router-link>
					</div>
					<div class="col-md-10 post">
						<p class="text-left exp-tags hidden-name text-xl">{{post.title}}</p>
						<p class="text-left text-xl">{{post.short_description}}</p>
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
				tag: {

				},
				posts: [],
				projects: [],
				tagId: ''
			}
		},

		watch: {
			'$route' (to, from) {
				this.getTag()
			}
		},
		methods: {
			getTag() {
				axios.get('/api/tag/' + this.$route.params.id)
				.then(response => {
					this.tag = response.data.tag
					this.tagId = response.data.tag.id
					this.posts = response.data.posts
					this.projects = response.data.projects
				})
			}
		},
		created() {
			axios.get('/api/tags/' + this.$route.params.id)
			.then(response => {
				this.tag = response.data.tag
				this.tagId = response.data.tag.id
				this.posts = response.data.posts
				this.projects = response.data.projects
			})
		}	
	}
</script>
