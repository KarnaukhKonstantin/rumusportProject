<template>
	<section class="projects-section">
		<div class="preloader-block" id="preload-block" v-if="preloader == true">
			<p class="text-green text-big text-center mb-0" id="preload-logo">R</p>
			<h1 class="text-center text-small text-white mt-0" id="preload" v-if="preloader == true">Rumus</h1>
			<p class="text-grey text-small-lighter text-center" id="preload-think">Rumus is thinking</p>
			<div class="loader mx-auto"></div>
		</div>
		<div class="row pr-2"  v-if="preloader !== true">
			<div class="col-md-6">
				<open-doc v-scroll-reveal.reset></open-doc>
				<img src="images/testimage.png" width="60" class="ml-5 mt-5">
				<h1 class="expirience-title mb-3 ml-5 exp-tags">My Works<img src="images/testimage2.png" width="60"></h1>
				<h4 class="text-grey lighter mb-5 ml-5" v-scroll-reveal.reset>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
				<close-doc v-scroll-reveal.reset></close-doc>
			</div>
			<div class="col-md-6 pt-5" v-scroll-reveal.reset>
				<div class="row project-simple">
					<!-- <div class="col-md-12 project-block mt-5" v-for="project in projects"> -->
						<v-infinite-scroll :loading="loading" @top="prevPage" @bottom="nextPage" :offset='50' style="max-height: 100vh; overflow-y: scroll;">
							<div class="col-md-12 project-block mb-5 project-hover" v-for="project in projects">
								
								<!-- <router-link class="my-2" :to="{ name: 'project', params: { id: project.id }}" tag="a"> -->
								<div class="single-project" data-toggle="modal" data-target="#singleProjectModal" @click="openProject(project)">
									<div class="row">
										<div class="col-md-2">
											<p class="exp-tags">{{project.name}}</p>
										</div>
										<div class="col-md-10">
											<img class="project-image" :src="project.image" width="100%">
										</div>
									</div>

								<p class="mt-5 text-grey lighter" v-html="project.main_description"></p>
								<!-- </router-link> -->
								</div>
							</div>
						</v-infinite-scroll>
					</div>
				</div>
			</div>
			<!-- Create Modal -->
			<div class="modal fade" id="singleProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header float-right">
							<router-link class="my-2" :to="{ name: 'project', params: { id: project.id }}" tag="a">
								<button type="button" class="close" data-dismiss="modal">...read more</button>
							</router-link>
						</div>
						<div class="modal-body">
							<img class="project-image" :src="project.image" width="100%">
							<div class="modal-footer">
								<div class="row mt-5">
									<button type="button" class="contact-me py-2 px-2 float-right" data-dismiss="modal"><p class="text-uppercase my-0">Close</p></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</template>
	<script>
		import 'v-infinite-scroll/dist/v-infinite-scroll.css'
		export default {
			data() {
				return {
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