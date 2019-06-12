<template>
	<section class="header-platform-left">

		<div class="col-md-12 block-name px-2 text-center">
			<h1 class="text-white">R</h1>
		</div>

		<div class="col-md-12 center-content my-5 text-center px-3">
			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-projects'}" tag="a">
					<i class="fa fa-2x fa-connectdevelop"></i>
				</router-link>
			</div>

			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-blog'}" tag="a">
					<i class="fa fa-2x fa-pencil-square-o"></i>
				</router-link>
			</div>
			
			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-about'}" tag="a">
					<i class="fa fa-2x fa-user-o"></i>
				</router-link>
			</div>

			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-other'}" tag="a">
					<i class="fa fa-2x fa-th"></i>
				</router-link>
			</div>

			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-expirience'}" tag="a">
					<i class="fa fa-2x fa-codepen"></i>
				</router-link>
			</div>

			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-skills'}" tag="a">
					<i class="fa fa-2x fa-cog"></i>
				</router-link>
			</div>

			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-stack'}" tag="a">
					<i class="fa fa-2x fa-empire"></i>
				</router-link>
			</div>

			<div class="col-md-12 block-content mb-3">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-code"></i>
				</router-link>
			</div>
		</div>


		<div class="col-md-12 bottom-content my-5 text-center">
			<div class="col-md-12 block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-twitter"></i>
				</router-link>
			</div>
			<div class="col-md-12 block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-linkedin"></i>
				</router-link>
			</div>
			<div class="col-md-12 block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-facebook"></i>
				</router-link>
			</div>
			<div class="col-md-12 block-contacts">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-instagram"></i>
				</router-link>
			</div>
		</div>



	</section>
</template>
<script>
	export default {
		data() {
			return {
				
			}
		}	
	}
</script>