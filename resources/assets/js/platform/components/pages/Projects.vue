<template>
	<section class="projects-section">
		<div class="preloader-block" id="preload-block" v-if="preloader == true">
			<p class="text-green text-big text-center mb-0" id="preload-logo">R</p>
			<h1 class="text-center text-small text-white mt-0" id="preload" v-if="preloader == true">Rumus</h1>
			<p class="text-grey text-small-lighter text-center" id="preload-think">Rumus is thinking</p>
			<div class="loader mx-auto"></div>
		</div>
		<div class="row pr-2"  v-if="preloader !== true">
			<div class="col-md-12 col-lg-6">
				<open-doc v-scroll-reveal.reset></open-doc>
				<img src="images/testimage.png" width="60" class="ml-5 mt-5">
				<h1 class="expirience-title mb-3 ml-5 exp-tags">My Works<img src="images/testimage2.png" width="60"></h1>
				<h4 class="text-grey lighter mb-5 ml-5" v-scroll-reveal.reset>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
				<close-doc v-scroll-reveal.reset></close-doc>
			</div>
			<div class="col-md-12 col-lg-6">
				<div class="row align-items-start">
					<v-infinite-scroll :loading="loading" @top="prevPage" @bottom="nextPage" :offset='50' style="max-height: 100vh; overflow-y: scroll;">
						<div class="col-md-12 project-hover mt-5 large-main-post" v-for="project in projects">
							<!-- <div class="col-md-12 project-hover mt-5" v-for="post in project-scroll-reveal.reset> -->
								<div class="box" @mouseover="getDate(projects)">
									<router-link :to="{ name: 'project', params: { id: project.id }}" tag="a">
										<img :src="project.image" width="100%">
										<div class="hover-effect">
											<a href="#" class="hover-text">
												<h1 class="exp-tags">{{project.name}}</h1>
												<p v-html="project.secondary_description"></p>
												<p>{{date}}</p>
											</a>
										</div>
									</router-link>
								</div>
							</div>
						</v-infinite-scroll>
					</div>
				</div>
			</div>
		</section>
	</template>
	<script>
		import 'v-infinite-scroll/dist/v-infinite-scroll.css'
		import moment from 'moment'
		export default {
			data() {
				return {
					date: '',
					preloader: false,
					projects: [],
					project: {},
					page: 1,
					items: [],
					loading: true,
				}
			},
			watch: {
				'preloader'(val){
					console.log(val)
				}
			},
			methods: {
				getDate(post) {
					this.date = moment(post.created_at).format('ll');
				},
				showPreloader() {
					setTimeout(() => {
						$('#preload').fadeOut('fast');
						$('#preload-logo').fadeOut('fast');
						$('#preload-think').fadeOut('fast');
						this.preloader = false;
					}, 2500);
					
				},
				prevPage () {
					if (this.page == 1) return
						--this.page
					this.api()
				},
				nextPage () {
					++this.page
					this.api()
				},
				api () {
					this.loading = true
					myApi.get({page: this.page}).then((response) => {
						this.items = response
						this.loading = false
					})
				},
				openProject(project) {
					this.project = project
					console.log(project)
				}
			},
			created() {
				this.preloader = true
				this.showPreloader()
				axios.get('/api/projects/without-paginate')
				.then(response => {
					this.projects = response.data
				})
			}	
		}
	</script>
	<style type="text/css">
	@keyframes slideInFromLeft {
		0% {
			transform: translateX(-100%);
		}
		100% {
			transform: translateX(0);
		}
	}

	.preloader-block{
		animation: 1s ease-out 0s 1 slideInFromLeft;
		/*background: #333;*/
		padding: 30px;
	}
	.loader {
		height: 1px;
		width: 30%;
		position: relative;
		overflow: hidden;
		background-color: #ddd;
	}
	.loader:before{
		display: block;
		position: absolute;
		content: "";
		left: -200px;
		width: 200px;
		height: 4px;
		background-color: #07fdd8;
		animation: loading 2s linear infinite;
	}

	@keyframes loading {
		from {left: -200px; width: 30%;}
		50% {width: 30%;}
		70% {width: 70%;}
		80% { left: 50%;}
		95% {left: 120%;}
		to {left: 100%;}
	}
</style>