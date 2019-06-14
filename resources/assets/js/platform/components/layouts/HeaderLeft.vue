<template>
	<section class="header-platform-left">

		<div class="block-name px-2 text-center">
			<h1 class="text-white">R</h1>
		</div>

		<div class="center-content my-5 text-center block-content mb-3">

			<div class="block-content">
				<router-link :to="{ name: 'platform-projects'}" tag="a">
					<i class="fa fa-2x fa-connectdevelop link" @mouseover="projectsIcon = false" @mouseleave="projectsIcon = true" :class="[projectsIcon === true ? 'fa fa-2x fa-connectdevelop' : '']"></i>
					<p class="text-center projects" v-show="!projectsIcon">PROJECTS</p>
				</router-link>
			</div>

			<div class="block-content">
				<router-link :to="{ name: 'platform-blog'}" tag="a">
					<i class="fa fa-2x fa-pencil-square-o link" @mouseover="blogIcon = false" @mouseleave="blogIcon = true" :class="[blogIcon === true ? 'fa fa-2x fa-pencil-square-o' : '']"></i>
					<p class="text-center projects" v-show="!blogIcon">BLOG</p>
				</router-link>
			</div>
			
			<div class="block-content">
				<router-link :to="{ name: 'platform-about'}" tag="a">
					<i class="fa fa-2x fa-user-o link" @mouseover="aboutIcon = false" @mouseleave="aboutIcon = true" :class="[aboutIcon === true ? 'fa fa-2x fa-user-o' : '']"></i>
					<p class="text-center projects" v-show="!aboutIcon">ABOUT</p>
				</router-link>
			</div>

			<div class="block-content">
				<router-link :to="{ name: 'platform-other'}" tag="a">
					<i class="fa fa-2x fa-th link" @mouseover="otherIcon = false" @mouseleave="otherIcon = true" :class="[otherIcon === true ? 'fa fa-2x fa-th' : '']"></i>
					<p class="text-center projects" v-show="!otherIcon">OTHER</p>
				</router-link>
			</div>

			<div class="block-content">
				<router-link :to="{ name: 'platform-skills'}" tag="a">
					<i class="fa fa-2x fa-cog link" @mouseover="skillsIcon = false" @mouseleave="skillsIcon = true" :class="[skillsIcon === true ? 'fa fa-2x fa-cog' : '']"></i>
					<p class="text-center projects" v-show="!skillsIcon">SKILLS</p>
				</router-link>
			</div>
			
			<div class="block-content">
				<router-link :to="{ name: 'platform-expirience'}" tag="a">
					<i class="fa fa-2x fa-codepen link" @mouseover="expirienceIcon = false" @mouseleave="expirienceIcon = true" :class="[expirienceIcon === true ? 'fa fa-2x fa-codepen' : '']"></i>
					<p class="text-center projects" v-show="!expirienceIcon">EXPIRIENCE</p>
				</router-link>
			</div>

			<div class="block-content">
				<router-link :to="{ name: 'platform-stack'}" tag="a">
					<i class="fa fa-2x fa-empire link" @mouseover="stackIcon = false" @mouseleave="stackIcon = true" :class="[stackIcon === true ? 'fa fa-2x fa-cog' : '']"></i>
					<p class="text-center projects" v-show="!stackIcon">STACK</p>
				</router-link>
			</div>

			<div class="block-content">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-code link" @mouseover="linksIcon = false" @mouseleave="linksIcon = true" :class="[linksIcon === true ? 'fa fa-2x fa-cog' : '']"></i>
					<p class="text-center projects" v-show="!linksIcon">LINKS</p>
				</router-link>
			</div>
		</div>


		<div class="bottom-content my-5 text-center">
			<div class="block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-twitter"></i>
				</router-link>
			</div>
			<div class="block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-linkedin"></i>
				</router-link>
			</div>
			<div class="block-contacts mb-2">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<i class="fa fa-2x fa-facebook"></i>
				</router-link>
			</div>
			<div class="block-contacts">
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
				projectsIcon: true,
				blogIcon: true,
				aboutIcon: true,
				otherIcon: true,
				expirienceIcon: true,
				skillsIcon: true,
				stackIcon: true,
				linksIcon: true,
			}
		}	
	}
</script>