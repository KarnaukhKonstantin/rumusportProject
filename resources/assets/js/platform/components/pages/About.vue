<template>
	<section>
		<div class="row mt-5">
			<div class="col-md-6 offset-3">
				<h1 class="text-center">
					Something about me...
				</h1>
			</div>
		</div>

		<div class="row  mt-5">
			<div class="col-md-4 block-category pr-4">
				<img :src="info.image" width="100%">
				<h1 class="text-right">{{info.name}}</h1>
			</div>
			<div class="col-md-8 pl-4">
				<p class="text-right" v-html="info.personal_info"></p>
			</div>
		</div>
		
		<!-- stack -->
		<div class="col-md-12 mt-5">
			<h1 class=text-right>
				My Stack
			</h1>
		</div>
		<div class="row mt-4">
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
		
		<!-- expirience -->
		<div class="col-md-12 mt-5">
			<h1 class=text-left>
				My Expirience
			</h1>
		</div>
		<div class="row mt-4">
			<div class="col-md-4 block-category pr-4">
				<!-- <img :src="info.image" width="100%">
				<h1 class="text-right">{{info.name}}</h1> -->
			</div>
			<div class="col-md-8 pl-4">
				<p class="text-right" v-html="info.exp_info"></p>
			</div>
		</div>
		
		<!-- works -->
		<div class="col-md-12 mt-5">
			<h1 class=text-right>
				My Works
			</h1>
		</div>
		<div class="row mt-4">
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
		
		<!-- hobbies -->
		<div class="col-md-12 mt-5">
			<h1 class=text-left>
				My Hobbies
			</h1>
		</div>
		<div class="row mt-4">
			<div class="col-md-4 block-category pr-4">
				<!-- <img :src="info.image" width="100%">
				<h1 class="text-right">{{info.name}}</h1> -->
			</div>
			<div class="col-md-8 pl-4">
				<p class="text-right" v-html="info.hobbies_info"></p>
			</div>
		</div>

		<!-- links -->
		<div class="col-md-12 mt-5">
			<h1 class=text-right>
				I'm in social
			</h1>
		</div>
		<div class="row mt-4">
			<div class="col-md-8 block-category pr-4">
				<p class="text-left" v-html="info.hobbies_info"></p>
			</div>
			<div class="col-md-4 pl-4">
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center my-5">
						<a class="hover-link" href="www.facebook.com"><img src="/images/Facebook.png" width="75%"></a>
						<a class="hover-link" href="www.LinkdIn.com"><img src="/images/Linkedin.png" width="75%"></a>
						<a class="hover-link" href="www.Telegram.com"><img src="/images/Telegram.png" width="75%"></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 d-flex justify-content-center my-5">
						<a class="hover-link" href="www.facebook.com"><img src="/images/Instagram.png" width="75%"></a>
						<a class="hover-link" href="www.LinkdIn.com"><img src="/images/Youtube.png" width="75%"></a>
						<a class="hover-link" href="www.Telegram.com"><img src="/images/Livelib.png" width="75%"></a>
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