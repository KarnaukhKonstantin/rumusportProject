<template>
	<section class="section-expirience d-block mt-5">
		<div class="row ml-0">
			<div class="col-md-9">
				<d3-network  class="my-0 py-0" ref='net' :net-nodes="nodes" :net-links="links" :options="options"  :link-cb="lcb"/>
			</div>
			<div class="col-md-3">
				<h3 class="text-center exp-tags">My Expirience...</h3>

				<div class="row">
					<div class="col-md-12 mb-3" v-for="category in categories">
						<p class="my-0 exp-tags">{{category.name}}</p>
						<div class="row">
							<div class="col-md-6 tag-link" v-for="tag in category.tags">
								<router-link class="my-2" :to="{ name: 'tag', params: { id: tag.id }}" tag="a">
									<p class=" tag-ul my-0">{{ tag.name }}</p>
								</router-link>
							</div>
						</div>
					</div>
				</div>
				
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
				tags: [],
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
				// { id: 37, name:'vue-select', _color: '#4fc08d'},
				// { id: 38, name:'vue-social-sharing', _color: '#4fc08d'},
				// { id: 39, name:'vue-spinner', _color: '#4fc08d'},
				// { id: 40, name:'vue-swal', _color: '#4fc08d'},
				// { id: 41, name:'vue-tel-input', _color: '#4fc08d'},
				// { id: 42, name:'vue-template-compiler', _color: '#4fc08d'},
				// { id: 43, name:'vue2-dropzone', _color: '#4fc08d'},
				// { id: 44, name:'vue2-editor', _color: '#4fc08d'},
				// { id: 45, name:'vuedraggable', _color: '#4fc08d'},
				// { id: 46, name:'vuejs-datepicker', _color: '#4fc08d'},
				// { id: 47, name:'vuelidate', _color: '#4fc08d'},
				// { id: 48, name:'vuetable-2', _color: '#4fc08d'},
				// { id: 49, name:'vue-avatar-cropper', _color: '#4fc08d'},
				// { id: 50, name:'v-autocomplete', _color: '#4fc08d'},
				// { id: 51, name:'vue-tour', _color: '#4fc08d'},
				// { id: 52, name:'vuetable-2', _color: '#4fc08d'},

				// { id: 53, name:'Bootstrap', _color: '#563d7c'},
				// { id: 54, name:'font-awesome', _color: '#1fa67a'},
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
				nodeSize:20,
				canvas:false
			}
		},
		computed:{
			options(){
				return{
					force: 4000,
					size:{ w:1200, h:1000},
					nodeSize: this.nodeSize,
					nodeLabels: true,
					linkLabels: true,
					canvas: this.canvas,
					linkWidth:1
				}
			}
		},
		methods: {
			lcb (link) {
				return link
			}
		},
		created() {
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

</style>