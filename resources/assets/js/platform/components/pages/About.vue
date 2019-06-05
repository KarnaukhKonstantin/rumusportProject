<template>
	<section>
		<div class="row mt-5">
			<div class="col-md-6 offset-3">
				<h1 class="text-center">
					Something about me...
				</h1>
			</div>
		</div>

		<div class="row  mt-5" v-scroll-reveal.reset>
			<div class="col-md-4 block-category pr-4">
				<img :src="info.image" width="100%">
				<h1 class="text-right">{{info.name}}</h1>
			</div>
			<div class="col-md-8 pl-4">
				<p class="text-right" v-html="info.personal_info"></p>
			</div>
		</div>

		<div class="row  mt-5" v-scroll-reveal.reset>
			<div class="col-md-8 block-category pr-4">
				<p class="text-left" v-html="info.description"></p>
			</div>
			<div class="col-md-4 pl-4">
				<div class="row">
					<div class="col-md-6" v-for="skill in info.skills">
						<img :src="skill.image" width="100%">
					</div>
				</div>
			</div>
		</div>

		<div class="row  mt-5" v-scroll-reveal.reset>
			<div class="col-md-4 block-category pr-4">
				<!-- <img :src="info.image" width="100%">
				<h1 class="text-right">{{info.name}}</h1> -->
			</div>
			<div class="col-md-8 pl-4">
				<p class="text-right" v-html="info.exp_info"></p>
			</div>
		</div>

		<div class="row  mt-5" v-scroll-reveal.reset>
			<div class="col-md-8 block-category pr-4">
				<p class="text-left" v-html="info.work_info"></p>
			</div>
			<div class="col-md-4 pl-4">
				<!-- <div class="row">
					<div class="col-md-6" v-for="skill in info.skills">
						<img :src="skill.image" width="100%">
					</div>
				</div> -->
			</div>
		</div>

		<div class="row  mt-5" v-scroll-reveal.reset>
			<div class="col-md-4 block-category pr-4">
				<!-- <img :src="info.image" width="100%">
				<h1 class="text-right">{{info.name}}</h1> -->
			</div>
			<div class="col-md-8 pl-4">
				<p class="text-right" v-html="info.hobbies_info"></p>
			</div>
		</div>

	</section>
</template>
<script>
	export default {
		data() {
			return {
				info:{
					skills:[]
				},
				soclinks: [],
			}
		},
		methods: {

		}, 
		created() {
			axios.get('/api/about')
				.then(response => {
					this.info = response.data
				})
			axios.get('/api/soclinks-all')
				.then(response => {
					this.soclinks = response.data
				})
		}	
	}
</script>