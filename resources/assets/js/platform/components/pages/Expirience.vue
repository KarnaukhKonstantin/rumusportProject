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
					<div id="sudoku-demo" class="demo stack">
						<transition-group name="cell" tag="div" class="container-big" v-if="nodes.length < 9">
							<div v-for="node in nodes" :key="node.id" class="cell-big text-center px-1 m-1" @click="nodesByNode(node.name)">
								{{ node.name }}
							</div>
						</transition-group>
					<!-- 	<transition-group name="cell" tag="div" class="container-middle">
							<div v-for="node in nodes" :key="node.id" class="cell-middle text-center px-1 m-1" v-if="nodes.length > 9 && nodes.length < 17">
								{{ node.name }}
							</div>
						</transition-group> -->
						<transition-group name="cell" tag="div" class="container-small" v-if="nodes.length > 9 && nodes.length < 81">
							<div v-for="node in nodes" :key="node.id" class="cell-small text-center px-1 m-1">
								{{ node.name }}
							</div>
						</transition-group>
						<transition-group name="cell" tag="div" class="container-extra-small" v-if="nodes.length > 81">
							<div v-for="node in nodes" :key="node.id" class="cell-extra-small text-center px-1 m-1">
								{{ node.name }}
							</div>
						</transition-group>
					</div>
				</div>
		</div>
	</section>
</template>
<script>
	export default {
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
			}
		},
		watch: {
			'preloader'(val){
				console.log(val)
			}
		},
		methods: {
			shuffle: function () {
				this.nodes = _.shuffle(this.nodes)
			},
			nodesByNode(name) {
				this.nodes = [],
				axios.get('/api/animated-graph/' + name)
				.then(response => {
					this.nodes = response.data.nodes
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
			openTags(category_id) {
				this.open_tags = !this.open_tags
				for (var i = 0; i < this.categories.length; i++) {
					if(this.categories[i].id == category_id) {
						this.categories_tags = this.categories[i].tags
						this.category_id = this.categories[i].id
					}
				}

			},
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
			axios.get('/api/animated-graph/' + 'FullStack')
			.then(response => {
				this.nodes = response.data.nodes
			}),
			setTimeout(this.shuffle, 100)
			setInterval(this.shuffle, 5000)
			
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
.container-small {
	display: flex;
	flex-wrap: wrap;
	width: 700px;
	margin-top: 10px;
	margin-left: 300px;
}
.cell-small {
	/*background-color: #aaa;*/
	display: flex;
	justify-content: space-around;
	align-items: center;
	width: 75px;
	height: 75px;
	border: 1px solid #07fdd8;
	margin-right: -1px;
	margin-bottom: -1px;
	font-size: 11px;
	color: #07fdd8;
}
.container-big {
	display: flex;
	flex-wrap: wrap;
	width: 700px;
	margin-top: 10px;
	margin-left: 300px;
}
.cell-big{
	display: flex;
	justify-content: space-around;
	align-items: center;
	width: 200px;
	height: 200px;
	border: 1px solid #07fdd8;
	margin-right: -1px;
	margin-bottom: -1px;
	font-size: 14px;
	color: #07fdd8;
}
.cell-big:hover {
	background-color: #07fdd8;
	color: #252628;
}
.container-middle {
	display: flex;
	flex-wrap: wrap;
	width: 600px;
	margin-top: 10px;
	margin-left: 300px;
}
.cell-middle{
	display: flex;
	justify-content: space-around;
	align-items: center;
	width: 150px;
	height: 150px;
	border: 1px solid #07fdd8;
	margin-right: -1px;
	margin-bottom: -1px;
	font-size: 14px;
	color: #07fdd8;
}
.cell-middle:hover {
	background-color: #07fdd8;
	color: #252628;
}
.cell-small:hover {
	background-color: #07fdd8;
	color: #252628;
}
.cell:nth-child(3n) {
	margin-right: 0;
}
.cell:nth-child(27n) {
	margin-bottom: 0;
}
.cell-move {
	transition: transform 1s;
}
</style>