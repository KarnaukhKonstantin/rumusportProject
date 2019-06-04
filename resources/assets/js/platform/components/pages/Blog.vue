<template>
	<section>
		<div class="row mt-5">
			<div class="col-md-6 offset-3">
				<h1 class="text-center">
					Writing...
				</h1>
			</div>
		</div>
		<div class="row content-block my-5">
			<div class="col-md-6 mb-5 px-5 post" v-for="post in posts" v-scroll-reveal.reset>
				<router-link class="my-2" :to="{ name: 'post', params: { id: post.id }}" tag="a">
					<img :src="post.image" width="100%">
					<h3>{{ post.title}}</h3>
					<p class="card-text" v-html="post.short_description"></p>
					<p class="category-text text-right mt-5">
						category    
						{{post.category.name}}
					</p> 
					<p class="category-text text-right">
						posted on    
						{{post.created_at}}
					</p>
				</router-link>
			</div>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				posts: [],
			}
		},
		methods: {
		},
		created() {
			axios.get('/api/posts')
				.then(response => {
					this.posts = response.data
				})
		}
	}
</script>