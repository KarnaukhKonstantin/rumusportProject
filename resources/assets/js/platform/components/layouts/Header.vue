<template>
	<section class="header-platform">
		<div class="row platform-header-menu mt-0">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8">
				<div class="row header-buttons text-center">
					<div class="col-md-2 block-button offset-2 mr-1 px-1">
						<router-link :to="{ name: 'platform-projects'}" tag="a">
							<div class="linkSummary">
								<span class="number">01.
								</span>
								<h6 class="home-text pt-3">PROJECTS
								</h6>
								<p>A little about who I amand what I enjoy doing
								</p>
							</div>
						</router-link>
					</div>
					<div class="col-md-2 block-button mx-1 px-1">
						<router-link :to="{ name: 'platform-blog'}" tag="a">
							<div class="linkSummary">
								<span class="number">02.
								</span>
								<h6 class="home-text pt-3">BLOG
								</h6>
								<p>A little about who I amand what I enjoy doing
								</p>
							</div>
						</router-link>
					</div>
					<div class="col-md-2 block-button mx-1 px-1">
						<router-link :to="{ name: 'platform-about'}" tag="a">
							<div class="linkSummary">
								<span class="number">03.
								</span>
								<h6 class="home-text pt-3">ABOUT ME
								</h6>
								<p>A little about who I amand what I enjoy doing
								</p>
							</div>
						</router-link>
					</div>
					<div class="col-md-2 block-button mx-1 px-1">
						<router-link :to="{ name: 'platform-other'}" tag="a">
							<div class="linkSummary">
								<span class="number">04.
								</span>
								<h6 class="home-text pt-3">OTHERS
								</h6>
								<p>A little about who I amand what I enjoy doing
								</p>
							</div>
						</router-link>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
		<div class="row platform-header-categories">
			<div class="col-md-1 offset-4">
				<router-link :to="{ name: 'platform-expirience'}" tag="a">
					<div class="categories-tabs">
						<p class="home-text text-center pt-3">
							expirience
						</p>
					</div>
				</router-link>
			</div>
			<div class="col-md-1">
				<router-link :to="{ name: 'platform-skills'}" tag="a">
					<div class="categories-tabs">
						<p class="home-text text-center pt-3">
							skills
						</p>
					</div>
				</router-link>
			</div>
			<div class="col-md-1">
				<router-link :to="{ name: 'platform-stack'}" tag="a">
					<div class="categories-tabs">
						<p class="home-text text-center pt-3">
							stack
						</p>
					</div>
				</router-link>
			</div>
			<div class="col-md-1">
				<router-link :to="{ name: 'platform-links'}" tag="a">
					<div class="categories-tabs">
						<p class="home-text text-center pt-3">
							links
						</p>
					</div>
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