<template>
	<section>
		<div class="row mt-5" v-scroll-reveal.reset>
			<div class="col-md-6 pl-4">

			</div>
			<div class="col-md-6 block-category pr-4">
				<img :src="skill.image" width="100%">
				<h1 class="text-right">{{skill.name}}</h1>
				<p class="text-right" v-html="skill.description"></p>
			</div>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				skill:{}
			}
		},
		methods: {

		},
		created() {
			axios.get('/api/skills/' + this.$route.params.id)
				.then(response => {
					this.skill = response.data
					this.skillId = response.data.id
			})
		}	
	}
</script>