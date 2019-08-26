<template>
	<section class="single-post">
		<go-top 
		:size="100" 
		:right="50" 
		fg-color="#07fdd8" 
		bg-color="#37393b" 
		ripple-bg="#07fdd8" 
		:has-outline="false" 
		:radius="10" 
		:src="null" 
		weight="lighter" 
		box-shadow="1px 1px 2px #07fdd8" 
		alt="`SCROLL`">
		</go-top>
		<div class="row mt-3">
			<div class="col-md-3 sticky">
				<div class="row justify-content-center mt-3">
					<button class="contact-me py-2 px-2 mb-5 mr-3 class='sticky-top'" v-scroll-reveal.reset>
						<router-link :to="{ name: 'all-posts'}" tag="a">
							<p class="text-uppercase my-0 text-align-center text-xl">All Posts...</p>
						</router-link>
					</button>
				</div>
			</div>
			<div class="col-md-6 scroll">
				<img :src="post.image" width="100%" class="mr-5 mb-5">
				<h1 class="text-center my-5 exp-tags">{{post.title}}</h1>

				<div class="content-place post-text">
					<p v-html="post.description" class="text-grey lighter text-xl"></p>
				</div>
				<div class="col-md-12 mt-5 text-grey lighter">
					<div class="row d-flex justify-content-end align-items-center">
						<p class="text-right mx-1 text-xl">category</p>
						<p class="text-right mx-1 text-xl exp-tags">{{post.category.name}}</p>
					</div>
					<div class="row d-flex justify-content-end align-items-center">
						<p class="text-right mx-1 text-xl">author</p>
						<p class="text-right mx-1 text-xl">Kost</p>
					</div>
					<div class="row d-flex justify-content-end align-items-center">
						<p class="text-right mx-1 text-xl">posted on </p>
						<p class="text-right mx-1 text-xl">{{post.created_at}}</p>
					</div>
				</div>
				<h1 class="text-center text-uppercase mt-5">Tags</h1>
				<div class="row mt-5 row-tags">
					<div class="col-md-1 mx-auto px-0 exp-tags project-hover" v-for="tag in post.tags">
						<router-link class="my-2" :to="{ name: 'tag', params: { id: tag.id }}" tag="a">
							<p class="text-center tag-xl">{{tag.name}}</p>
						</router-link>
					</div>
				</div>
			</div>
		</div>
		
	</section>
</template>
<script>
	import GoTop from '@inotom/vue-go-top';
	export default {
		components: {
			GoTop
		},
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
		}	
	}
</script>
<style type="text/css">
.row-tags a{
	color: #07fdd8;
}

</style>
