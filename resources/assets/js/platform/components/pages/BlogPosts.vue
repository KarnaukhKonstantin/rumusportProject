<template>
	<section class="all-blog-posts">
		<go-top 
		:size="100" 
		:right="50" 
		fg-color="#07fdd8" 
		bg-color="#37393b" 
		ripple-bg="#07fdd8" 
		:has-outline="false" 
		:radius="10" 
		:src="null" 
		weight="lighter" 
		box-shadow="1px 1px 2px #07fdd8" 
		alt="`SCROLL`">
		</go-top>
		<div class="row all-posts-row">
			<div class="col-md-12 col-lg-4" v-scroll-reveal.reset>
				<div class="row mt-5 mx-1">
					<div class="col-md-12" v-for="category in categories">
						<div class="project-hover">
							<p class="text-white text-center pt-3 btn-category" @click="categoryPosts(category.id)">{{category.name}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-8">
				<div class="row">
					<div class="col-md-12 col-lg-6 mt-3" v-for="post in posts" v-if="posts.length > 0">
						<div class="box" @mouseover="getDate(post)">
							<router-link :to="{ name: 'post', params: { id: post.id }}" tag="a">
								<img :src="post.image" width="100%" height="100%" class="post-img">
								<div class="hover-effect">
									<a href="#" class="hover-text">
										<h1>{{post.title}}</h1>
										<p>{{post.short_description}}</p>
										<p class="mt-2">{{date}}</p>
									</a>
								</div>
							</router-link>
						</div>
					</div>
					<h1 class="text-white mt-5" v-if="posts.length == 0">OOOOPPPPS! This Category is empty now...</h1>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
	import GoTop from '@inotom/vue-go-top';
	import moment from 'moment'
	export default {
		components: {
			GoTop
		},
		data() {
			return {
				posts: [],
				date:'',
				categories: [],
			}
		},
		methods: {
			categoryPosts(category_id) {
				axios.get('/api/posts/category-posts/' + category_id)
					.then(response => {
						this.posts = response.data
					})
			},
			getDate(post) {
				this.date = moment(post.created_at).format('ll');
			}
		},
		created() {
			axios.get('/api/categories')
			.then(response => {
				this.categories = response.data
			})
			axios.get('/api/posts')
			.then(response => {
				this.posts = response.data
			})
		}
	}
</script>
<style type="text/css">
.all-posts-row .box {
	position: relative;
	overflow: hidden;
	height: 300px;
	width: 100%;
	background-size: cover;
	cursor: pointer;
}
.hover-effect a{
	color:#fff;
}

.hover-effect {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(5, 8, 31, 0.62);
	transition: all 0.3s ease-in-out;
	opacity: 0;
}

.box:hover .hover-effect {
	opacity: 1;
}
.box:hover .hover-text {
	right: 0;
}
/*.box img {
	object-fit: fill;
	}*/
	.hover-text {
		position: absolute;
		right: -100%;
		bottom: 0;
		display: block;
		max-width: 100%;
		padding: 40px 45px;
		color: #e2e2e2;
		text-decoration: none;
		text-align: right;
		line-height: 1.5em;
		font-size: 15px;
		font-family: "Proxima Nova";
		font-weight: 300;
		text-transform: uppercase;
		letter-spacing: 5px;
		transition: all 0.5s ease-in-out;
	}

	.hover-text h1 {
		font-size: 2em;
		font-weight: 500;
		padding: 0.8em 0;
		margin-bottom: 0.3em;
		border-bottom: 1px solid #fff;
	}

</style>