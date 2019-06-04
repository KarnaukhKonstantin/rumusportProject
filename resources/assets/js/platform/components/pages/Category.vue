<template>
	<section>
		<div class="row">
			<div class="col-md-4 mt-5 block-category pr-4">
				<img :src="category.image" width="100%">
				<h1 class="text-right">{{category.name}}</h1>
				<p class="text-right" v-html="category.description"></p>
			</div>
			<div class="col-md-8 pl-4">

				
					<h3 class=" mt-5" v-if="posts.length > 0">Posts</h3>
					<div class="row mb-4 pb-2" v-if="posts.length > 0" v-for="post in posts">
							<div class="col-md-2">
								<router-link class="my-2" :to="{ name: 'post', params: { id: post.id }}" tag="a">
									<img :src="post.image" width="100%">
								</router-link>
							</div>
							<div class="col-md-10 post">
								<p class="text-left">{{post.short_description}}</p>
							</div>
					</div>

					<h3 class=" mt-5" v-if="projects.length > 0">Projects</h3>
					<div class="row mb-4 pb-2" v-if="projects.length > 0" v-for="project in projects">
							<div class="col-md-2">
								<router-link class="my-2" :to="{ name: 'post', params: { id: project.id }}" tag="a">
									<img :src="project.image" width="100%">
								</router-link>
							</div>
							<div class="col-md-10 post">
								<p class="text-left">{{project.short_description}}</p>
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
				category: {

				},
				posts: [],
				projects: [],
				categoryId: ''
			}
		},
		// watch: {
		// 	changeId() {
		// 		console.log(this.$route.params.id)
		// 	}
		// },
		 watch: {
		    '$route' (to, from) {
		    	this.getCategory()
		      // react to route changes...
		    }
		  },
		methods: {
			getCategory() {
				axios.get('/api/categories/' + this.$route.params.id)
					.then(response => {
				this.category = response.data.category
				this.categoryId = response.data.category.id
				this.posts = response.data.posts
				this.projects = response.data.projects
			})
			}
		},
		created() {
			axios.get('/api/categories/' + this.$route.params.id)
			.then(response => {
				this.category = response.data.category
				this.categoryId = response.data.category.id
				this.posts = response.data.posts
				this.projects = response.data.projects
			})
			// axios.get('/api/posts/' + this.$route.params.id + '/comments')
			// .then(response => {
			// 	this.comments = response.data.data

			// })
		}	
	}
</script>
