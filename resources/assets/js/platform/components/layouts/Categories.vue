<template>
	<section>
		<div class="row mt-5 mx-1">
			<div class="col-md-12" v-for="category in categories">
				<router-link class="my-0" :to="{ name: 'category', params: { id: category.id }}" tag="a">
					<button class="btn btn-secondary d-block mx-auto w-100 mb-1">
						<p class="text-white pt-3">{{category.name}}</p>
					</button>
				</router-link>
			</div>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				categories: [],
			}
		},
		methods: {

		},
		created() {
			axios.get('/api/categories')
				.then(response => {
					this.categories = response.data
				})
		}
	}
</script>