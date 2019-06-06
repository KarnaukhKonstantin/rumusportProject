<template>
	<section>
		<div class="row mt-5">
			<div class="col-md-8 offset-2">
				<div class="row">
					<div class="col-md-3 post" v-for="skill in skills" v-scroll-reveal.reset>
						<router-link class="my-2" :to="{ name: 'skill', params: { id: skill.id }}" tag="a">
							<img :src="skill.image" width="50%" height="50%">
							<h3 class="text-center">{{skill.name}}</h3>
							<p class="card-text" v-html="skill.description"></p>
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
				skills: [{
					id: ''
				}],
			}
		},
		methods: {

		},
		created() {
			axios.get('/api/allskills')
				.then(response => {
					this.skills = response.data
				})
		}
	}
</script>