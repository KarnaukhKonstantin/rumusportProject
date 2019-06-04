<template>
	<section>
		<div class="col-md-12">
			<h1 class="text-center my-5">{{post.title}}</h1>
		</div>
		<div class="content-place">
			<img :src="post.image" width="40%" height="40%" class="mr-5 mb-5" align="left">
			<p v-html="post.description"></p>
		</div>
		<div class="col-md-12 mt-5">
			<div class="row d-flex justify-content-end align-items-center">
				<p class="text-right mx-1">category</p>
				<p class="text-right mx-1">{{post.category.name}}</p>
			</div>
			<div class="row d-flex justify-content-end align-items-center">
				<p class="text-right mx-1">author</p>
				<p class="text-right mx-1">Kost</p>
			</div>
			<div class="row d-flex justify-content-end align-items-center">
				<p class="text-right mx-1">posted on </p>
				<p class="text-right mx-1">{{post.created_at}}</p>
			</div>

		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				post: {
					category: {
						name: ''
					}
				}
			}
		},
		methods: {

		},
		created() {
			axios.get('/api/posts/' + this.$route.params.id)
			.then(response => {
				this.post = response.data
				this.postId = response.data.id
			})
			// axios.get('/api/posts/' + this.$route.params.id + '/comments')
			// .then(response => {
			// 	this.comments = response.data.data

			// })
		}	
	}
</script>
