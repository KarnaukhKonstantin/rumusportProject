<template>
	<section class="home-page">
		<open-doc></open-doc>
		<div class="row body-content">
			<div class="col-md-6 ml-5 mt-5">
				<img src="images/testimage.png" width="80">
				<h2 class="main-title text-white my-0 main-text-font text-green"><v-scrollin :speed="50" :misses="3">Hi,</v-scrollin></h2>
				<h2 class="main-title text-white my-0 main-text-font"><v-scrollin :speed="50" :misses="3">I'm Rumus,</v-scrollin></h2>
				<h2 class="main-title text-white my-0 main-text-font">
					<v-scrollin :speed="50" :misses="3">web developer.</v-scrollin>
					<img src="images/testimage2.png" width="80">
				</h2>
				<p class="text-grey lighter fullstack-text my-3">Full-Stack Developer / Laravel / Vue JS</p>
				<button class="contact-me pt-2 pb-2 px-5 mb-5 mt-3">
					<p class="text-uppercase my-0">Contact Me</p>
				</button>

			</div>
			<div class="col-md-5">
				<p class="rotatable text-green">R</p>
				<!-- <img class="text-right" src="images/R.png" width="500"> -->
			</div>
		</div>
		<close-doc></close-doc>
	</section>
</template>
<script>
	import VScrollin from "vue-scrollin";
	export default {
		components: {
		    "v-scrollin": VScrollin
		},
		data() {
			return {
				
			}
		},
		methods: {

		},
		create() {
			
		}	
	}
</script>