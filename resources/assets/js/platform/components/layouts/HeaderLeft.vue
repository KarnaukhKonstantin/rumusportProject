<template>
	<section class="header-platform-left">

		<div class="block-name text-center">
			<router-link :to="{ name: 'home'}" tag="a">
				<img class="pb-0 w-100 logo" src="images/R.png">
			</router-link>
		</div>

		<div class="center-content text-center block-content mb-3">

			<div class="block-content">
				<router-link :to="{ name: 'platform-about'}" tag="a">
					<i class="fa fa-user-o link" @mouseover="aboutIcon = false" @mouseleave="aboutIcon = true" :class="[aboutIcon === true ? 'fa fa-user-o' : '']"></i>
					<p class="text-center projects" v-show="!aboutIcon">ABOUT</p>
				</router-link>
			</div>

			<div class="block-content">
				<router-link :to="{ name: 'platform-skills'}" tag="a">
					<i class="fa fa-cog link" @mouseover="skillsIcon = false" @mouseleave="skillsIcon = true" :class="[skillsIcon === true ? 'fa fa-cog' : '']"></i>
					<p class="text-center projects" v-show="!skillsIcon">SKILLS</p>
				</router-link>
			</div>
			
			<div class="block-content">
				<router-link :to="{ name: 'platform-expirience'}" tag="a">
					<i class="fa fa-codepen link" @mouseover="expirienceIcon = false" @mouseleave="expirienceIcon = true" :class="[expirienceIcon === true ? 'fa fa-codepen' : '']"></i>
					<p class="text-center projects" v-show="!expirienceIcon">EXPIRIENCE</p>
				</router-link>
			</div>
			
			<div class="block-content">
				<router-link :to="{ name: 'platform-projects'}" tag="a">
					<i class="fa fa-connectdevelop link" @mouseover="projectsIcon = false" @mouseleave="projectsIcon = true" :class="[projectsIcon === true ? 'fa fa-connectdevelop' : '']"></i>
					<p class="text-center projects" v-show="!projectsIcon">PROJECTS</p>
				</router-link>
			</div>

			<!-- <div class="block-content">
				<router-link :to="{ name: 'platform-other'}" tag="a">
					<i class="fa fa-th link" @mouseover="otherIcon = false" @mouseleave="otherIcon = true" :class="[otherIcon === true ? 'fa fa-th' : '']"></i>
					<p class="text-center projects" v-show="!otherIcon">OTHER</p>
				</router-link>
			</div> -->

			<!-- <div class="block-content">
				<router-link :to="{ name: 'platform-stack'}" tag="a">
					<i class="fa fa-empire link" @mouseover="stackIcon = false" @mouseleave="stackIcon = true" :class="[stackIcon === true ? 'fa fa-cog' : '']"></i>
					<p class="text-center projects" v-show="!stackIcon">STACK</p>
				</router-link>
			</div> -->

			<!-- <div class="block-content">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-code link" @mouseover="linksIcon = false" @mouseleave="linksIcon = true" :class="[linksIcon === true ? 'fa fa-code' : '']"></i>
					<p class="text-center projects" v-show="!linksIcon">LINKS</p>
				</router-link>
			</div> -->

			<div class="block-content">
				<router-link :to="{ name: 'platform-contacts'}" tag="a">
					<i class="fa fa-envelope-o link" @mouseover="contactIcon = false" @mouseleave="contactIcon = true" :class="[contactIcon === true ? 'fa fa-envelope-o' : '']"></i>
					<p class="text-center projects" v-show="!contactIcon">CONTACT</p>
				</router-link>
			</div>

			<div class="block-content mt-5">
				<router-link :to="{ name: 'platform-blog'}" tag="a">
					<i class="fa fa-pencil-square-o link" @mouseover="blogIcon = false" @mouseleave="blogIcon = true" :class="[blogIcon === true ? 'fa fa-pencil-square-o' : '']"></i>
					<p class="text-center projects" v-show="!blogIcon">BLOG</p>
				</router-link>
			</div>
		</div>


		<div class="bottom-content my-5 text-center">
			<div class="block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-twitter"></i>
				</router-link>
			</div>
			<div class="block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-linkedin"></i>
				</router-link>
			</div>
			<div class="block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-facebook"></i>
				</router-link>
			</div>
			<div class="block-contacts">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-instagram"></i>
				</router-link>
			</div>
		</div>



	</section>
</template>
<script>
	export default {
		data() {
			return {
				projectsIcon: true,
				blogIcon: true,
				aboutIcon: true,
				otherIcon: true,
				expirienceIcon: true,
				skillsIcon: true,
				stackIcon: true,
				linksIcon: true,
				contactIcon: true,
			}
		}	
	}
</script>