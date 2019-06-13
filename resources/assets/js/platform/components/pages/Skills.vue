<template>
	<section>
		<div class="row mt-5">
			<div class="col-md-6">
				
			</div>
			<div class="col-md-6">
			<tags-ball v-bind:style='{"border":"2px solid #252628", 
									  "fontMax":"200", 
									  "font":"50px monaco", 
									  "color":"#fff"}' 
									  :width='500' 
									  :height='500' 
									  :tags='opa'/>
				<!-- <div class="row">
					<div class="col-md-3 post" v-for="skill in skills" v-scroll-reveal.reset>
						<router-link class="my-2" :to="{ name: 'skill', params: { id: skill.id }}" tag="a">
							<img :src="skill.image" width="50%" height="50%">
							<h3 class="text-center">{{skill.name}}</h3>
							<p class="card-text" v-html="skill.description"></p>
						</router-link>
					</div>
				</div> -->
			</div>
		</div>
	</section>
</template>


<script>
	import TagsBall from 'vue-tags-ball'

	export default {
		name: 'Skills',

		components: {
		    "tags-ball":TagsBall
		 },

		data() {
			return {
				skills: [{
					id: ''
				}],
				opa:[
					'opapapapa',
					'opopopop',
					'ups',
					'gaps',
					'green',
					'yellow',
					'red'

				],
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
