<template>
	<section class="section-expirience d-block">
		<div class="preloader-block" id="preload-block" v-if="preloader == true">
			<p class="text-green text-big text-center mb-0" id="preload-logo">R</p>
			<h1 class="text-center text-small text-white mt-0" id="preload" v-if="preloader == true">Rumus</h1>
			<p class="text-grey text-small-lighter text-center" id="preload-think">Rumus is thinking</p>
			<div class="loader mx-auto"></div>
		</div>
		<div class="row ml-0" v-if="preloader !== true">
			<div class="col-md-3 col-sm-12">
				<open-doc class="expirience-doctype" v-scroll-reveal.reset></open-doc>
				<img src="images/testimage.png" width="60" class="h-margin-left mt-5">
				<h1 class="exp-tags expirience-title h-margin-left">Expirience<img src="images/testimage2.png" width="60"></h1>
				<div class="row ml-5 mb-5" v-scroll-reveal.reset>
					<div class="col-md-12 mb-3 text-left" v-for="category in categories">
						<button class="category-button" @click="openTags(category.id)">
							<!-- <router-link class="my-2" :to="{ name: 'category', params: { id: category.id }}" tag="a"> -->
								<p class="my-0 text-grey">{{category.name}}</p>
								<!-- </router-link> -->
							</button>

							<div class="row mx-2 my-2" v-if="category_id == category.id && open_tags == true">
								<div class="col-md-6 tag-link" v-for="tag in categories_tags">
									<router-link class="my-2" :to="{ name: 'tag', params: { id: tag.id }}" tag="a">
										<p class="my-0 text-grey lighter">{{ tag.name }}</p>
									</router-link>
								</div>
							</div>
						</div>
					</div>
					<close-doc v-scroll-reveal.reset></close-doc>
				</div>
				<div class="col-md-9 col-sm-12">
					<d3-network  class="my-0 py-0 exp-graph" ref='net' :net-nodes="nodes" :net-links="links" :options="options"  :link-cb="lcb" @node-click="checkNode"/>
				</div>
			</div>
		</section>
	</template>
	<script>
		import D3Network from 'vue-d3-network'
		export default {
			components: {
				D3Network
			},
			props: ['categories_list', 'tags_list'],
			data() {
				return {
					all_nodes: true,
					preloader: false,
					tags: [],
					categories_tags: [],
					open_tags: false,
					category_id: '',
					categories: [{
						tags: [],
					}],
					nodes: [],
					links: [],
				// nodes: [
				// { id: 1, name: 'Full Stack', _color: '#07fdd8', _border: '5px solid red'},
				// { id: 2, name: 'PHP', _color: '#8892BF', _border: '5px solid red'},
				// { id: 3, name: 'Javascript', _color: '#FFD700', _border: '5px solid red'},
				// { id: 4, name: 'Laravel', _color: '#f4645f', _border: '5px solid red'},
				// { id: 5, name: 'Vue JS', _color: '#4fc08d'},
				// { id: 6, name:'Spark', _color: '#f4645f'},
				// { id: 7, name:'Twilio',_color: '#f4645f'},
				// { id: 8, name:'Translatable', _color: '#f4645f'},
				// { id: 9, name:'DomPdf', _color: '#f4645f'},
				// { id: 10, name:'PhpWord', _color: '#f4645f'},
				// { id: 11, name:'UUID', _color: '#f4645f'},
				// { id: 12, name:'Geo', _color: '#f4645f'},
				// { id: 13, name:'Passport', _color: '#f4645f'},
				// { id: 14, name:'PhpSpreadsheet', _color: '#f4645f'},
				// { id: 15, name:'Mailgun', _color: '#f4645f'},
				// { id: 16, name:'Rollbar', _color: '#f4645f'},
				// { id: 17, name:'TaxJar', _color: '#f4645f'},
				// { id: 18, name:'Stripe', _color: '#f4645f'},
				// { id: 19, name:'Braintree', _color: '#f4645f'},
				// { id: 20, name:'Multi-Tenant', _color: '#f4645f'},

				// { id: 21, name:'Chart JS', _color: '#4fc08d'},
				// { id: 22, name:'VueChart JS', _color: '#4fc08d'},
				// { id: 23, name:'Websocket', _color: '#4fc08d'},
				// { id: 24, name:'Axios', _color: '#4fc08d'},
				// { id: 25, name:'VueX', _color: '#4fc08d'},
				// { id: 26, name:'Laravel-Echo', _color: '#4fc08d'},
				// { id: 27, name:'Laravel-Mix', _color: '#4fc08d'},
				// { id: 28, name:'Sweetalert', _color: '#4fc08d'},
				// { id: 29, name:'v-calendar', _color: '#4fc08d'},
				// { id: 30, name:'vue-awesome-swiper', _color: '#4fc08d'},
				// { id: 31, name:'vue-country-select', _color: '#4fc08d'},
				// { id: 32, name:'vue-form-wizard', _color: '#4fc08d'},
				// { id: 33, name:'vue-hotel-datepicker', _color: '#4fc08d'},
				// { id: 34, name:'vue-multiselect', _color: '#4fc08d'},
				// { id: 35, name:'vue-router', _color: '#4fc08d'},
				// { id: 36, name:'vue-scroll-reveal', _color: '#4fc08d'},
				// { id: 37, name:'vue-select', _color: '##'},
				// { id: 38, name:'vue-social-sharing', _color: '#4fc08d'},
				// { id: 39, name:'vue-spinner', _color: '#4fc08d'},
				// { id: 40, name:'vue-swal', _color: '#4fc08d'},
				// { id: 41, name:'vue-tel-input', _color: '#4fc08d'},
				// { id: 42, name:'vue-template-compiler', _color: '#4fc08d'},
				// { id: 43, name:'vue2-dropzone', _color: '#4fc08d'},
				// { id: 44, name:'vue2-editor', _color: '#4fc08d'},
				// { id: 45, name:'vuedraggable', _color: '##'},
				// { id: 46, name:'vuejs-datepicker', _color: '#4fc08d'},
				// { id: 47, name:'vuelidate', _color: '#4fc08d'},
				// { id: 48, name:'vuetable-2', _color: '#4fc08d'},
				// { id: 49, name:'vue-avatar-cropper', _color: '#4fc08d'},
				// { id: 50, name:'v-autocomplete', _color: '#4fc08d'},
				// { id: 51, name:'vue-tour', _color: '#4fc08d'},
				// { id: 52, name:'vuetable-2', _color: '#4fc08d'},

				// { id: 53, name:'Bootstrap', _color: '#563d7c'},
				// { id: 54, name:'font-awesome', _color: '##'},
				// { id: 55, name:'MySQL', _color: '#2b5d80'},
				// { id: 56, name:'PostgreSQL', _color: '#336791'},
				// { id: 57, name:'SASS', _color: '#c69'},
				// { id: 58, name:'JSON', _color: '#5B5D5D'},
				// { id: 59, name:'Git', _color: '#FF7F50'},
				// ],

				// links: [
				// { sid: 1, tid: 2, _color: '#07fdd8' },
				// { sid: 1, tid: 3, _color: '#07fdd8' },
				// { sid: 2, tid: 4, _color: '#07fdd8'},
				// { sid: 3, tid: 5, _color: '#07fdd8'},
				// { sid: 4, tid: 6, _color: '#07fdd8'},
				// { sid: 4, tid: 7, _color: '#07fdd8'},
				// { sid: 4, tid: 8, _color: '#07fdd8'},
				// { sid: 4, tid: 9, _color: '#07fdd8'},
				// { sid: 4, tid: 10, _color: '#07fdd8'},
				// { sid: 4, tid: 11, _color: '#07fdd8'},
				// { sid: 4, tid: 12, _color: '#07fdd8'},
				// { sid: 4, tid: 13, _color: '#07fdd8'},
				// { sid: 4, tid: 14, _color: '#07fdd8'},
				// { sid: 4, tid: 15, _color: '#07fdd8'},
				// { sid: 4, tid: 16, _color: '#07fdd8'},
				// { sid: 4, tid: 17, _color: '#07fdd8'},
				// { sid: 4, tid: 18, _color: '#07fdd8'},
				// { sid: 4, tid: 19, _color: '#07fdd8'},
				// { sid: 4, tid: 20, _color: '#07fdd8'},

				// { sid: 5, tid: 21, _color: '#07fdd8'},
				// { sid: 5, tid: 22, _color: '#07fdd8'},
				// { sid: 5, tid: 23, _color: '#07fdd8'},
				// { sid: 5, tid: 24, _color: '#07fdd8'},
				// { sid: 5, tid: 25, _color: '#07fdd8'},
				// { sid: 5, tid: 26, _color: '#07fdd8'},
				// { sid: 5, tid: 27, _color: '#07fdd8'},
				// { sid: 5, tid: 28, _color: '#07fdd8'},
				// { sid: 5, tid: 29, _color: '#07fdd8'},
				// { sid: 5, tid: 30, _color: '#07fdd8'},
				// { sid: 5, tid: 31, _color: '#07fdd8'},
				// { sid: 5, tid: 32, _color: '#07fdd8'},
				// { sid: 5, tid: 33, _color: '#07fdd8'},
				// { sid: 5, tid: 34, _color: '#07fdd8'},
				// { sid: 5, tid: 35, _color: '#07fdd8'},
				// { sid: 5, tid: 36, _color: '#07fdd8'},
				// { sid: 5, tid: 37, _color: '#07fdd8'},
				// { sid: 5, tid: 38, _color: '#07fdd8'},
				// { sid: 5, tid: 39, _color: '#07fdd8'},
				// { sid: 5, tid: 40, _color: '#07fdd8'},
				// { sid: 5, tid: 41, _color: '#07fdd8'},
				// { sid: 5, tid: 42, _color: '#07fdd8'},
				// { sid: 5, tid: 43, _color: '#07fdd8'},
				// { sid: 5, tid: 43, _color: '#07fdd8'},
				// { sid: 5, tid: 44, _color: '#07fdd8'},
				// { sid: 5, tid: 45, _color: '#07fdd8'},
				// { sid: 5, tid: 46, _color: '#07fdd8'},
				// { sid: 5, tid: 47, _color: '#07fdd8'},
				// { sid: 5, tid: 48, _color: '#07fdd8'},
				// { sid: 5, tid: 49, _color: '#07fdd8'},
				// { sid: 5, tid: 50, _color: '#07fdd8'},
				// { sid: 5, tid: 51, _color: '#07fdd8'},
				// { sid: 5, tid: 52, _color: '#07fdd8'},

				// { sid: 1, tid: 53, _color: '#07fdd8'},
				// { sid: 1, tid: 54, _color: '#07fdd8'},
				// { sid: 1, tid: 55, _color: '#07fdd8'},
				// { sid: 1, tid: 56, _color: '#07fdd8'},
				// { sid: 1, tid: 57, _color: '#07fdd8'},
				// { sid: 1, tid: 58, _color: '#07fdd8'},
				// { sid: 1, tid: 59, _color: '#07fdd8'},


				

				// ],
				nodeSize:60,
				canvas:false
			}
		},
		computed:{
			options(){
				return{
					force: 15000,
					size:{ w:1200, h:1000},
					nodeSize: this.nodeSize,
					nodeLabels: true,
					linkLabels: true,
					canvas: this.canvas,
					linkWidth:1
				}
			}
		},
		watch: {
		    'preloader'(val){
		    	console.log(val)
		    }
		},
		methods: {
			checkNode(event, node) {
				axios.get('/api/graphs-by-node/' + node.id)
				.then(response => {
					this.nodes = response.data.nodes
					this.links = response.data.nodeLinks
				})
			},
			showPreloader() {
				setTimeout(() => {
					$('#preload').fadeOut('fast');
					$('#preload-logo').fadeOut('fast');
					$('#preload-think').fadeOut('fast');
					this.preloader = false;
				}, 2500);
				
			},
			lcb (link) {
				return link
			},
			openTags(category_id) {
				this.open_tags = !this.open_tags
				for (var i = 0; i < this.categories.length; i++) {
					if(this.categories[i].id == category_id) {
						this.categories_tags = this.categories[i].tags
						this.category_id = this.categories[i].id
					}
				}

			}
		},
		created() {
			this.preloader = true
			this.showPreloader()
			axios.get('/api/categories-without-pagination')
			.then(response => {
				this.categories = response.data
			})
			axios.get('/api/tags-without-paginate')
			.then(response => {
				this.tags = response.data
			})
			axios.get('/api/nodes')
			.then(response => {
				this.nodes = response.data
			})
			axios.get('/api/all-graph-lines-without-paginate')
			.then(response => {
				this.links = response.data
			})
		}	
	}
</script>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=PT+Sans');

/*body{
	font-family: 'PT Sans', sans-serif;
	background-color: #eee;
	}*/
/*.title{
	position:absolute;
	text-align: center;
	left: 2em;
	}*/
	h1,a{
		color: #1aad8d;
		text-decoration: none;
	}

	ul.menu {
		list-style: none;
		position: absolute;
		z-index: 100;
		min-width: 20em;
		text-align: left;
	}
	ul.menu li{
		margin-top: 1em;
		position: relative;
	}

	#m-end path, #m-start{
		fill: rgba(18, 120, 98, 0.8);
	}
	.node-label{
		font-size: 1em;
		fill: #07fdd8;
	}
	.link-label{
		fill: purple;
		transform: translate(0,.5em);
		font-size: .8em;
	}
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