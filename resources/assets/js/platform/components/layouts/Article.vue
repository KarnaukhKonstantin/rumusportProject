<template>
	<section>
		<div class="col-md-12 px-3 mt-5">
			<img :src="article.image" width="100%">
			<h6 class="text-center" v-html="article.description"></h6>
			<p class="text-right mt-5" v-html="article.created_at"></p>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				article: {}
			}
		},
		methods: {

		},
		created() {
			axios.get('/api/last-article')
				.then(response => {
					this.article = response.data
				})
		}	
	}
</script>